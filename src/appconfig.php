<?php


return [
    'di' => [
        'FlySystem.config' => [
            'cache' => ['League\Flysystem\Adapter\Local', [__DIR__.'/../cache']],
        ],
        'Spot.driver' => getenv('DATABASE_DRIVER'),
        'Spot.dsn' => getenv('DATABASE_DSN'),
        'GregwarImage.config' => [
            'cache_dir' => __DIR__.'/../cache/images'
        ]
    ],
    'providers' => [],
    'middlewares' => [],
    'routes' => [
        ['GET', '/', 'Laasti\\Controllers\\HelloWorld::output'],
        ['GET', '/hello/{name:word}', 'Laasti\\Controllers\\HelloWorld::hello'],
    ]
];