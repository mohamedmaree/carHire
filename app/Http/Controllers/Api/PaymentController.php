<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Services\EwayPaymentService;
use App\Traits\ResponseTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PaymentController extends Controller
{
    use ResponseTrait;

    private $paymentService;

    public function __construct()
    {
        $this->paymentService = new EwayPaymentService();
    }

    /**
     * Handle payment success redirect from eWAY
     */
    public function success(Request $request, Order $order)
    {
        try {
            $accessCode = $request->get('AccessCode');
            
            if (!$accessCode) {
                Log::error('Payment Success: Missing AccessCode', [
                    'order_id' => $order->id,
                    'request_data' => $request->all()
                ]);
                
                return $this->response('fail', 'Invalid payment response');
            }

            // Query transaction result
            $transactionResult = $this->paymentService->queryTransaction($accessCode);
            
            if ($transactionResult['success'] && $transactionResult['transaction_status']) {
                // Payment successful
                $this->paymentService->processPaymentSuccess($order, $transactionResult);
                
                return $this->successData([
                    'order_id' => $order->id,
                    'transaction_id' => $transactionResult['transaction_id'],
                    'status' => 'success',
                    'message' => 'Payment completed successfully'
                ], 'Payment completed successfully');
            } else {
                // Payment failed
                $this->paymentService->processPaymentFailure($order, $transactionResult);
                return $this->response('fail', 'Payment failed',[
                    'order_id' => $order->id,
                    'errors' => $transactionResult['errors'] ?? [$transactionResult['response_message']],
                    'status' => 'failed'
                ]);
            }
        } catch (\Exception $e) {
            Log::error('Payment Success Handler Exception', [
                'order_id' => $order->id,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return $this->response('fail', 'Payment processing error');
        }
    }

    /**
     * Handle payment cancel redirect from eWAY
     */
    public function cancel(Request $request, Order $order)
    {
        try {
            Log::info('Payment Cancelled', [
                'order_id' => $order->id,
                'request_data' => $request->all()
            ]);

            // Update order status to cancelled
            $order->update([
                'payment_status' => 'cancelled',
                'eway_response' => json_encode([
                    'status' => 'cancelled',
                    'reason' => 'User cancelled payment',
                    'cancelled_at' => now()->toISOString()
                ])
            ]);

            return $this->successData([
                'order_id' => $order->id,
                'status' => 'cancelled',
                'message' => 'Payment was cancelled'
            ], 'Payment was cancelled');
        } catch (\Exception $e) {
            Log::error('Payment Cancel Handler Exception', [
                'order_id' => $order->id,
                'error' => $e->getMessage()
            ]);

            return $this->response('fail', 'Payment cancellation processing error');
        }
    }

    /**
     * Check payment status for an order
     */
    public function status(Order $order)
    {
        try {
            if (!$order->eway_access_code) {
                return $this->response('fail', 'No payment information found for this order');
            }

            $transactionResult = $this->paymentService->queryTransaction($order->eway_access_code);
            
            if ($transactionResult['success']) {
                return $this->successData([
                    'order_id' => $order->id,
                    'payment_status' => $order->payment_status,
                    'transaction_status' => $transactionResult['transaction_status'],
                    'transaction_id' => $transactionResult['transaction_id'],
                    'response_message' => $transactionResult['response_message'],
                    'total_amount' => $transactionResult['total_amount'],
                    'paid_at' => $order->paid_at
                ], 'Payment status retrieved successfully');
            } else {
                return $this->response('fail','Failed to retrieve payment status',[
                    'order_id' => $order->id,
                    'payment_status' => $order->payment_status,
                    'errors' => $transactionResult['errors']
                ]);
            }
        } catch (\Exception $e) {
            Log::error('Payment Status Check Exception', [
                'order_id' => $order->id,
                'error' => $e->getMessage()
            ]);

            return $this->response('fail', 'Payment status check error');
        }
    }

    /**
     * Webhook endpoint for eWAY notifications (if needed)
     */
    public function webhook(Request $request)
    {
        try {
            Log::info('eWAY Webhook Received', [
                'request_data' => $request->all(),
                'headers' => $request->headers->all()
            ]);

            // Process webhook data here if eWAY sends notifications
            // This is optional and depends on eWAY's webhook configuration

            return response()->json(['status' => 'received'], 200);
        } catch (\Exception $e) {
            Log::error('eWAY Webhook Exception', [
                'error' => $e->getMessage(),
                'request_data' => $request->all()
            ]);

            return response()->json(['status' => 'error'], 500);
        }
    }
}