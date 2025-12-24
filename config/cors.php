<?php

return [
    'paths' => [
        'api/*',
        'sanctum/csrf-cookie',
        'images/*',           // Add this
        'portofolio/*',       // Add this
        'sertifikat/*',       // Add this
    ],

    'allowed_methods' => ['*'],

    'allowed_origins' => ['*'],

    'allowed_origins_patterns' => [],

    'allowed_headers' => ['*'],

    'exposed_headers' => [],

    'max_age' => 0,

    'supports_credentials' => false,
];