<?php

use Laasti\Core\Providers\MonologProvider;
use Laasti\Http\Application;
use Laasti\Http\HttpKernel;
use League\Container\Container;
use Zend\Diactoros\Response\HtmlResponse;
use Zend\Diactoros\ServerRequestFactory;

if (!defined('PUBLIC_PATH')) {
    exit('Invalid boot up.');
}

require __DIR__.'/../vendor/autoload.php';

//We'll skip the boot up explained in 01-bare folder
$container = new Container;
$container->share('Interop\Container\ContainerInterface', $container);
$container->add('config', []);
$container->addServiceProvider(new MonologProvider);
$app = new Application($container);
$app->setConfig('directions', [
    'default' => [
        'strategy' => 'Laasti\Directions\Strategies\PeelsStrategy',
        'routes' => [
            ['GET', '/', function($request, $response) {
                $response->getBody()->write('Hello world!');
                return $response;
            }],
        ]
    ]
]);
$container->addServiceProvider('Laasti\Directions\Providers\LeagueDirectionsProvider');
$container->addServiceProvider('Laasti\Peels\Providers\LeaguePeelsProvider');
//And now middlewares
$app->setConfig('peels', [
    'http' => [
        'runner' => 'Laasti\Peels\Http\HttpRunner',
        'middlewares' => [
            function($request, $response, $next) {
                //Add some stuff to the response before the controller
                $response->getBody()->write("First (Before controller)<br/>");
                return $next($request, $response);
            },
            function($request, $response, $next) {
                //By calling next before you can modify the response after the controller
                $response = $next($request, $response);
                $response->getBody()->write("<br/>Second (after controller)");
                return $response;
            },
            //You can use anything registered to your container
            'directions.default::findAndDispatch',
        ]
    ]
]);
$router = $container->get('directions.default');

//And more middlewares, they can be specific to a route
$router->add('GET', '/route-middleware', function($request, $response) {
    $response->getBody()->write('Hello world!');
    return $response;
})->pushMiddleware(function($request, $response, $next) {
    $response->getBody()->write("First route middleware (Before controller)<br/>");
    return $next($request, $response);
})->pushMiddleware(function($request, $response, $next) {
    $response = $next($request, $response);
    $response->getBody()->write("<br/>Second route middleware (after controller)");
    return $response;
});
            
//By default, laasti/directions is used. A wrapper around nikic's FastRoute that provides additional features.
$app->setKernel(new HttpKernel($container->get('peels.http')->create()));
$app->run(ServerRequestFactory::fromGlobals(), new HtmlResponse(''));



