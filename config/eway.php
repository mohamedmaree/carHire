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

    'api_key' => env('EWAY_API_KEY','60CF3AcGPEpUR+lRy0y4bA4vIM1Dz4nnrpiHbZqM/spF6/cWJ7K6S8g6vqDqu8lyaW9CIY'),
    // test: 60CF3Ce97nRS1Z1Wp5m9kMmzHHEh8Rkuj31QCtVxjPWGYA9FymyqsK0Enm1P6mHJf0THbR live: 60CF3AcGPEpUR+lRy0y4bA4vIM1Dz4nnrpiHbZqM/spF6/cWJ7K6S8g6vqDqu8lyaW9CIY
    
    'api_password' => env('EWAY_API_PASSWORD', '4FuLgHiD0ViUX8H'),
    // test: API-P4ss live: 4FuLgHiD0ViUX8H
    
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
