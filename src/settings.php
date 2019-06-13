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
            'name' => 'UTN FRA LOGGER',
            'path' => isset($_ENV['docker']) ? 'php://stdout' : __DIR__ . '/../logs/app.log',
            'level' => \Monolog\Logger::DEBUG,
        ],
         // Monolog settings
        'IPlogger' => [
            'name' => 'UTN FRA LOGGER',
            'path' => isset($_ENV['docker']) ? 'php://stdout' : __DIR__ . '/../logs/ip.log',
            'level' => \Monolog\Logger::DEBUG,
        ],

        // eloquent settings
        'db' => [
           'driver' => 'mysql',
            'host' => 'localhost',
            'database' => 'cdcol',
            'username' => 'root',
            'password' => '',
            'charset'   => 'utf8',
            'collation' => 'utf8_unicode_ci',
            'prefix'    => '',
        ],

    ],
];
