<?php


return [
    //'di' => [],
    //'providers' => [],
    //'middlewares' => [],
    'routes' => [
        ['GET', '/', 'Laasti\Dist\Controllers\HelloWorld::welcome'],
        ['GET', '/hello/{name:word}', 'Laasti\Dist\Controllers\HelloWorld::hello'],
    ]
];