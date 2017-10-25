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
            'path' => isset($_ENV['docker']) ? 'php://stdout' : __DIR__ . '/../logs/app.log',
            'level' => \Monolog\Logger::DEBUG,
        ],

        // Database settings
        'database_default' => [
            'dbhost' => 'localhost',
            'dbname' => 'dosisun1_fuentesdb',
            'dbuser' => 'dosisun1_root',
            'dbpasswd' => '123.qwerty'
        ],

        //Mailer settings
        'mailer' => [
            'Host' => 'arauca.tepuyserver.net',
            'SMTPAuth' => true,
            'Username' => 'ezerpa@dosisunitarias.com',
            'Password' => '201619duv',
            'SMTPSecure' => 'tls',
            'Port' => 25,
            'MailerMail' => 'ezerpa@dosisunitarias.com',
            'MailerName' => 'Dosimatic',
            'ReplyToMail' => 'ezerpa@dosisunitarias.com',
            'ReplyToName' => 'Información'
        ],
    ],
];
