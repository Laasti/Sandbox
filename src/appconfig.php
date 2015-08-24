<?php


return [
    'di' => [
    ],
    'providers' => [],
    'middlewares' => [],
    'routes' => [
        ['GET', '/', 'Laasti\\Controllers\\HelloWorld::output'],
        ['GET', '/hello/{name:word}', 'Laasti\\Controllers\\HelloWorld::hello'],
    ]
];