<?php

return [
    /*
    |--------------------------------------------------------------------------
    | eWAY Payment Gateway Configuration
    |--------------------------------------------------------------------------
    |
    | Configuration for eWAY payment gateway integration.
    | You can get your API credentials from eWAY Partner Account.
    |
    */

    'api_key' => env('EWAY_API_KEY','A1001AewIlusxj/ZagqK5b7i5iiOmklSWi8h5M+8h8Nuc74vx+cT0k7qMQi+0l8xUI9Lha'),// 60CF3Ce97nRS1Z1Wp5m9kMmzHHEh8Rkuj31QCtVxjPWGYA9FymyqsK0Enm1P6mHJf0THbR
    
    'api_password' => env('EWAY_API_PASSWORD', 'NboqkJZW'),// API-P4ss
    
    'api_endpoint' => env('EWAY_API_ENDPOINT', 'Production'), // 'Sandbox' or 'Production'
    
    /*
    |--------------------------------------------------------------------------
    | Payment URLs
    |--------------------------------------------------------------------------
    |
    | URLs for payment success and cancel redirects
    |
    */
    
    'success_url' => env('EWAY_SUCCESS_URL', '/payment/success'),
    
    'cancel_url' => env('EWAY_CANCEL_URL', '/payment/cancel'),
    
    /*
    |--------------------------------------------------------------------------
    | Currency Configuration
    |--------------------------------------------------------------------------
    |
    | Default currency for payments
    |
    */
    
    'currency' => env('EWAY_CURRENCY', 'AUD'),
    
    /*
    |--------------------------------------------------------------------------
    | Logging Configuration
    |--------------------------------------------------------------------------
    |
    | Enable/disable payment logging
    |
    */
    
    'log_payments' => env('EWAY_LOG_PAYMENTS', true),
];
