<?php


return [
    'routes' => require 'routes.php',
    'di' => require 'container.php',
    'providers' => [
        'Laasti\Pagination\PaginationProvider',
        'Laasti\ValitronProvider\ValitronProvider',
        'Laasti\SpotProvider\SpotProvider',
        'Laasti\Mailer\MailerProvider',
        'Laasti\FlysystemProvider\FlysystemProvider',
        'Laasti\GregwarImageProvider\GregwarImageProvider',
        'Laasti\SymfonySessionProvider\SymfonySessionProvider',
        'Laasti\SymfonyTranslationProvider\SymfonyTranslationProvider',
    ],
    //'middlewares' => [],
    'config' => [
        'response' => [
            'locations' => [
                getenv('RESOURCES_DIR').'/views/php'
            ]
        ],
        'logger' => [
            'channels' => [
                'default' => [
                    'Monolog\Handler\BrowserConsoleHandler' => [\Monolog\Logger::DEBUG]
                ]
            ]
        ],
        'error_handler' => [
            'formatters' => [
                'League\BooBoo\Formatter\HtmlTableFormatter' => E_ALL
            ],
            'handlers' => [
                //'League\BooBoo\Handler\LogHandler'
            ]
        ],
        'pagination' => [
            'per_page' => 10,
            'base_url' => '',
            'neighbours' => 3
        ],
        'validation' => [
            'locale' => getenv('DEFAULT_LOCALE'),
            'locales_dir' => null,
            'rules' => []
        ],
        'connections' => [
            ['name' => 'default', 'dsn' => getenv('DATABASE_DRIVER')]
        ],
        'flysystem' => [
            'upload' => ['League\Flysystem\Adapter\Local', [getenv('UPLOADS_DIR')]],
            'temp' => ['League\Flysystem\Adapter\Local', [getenv('TEMP_DIR')]],
        ],
        'gregwarImage' => [
            'cache_dir' => getenv('CACHE_DIR').'/imagecache'
        ],
        'translation' => [
            'locale' => getenv('DEFAULT_LOCALE'),
            'fallback_locales' => [],
            'message_selector_class' => 'Symfony\Component\Translation\MessageSelector',
            'loaders' => [
                'array' => 'Symfony\Component\Translation\Loader\ArrayLoader',
                'json' => 'Symfony\Component\Translation\Loader\JsonFileLoader',
                'php' => 'Symfony\Component\Translation\Loader\PhpFileLoader'
            ],
            'resources' => [
                'en' => [
                    ['php', getenv('RESOURCES_DIR').'/languages/en/messages.php']
                ],
                'fr' => [
                    ['php', getenv('RESOURCES_DIR').'/languages/fr/messages.php']
                ],
            ],
        ]
    ]
];