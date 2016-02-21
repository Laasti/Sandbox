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
$container->add('config', []);
$container->addServiceProvider(new MonologProvider);
$app = new Application($container);

//So how about routing?
$app->setConfig('directions', [
    'default' => [
        'routes' => [
            //A replica of what we did in 01-bare
            ['GET', '/', function($request, $response) {
                $response->getBody()->write('Hello world!');
                return $response;
            }],
            //You can pass attributes in routes between curly braces
            //Put your name in the address bar and the application will salute you
            ['GET', '/{name}', function($request, $response) {
                $response->getBody()->write(sprintf('Hello %s!', $request->getAttribute('name')));
                return $response;
            }],
        ]
    ]
]);
//By default, laasti/directions is used. A wrapper around nikic's FastRoute that provides additional features.
$container->addServiceProvider('Laasti\Directions\Providers\LeagueDirectionsProvider');
$app->setKernel(new HttpKernel([$container->get('directions.default'), 'findAndDispatch']));
$app->run(ServerRequestFactory::fromGlobals(), new HtmlResponse(''));



