<?php

declare(strict_types=1);

return [

    /*
    |--------------------------------------------------------------------------
    | EasyPanel Base URL
    |--------------------------------------------------------------------------
    |
    | This is the base URL of your EasyPanel installation. This should include
    | the full URL including the protocol (http/https) and port if needed.
    |
    | Example: https://your-easypanel-domain.com
    |
    */

    'base_url' => env('EASYPANEL_BASE_URL'),

    /*
    |--------------------------------------------------------------------------
    | API Authentication Token
    |--------------------------------------------------------------------------
    |
    | Your EasyPanel API authentication token. You can get this token by
    | logging into your EasyPanel instance and generating an API token
    | from the settings or by using the auth.login endpoint.
    |
    */

    'auth_token' => env('EASYPANEL_AUTH_TOKEN'),

    /*
    |--------------------------------------------------------------------------
    | Request Timeout
    |--------------------------------------------------------------------------
    |
    | The maximum time in seconds to wait for API responses. Adjust this
    | based on your server's performance and network conditions.
    |
    */

    'timeout' => env('EASYPANEL_TIMEOUT', 30),

    /*
    |--------------------------------------------------------------------------
    | SSL Verification
    |--------------------------------------------------------------------------
    |
    | Whether to verify SSL certificates when making API requests.
    | You may want to disable this for development environments
    | with self-signed certificates.
    |
    */

    'verify_ssl' => env('EASYPANEL_VERIFY_SSL', true),

    /*
    |--------------------------------------------------------------------------
    | Retry Configuration
    |--------------------------------------------------------------------------
    |
    | Configuration for API request retries when they fail.
    |
    */

    'retry' => [
        'times' => env('EASYPANEL_RETRY_TIMES', 3),
        'sleep' => env('EASYPANEL_RETRY_SLEEP', 1000), // milliseconds
    ],

    /*
    |--------------------------------------------------------------------------
    | Cache Configuration
    |--------------------------------------------------------------------------
    |
    | Configuration for caching API responses to improve performance.
    |
    */

    'cache' => [
        'enabled' => env('EASYPANEL_CACHE_ENABLED', false),
        'ttl' => env('EASYPANEL_CACHE_TTL', 300), // 5 minutes
        'prefix' => env('EASYPANEL_CACHE_PREFIX', 'easypanel'),
    ],

];
