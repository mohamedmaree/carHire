<?php

namespace App\Services;

use App\Models\Order;
use Eway\Rapid;
use Eway\Rapid\Enum\ApiMethod;
use Eway\Rapid\Enum\TransactionType;
use Illuminate\Support\Facades\Log;

class EwayPaymentService
{
    private $client;
    private $apiKey;
    private $apiPassword;
    private $apiEndpoint;

    public function __construct()
    {
        $this->apiKey = config('eway.api_key');
        $this->apiPassword = config('eway.api_password');
        $this->apiEndpoint = config('eway.api_endpoint', 'Sandbox');
        
        $this->client = Rapid::createClient($this->apiKey, $this->apiPassword, $this->apiEndpoint);
    }

    /**
     * Create a payment URL for the order using Responsive Shared Page
     */
    public function createPaymentUrl(Order $order): array
    {
        try {
            $transaction = [
                'Customer' => [
                    'FirstName' => $order->first_name,
                    'LastName' => $order->last_name,
                    'Email' => $order->email,
                    'Phone' => '0'.$order->phone,
                    'Street1' => $order->address,
                    'City' => $order->city->name ?? 'Unknown',
                    'Country' => $order->country->code ?? 'au',
                    'PostalCode' => $order->zip ?? '0000',
                ],
                'RedirectUrl' => route('api.payment.success', ['order' => $order->id]),
                'CancelUrl' => route('api.payment.cancel', ['order' => $order->id]),
                'TransactionType' => TransactionType::PURCHASE,
                'Payment' => [
                    'TotalAmount' => (int) ($order->total_amount * 100), // Convert to cents
                ],
                'Items' => [
                    [
                        'SKU' => 'CAR_RENTAL_' . $order->id,
                        'Description' => 'Car Rental - ' . $order->car->name,
                        'Quantity' => 1,
                        'UnitCost' => (int) ($order->total_amount * 100),
                        'Total' => (int) ($order->total_amount * 100),
                    ]
                ],
                'Options' => [
                    [
                        'Value' => 'Order ID: ' . $order->id,
                    ]
                ]
            ];

            // Submit data to eWAY to get a Shared Page URL
            $response = $this->client->createTransaction(ApiMethod::RESPONSIVE_SHARED, $transaction);
            // Check for any errors
            if (!$response->getErrors()) {
                // Update order with access code
                $order->update([
                    'eway_access_code' => $response->AccessCode,
                    'payment_status' => 'pending',
                    'payment_method' => 'eway'
                ]);

                return [
                    'success' => true,
                    'payment_url' => $response->SharedPaymentUrl,
                    'access_code' => $response->AccessCode,
                    'message' => 'Payment URL created successfully'
                ];
            } else {
                $errors = [];
                foreach ($response->getErrors() as $error) {
                    $errors[] = Rapid::getMessage($error);
                }

                Log::error('eWAY Payment Error', [
                    'order_id' => $order->id,
                    'errors' => $errors
                ]);

                return [
                    'success' => false,
                    'errors' => $errors,
                    'message' => 'Failed to create payment URL'
                ];
            }
        } catch (\Exception $e) {
            Log::error('eWAY Payment Exception', [
                'order_id' => $order->id,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return [
                'success' => false,
                'errors' => [$e->getMessage()],
                'message' => 'Payment service error'
            ];
        }
    }

    /**
     * Query transaction result using access code
     */
    public function queryTransaction(string $accessCode): array
    {
        try {
            $response = $this->client->queryTransaction($accessCode);
            
            if (!$response->getErrors() && !empty($response->Transactions)) {
                $transaction = $response->Transactions[0];
                
                return [
                    'success' => true,
                    'transaction' => $transaction,
                    'transaction_status' => $transaction->TransactionStatus,
                    'transaction_id' => $transaction->TransactionID,
                    'response_message' => $transaction->ResponseMessage ?? '',
                    'total_amount' => $transaction->TotalAmount ?? 0,
                ];
            } else {
                $errors = [];
                foreach ($response->getErrors() as $error) {
                    $errors[] = Rapid::getMessage($error);
                }

                return [
                    'success' => false,
                    'errors' => $errors,
                    'message' => 'Failed to query transaction'
                ];
            }
        } catch (\Exception $e) {
            Log::error('eWAY Query Transaction Exception', [
                'access_code' => $accessCode,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return [
                'success' => false,
                'errors' => [$e->getMessage()],
                'message' => 'Query transaction error'
            ];
        }
    }

    /**
     * Process payment success and update order
     */
    public function processPaymentSuccess(Order $order, array $transactionData): bool
    {
        try {
            $updateData = [
                'payment_status' => 'paid',
                'eway_transaction_id' => $transactionData['transaction_id'],
                'eway_response' => json_encode($transactionData),
                'paid_at' => now(),
            ];

            $order->update($updateData);

            Log::info('Payment Success', [
                'order_id' => $order->id,
                'transaction_id' => $transactionData['transaction_id'],
                'amount' => $transactionData['total_amount']
            ]);

            return true;
        } catch (\Exception $e) {
            Log::error('Payment Success Processing Error', [
                'order_id' => $order->id,
                'error' => $e->getMessage()
            ]);

            return false;
        }
    }

    /**
     * Process payment failure and update order
     */
    public function processPaymentFailure(Order $order, array $errorData): bool
    {
        try {
            $updateData = [
                'payment_status' => 'failed',
                'eway_response' => json_encode($errorData),
            ];

            $order->update($updateData);

            Log::info('Payment Failed', [
                'order_id' => $order->id,
                'errors' => $errorData['errors'] ?? []
            ]);

            return true;
        } catch (\Exception $e) {
            Log::error('Payment Failure Processing Error', [
                'order_id' => $order->id,
                'error' => $e->getMessage()
            ]);

            return false;
        }
    }
}
