<?php


return [
    'config' => [
        'response' => [
            'locations' => [
                __DIR__.'/../resources/views'
            ]
        ]
    ],
    //'di' => [],
    //'providers' => [],
    //'middlewares' => [],
    'routes' => [
        ['GET', '/', 'Laasti\Dist\Controllers\HelloWorld::welcome'],
        ['GET', '/template/{name:word}', 'Laasti\Dist\Controllers\Template::display'],
    ]
];