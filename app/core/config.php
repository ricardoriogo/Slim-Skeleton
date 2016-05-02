<?php
return [
    'settings' => [
        'displayErrorDetails' => (defined('DEVENV') && DEVENV ? true : false),

        // View settings
        'views' => [
            'path' => APPDIR . '/views/',
            'cache' => false,
        ],

        // Monolog settings
        'logger' => [
            'name' => 'slim-app',
            'path' => APPDIR . '/logs/app.log',
        ],
    ],
];
