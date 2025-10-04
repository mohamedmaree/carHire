<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ __('emails.booking_confirmation_title') }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #f4f4f4;
        }
        .container {
            background-color: #ffffff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        .header {
            text-align: center;
            border-bottom: 2px solid #007bff;
            padding-bottom: 20px;
            margin-bottom: 30px;
        }
        .logo {
            font-size: 24px;
            font-weight: bold;
            color: #007bff;
        }
        .order-id {
            background-color: #007bff;
            color: white;
            padding: 10px 20px;
            border-radius: 5px;
            font-size: 18px;
            font-weight: bold;
            margin: 20px 0;
        }
        .section {
            margin-bottom: 25px;
        }
        .section-title {
            font-size: 18px;
            font-weight: bold;
            color: #007bff;
            margin-bottom: 10px;
            border-bottom: 1px solid #eee;
            padding-bottom: 5px;
        }
        .info-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 8px;
            padding: 5px 0;
        }
        .info-label {
            font-weight: bold;
            color: #555;
        }
        .info-value {
            color: #333;
        }
        .car-image {
            max-width: 200px;
            height: auto;
            border-radius: 5px;
            margin: 10px 0;
        }
        .options-list {
            list-style: none;
            padding: 0;
        }
        .options-list li {
            background-color: #f8f9fa;
            margin: 5px 0;
            padding: 10px;
            border-radius: 5px;
            border-left: 4px solid #007bff;
        }
        .total-amount {
            background-color: #28a745;
            color: white;
            padding: 15px;
            border-radius: 5px;
            text-align: center;
            font-size: 20px;
            font-weight: bold;
            margin: 20px 0;
        }
        .footer {
            text-align: center;
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid #eee;
            color: #666;
            font-size: 14px;
        }
        .status-badge {
            display: inline-block;
            padding: 5px 15px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: bold;
            text-transform: uppercase;
        }
        .status-pending {
            background-color: #ffc107;
            color: #000;
        }
        .status-confirmed {
            background-color: #28a745;
            color: #fff;
        }
        .status-cancelled {
            background-color: #dc3545;
            color: #fff;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <div class="logo">{{ __('emails.car_rental_service') }}</div>
            <h1>{{ __('emails.booking_confirmation_title') }}</h1>
        </div>

        <div class="order-id">
            {{ __('emails.order_number') }}: #{{ $order->id }}
        </div>

        <div class="section">
            <div class="section-title">{{ __('emails.customer_information') }}</div>
            <div class="info-row">
                <span class="info-label">{{ __('emails.customer_name') }}:</span>
                <span class="info-value">{{ $order->first_name }} {{ $order->last_name }}</span>
            </div>
            <div class="info-row">
                <span class="info-label">{{ __('emails.email') }}:</span>
                <span class="info-value">{{ $order->email }}</span>
            </div>
            <div class="info-row">
                <span class="info-label">{{ __('emails.phone') }}:</span>
                <span class="info-value">{{ $order->phone }}</span>
            </div>
            @if($order->customer_age)
            <div class="info-row">
                <span class="info-label">{{ __('emails.age') }}:</span>
                <span class="info-value">{{ $order->customer_age }}</span>
            </div>
            @endif
        </div>

        <div class="section">
            <div class="section-title">{{ __('emails.car_information') }}</div>
            @if($order->car)
            <div class="info-row">
                <span class="info-label">{{ __('emails.car_name') }}:</span>
                <span class="info-value">{{ $order->car->name }}</span>
            </div>
            @if($order->car->image)
            <img src="{{ $order->car->image }}" alt="{{ $order->car->name }}" class="car-image">
            @endif
            @endif
        </div>

        <div class="section">
            <div class="section-title">{{ __('emails.rental_details') }}</div>
            <div class="info-row">
                <span class="info-label">{{ __('emails.pickup_date') }}:</span>
                <span class="info-value">{{ $order->pickup_date ? $order->pickup_date->format('Y-m-d') : '-' }}</span>
            </div>
            <div class="info-row">
                <span class="info-label">{{ __('emails.pickup_time') }}:</span>
                <span class="info-value">{{ $order->pickup_time }}</span>
            </div>
            <div class="info-row">
                <span class="info-label">{{ __('emails.return_date') }}:</span>
                <span class="info-value">{{ $order->return_date ? $order->return_date->format('Y-m-d') : '-' }}</span>
            </div>
            <div class="info-row">
                <span class="info-label">{{ __('emails.return_time') }}:</span>
                <span class="info-value">{{ $order->return_time }}</span>
            </div>
            <div class="info-row">
                <span class="info-label">{{ __('emails.rental_days') }}:</span>
                <span class="info-value">{{ $order->rental_days }} {{ __('emails.days') }}</span>
            </div>
        </div>

        <div class="section">
            <div class="section-title">{{ __('emails.location_information') }}</div>
            <div class="info-row">
                <span class="info-label">{{ __('emails.pickup_location') }}:</span>
                <span class="info-value">
                    @if($order->pickupLocation)
                        {{ $order->pickupLocation->name }}
                    @elseif($order->pickup_address)
                        {{ $order->pickup_address }}
                    @else
                        -
                    @endif
                </span>
            </div>
            <div class="info-row">
                <span class="info-label">{{ __('emails.return_location') }}:</span>
                <span class="info-value">
                    @if($order->same_return_location)
                        {{ __('emails.same_as_pickup') }}
                    @elseif($order->returnLocation)
                        {{ $order->returnLocation->name }}
                    @elseif($order->return_address)
                        {{ $order->return_address }}
                    @else
                        -
                    @endif
                </span>
            </div>
        </div>

        @if($order->options && $order->options->count() > 0)
        <div class="section">
            <div class="section-title">{{ __('emails.selected_options') }}</div>
            <ul class="options-list">
                @foreach($order->options as $option)
                <li>
                    <strong>{{ $option->name }}</strong>
                    @if($option->pivot->quantity > 1)
                        ({{ $option->pivot->quantity }} {{ __('emails.quantity') }})
                    @endif
                    - {{ $option->formatted_price }}
                </li>
                @endforeach
            </ul>
        </div>
        @endif

        <div class="section">
            <div class="section-title">{{ __('emails.payment_information') }}</div>
            <div class="info-row">
                <span class="info-label">{{ __('emails.subtotal') }}:</span>
                <span class="info-value">${{ number_format($order->subtotal_amount, 2) }}</span>
            </div>
            @if($order->coupon_discount_amount > 0)
            <div class="info-row">
                <span class="info-label">{{ __('emails.discount') }}:</span>
                <span class="info-value">-${{ number_format($order->coupon_discount_amount, 2) }}</span>
            </div>
            @endif
            <div class="total-amount">
                {{ __('emails.total_amount') }}: ${{ number_format($order->total_amount, 2) }}
            </div>
        </div>

        <div class="section">
            <div class="section-title">{{ __('emails.order_status') }}</div>
            <div class="info-row">
                <span class="info-label">{{ __('emails.status') }}:</span>
                <span class="info-value">
                    <span class="status-badge status-{{ strtolower($order->order_status->value) }}">
                        {{ $order->order_status->getLabel() }}
                    </span>
                </span>
            </div>
            <div class="info-row">
                <span class="info-label">{{ __('emails.payment_status') }}:</span>
                <span class="info-value">
                    <span class="status-badge status-{{ strtolower($order->payment_status->value) }}">
                        {{ $order->payment_status->getLabel() }}
                    </span>
                </span>
            </div>
        </div>

        @if($order->notes)
        <div class="section">
            <div class="section-title">{{ __('emails.notes') }}</div>
            <p>{{ $order->notes }}</p>
        </div>
        @endif

        <div class="footer">
            <p>{{ __('emails.thank_you_message') }}</p>
            <p>{{ __('emails.contact_support') }}</p>
            <p>{{ __('emails.email_footer') }}</p>
        </div>
    </div>
</body>
</html>
