<?php

return [
    'params' => [

    ],
    'components' => [
        'routes' => [
            '/' => ['SiteController', 'index'],
            '/transaction' => ['SiteController', 'transaction'],

            '/login' => ['AuthController', 'login'],
            '/logout' => ['AuthController', 'logout'],
        ],
        'assets' => [
            'css' => [
                'main' => '/css/main.css'
            ],
        ],
        'db' => [
            'dsn' => 'mysql:host=localhost;dbname=bit',
            'user' => 'root',
            'password' => 'hedin'
        ],
        'auth' => [
            'users' => [
                'class' => '\app\model\storage\UserStorage'
            ]
        ]
    ]
];