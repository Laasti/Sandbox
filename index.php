<?php


// include the Composer autoloader
require 'vendor/autoload.php';

$container = new League\Container\Container();
$stack = new Stack\Builder();
$router = new League\Route\RouteCollection($container);

$app = new Laasti\Application($container, $stack, $router);

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

$url = new League\Route\UrlGenerator($app->router);

$app->router->addRoute('GET', '/acme', function (Request $request, Response $response) { return $response;});
$app->router->addRoute('GET', '@myroute2/acme/{uri}/{id:number}/{name:word}', function (Request $request, Response $response) { return $response;});
$app->router->addRoute('GET', '@myroute/acme/route', function (Request $request, Response $response) {    
    // do something clever
    $response->setContent('Hello world') ;
    return $response;
});

$url->generate('myroute');
$url->generate('myroute2', array('id' => 1, 'name' => 'mmamama', 'uri' => 'iusgdif ciubs dsuhb'));

$app->run();