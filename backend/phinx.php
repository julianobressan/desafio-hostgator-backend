<?php

require __DIR__ . '/vendor/autoload.php';

$config = include __DIR__ . '/env.php';

return
[
    'paths' => [
        'migrations' => __DIR__ . '/database/migrations',
        'seeds' => __DIR__ . '/database/seeds'
    ],
    'environments' => [
        'default_migration_table' => 'migrations',
        'default_environment' => 'development',
        'production' => [
            'adapter'   => $config['database']['production']['adapter'],
            'host'      => $config['database']['production']['host'],
            'name'      => $config['database']['production']['name'],
            'user'      => $config['database']['production']['user'],
            'pass'      => $config['database']['production']['pass'],
            'port'      => $config['database']['production']['port'],
            'charset'   => $config['database']['production']['charset'],
            'collation' => $config['database']['production']['collation'],
        ],
        'development' => [
            'adapter'   => $config['database']['development']['adapter'],
            'host'      => $config['database']['development']['host'],
            'name'      => $config['database']['development']['name'],
            'user'      => $config['database']['development']['user'],
            'pass'      => $config['database']['development']['pass'],
            'port'      => $config['database']['development']['port'],
            'charset'   => $config['database']['development']['charset'],
            'collation' => $config['database']['development']['collation'],
        ],
        'testing' => [
            'adapter'   => $config['database']['testing']['adapter'],
            'host'      => $config['database']['testing']['host'],
            'name'      => $config['database']['testing']['name'],
            'user'      => $config['database']['testing']['user'],
            'pass'      => $config['database']['testing']['pass'],
            'port'      => $config['database']['testing']['port'],
            'charset'   => $config['database']['testing']['charset'],
            'collation' => $config['database']['testing']['collation'],
        ]
    ],
    'version_order' => 'creation'
];
