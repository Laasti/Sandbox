<?php

return [
    'Laasti\Lazydata\ResolverInterface' => [
        'class' => 'Laasti\Lazydata\ContainerResolver',
        'arguments' => ['League\Container\ContainerInterface']
    ],
    'Dflydev\DotAccessData\DataInterface' => [
        'class' => 'Laasti\Lazydata\Data',
        'arguments' => [
            require getenv('RESOURCES_DIR').'/viewdata.php', 'Laasti\Lazydata\ResolverInterface'
        ]
    ],
    'Laasti\Sandbox\Controllers\Form' => [
        'class' => 'Laasti\Sandbox\Controllers\Form',
        'arguments' => [
            'Laasti\Response\ResponderInterface',
            'Symfony\Component\HttpFoundation\Session\SessionInterface'
        ],
        'methods' => [
            'setContainer' => ['League\Container\ContainerInterface']
        ]
    ]
];