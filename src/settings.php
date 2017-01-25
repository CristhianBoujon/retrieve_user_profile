<?php
return [
    'settings' => [
        'displayErrorDetails' => true, // set to false in production
        'addContentLengthHeader' => false, // Allow the web server to send the content-length header

        // Renderer settings
        'renderer' => [
            'template_path' => __DIR__ . '/../templates/',
        ],

        // Monolog settings
        'logger' => [
            'name' => 'slim-app',
            'path' => __DIR__ . '/../logs/app.log',
            'level' => \Monolog\Logger::DEBUG,
        ],

        // Facebook settings
        'fbSettings' => [
            'app_id' => '',
            'app_secret' => '',
            'default_graph_version' => 'v2.8',
            'http_client_handler' => 'stream'
        ],

        // Server
        'server' => 'http://0.0.0.0:8888/'
    ],
];
