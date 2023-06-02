<?php

return [
    'hosts' => [
        [
            'host' => env('ELASTICSEARCH_HOST', '127.0.0.1:9200'),
            'user' => env('ELASTICSEARCH_USER', ''),
            'pass' => env('ELASTICSEARCH_PASS', ''),
        ],
    ],
];