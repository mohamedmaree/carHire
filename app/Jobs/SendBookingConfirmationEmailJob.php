<?php

namespace App\Jobs;

use App\Models\Order;
use App\Mail\BookingConfirmationMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

class SendBookingConfirmationEmailJob implements ShouldQueue
{
    use Queueable, InteractsWithQueue, SerializesModels;

    public $orderId;
    public $tries = 3; // Number of attempts if job fails
    public $timeout = 60; // Timeout in seconds

    /**
     * Create a new job instance.
     */
    public function __construct($orderId)
    {
        $this->orderId = $orderId;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        try {
            // Load the order with all necessary relationships
            $order = Order::with(['car', 'pickupLocation', 'returnLocation', 'pricePackage', 'options'])
                ->find($this->orderId);

            if (!$order) {
                Log::error("Order not found for email job: {$this->orderId}");
                return;
            }

            // Send the booking confirmation email
            Mail::to($order->email)->send(new BookingConfirmationMail($order));
            
            Log::info("Booking confirmation email sent successfully for order: {$this->orderId}");
            
        } catch (\Exception $e) {
            Log::error("Failed to send booking confirmation email for order {$this->orderId}: " . $e->getMessage());
            
            // Re-throw the exception to trigger job retry
            throw $e;
        }
    }

    /**
     * Handle a job failure.
     */
    public function failed(\Throwable $exception): void
    {
        Log::error("Booking confirmation email job failed permanently for order {$this->orderId}: " . $exception->getMessage());
    }
}
