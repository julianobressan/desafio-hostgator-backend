<?php

return [
    'environment' => 'development',
    'app_name' => 'Desafio HostGator',
    'frontend_address' => 'http://localhost:3001',
    'database' => [
        'development' => [
            'adapter' => 'mysql',
            'host' => 'database',
            'name' => 'docker',
            'user' => 'root',
            'pass' => 'root',
            'port' => '3306',
            'charset' => 'utf8',
            'collation' => 'utf8_unicode_ci'
        ],
        'testing' => [
            'adapter' => 'mysql',
            'host' => '',
            'name' => '',
            'user' => '',
            'pass' => '',
            'port' => '3306',
            'charset' => 'utf8',
            'collation' => 'utf8_unicode_ci'
        ],
        'production' => [
            'adapter' => 'mysql',
            'host' => '',
            'name' => '',
            'user' => '',
            'pass' => '',
            'port' => '3306',
            'charset' => 'utf8',
            'collation' => 'utf8_unicode_ci'
        ]
    ],
];
