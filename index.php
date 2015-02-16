<?php


// include the Composer autoloader
require 'vendor/autoload.php';

$container = new League\Container\Container();

$container->add('Symfony\Component\HttpFoundation\Request', function() {
    $request = Symfony\Component\HttpFoundation\Request::createFromGlobals();
    return $request;
}, true);

$request = $container->get('Symfony\Component\HttpFoundation\Request');

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

$router = new League\Route\RouteCollection($container);
$url = new League\Route\UrlGenerator($router);


$router->addRoute('GET', '/acme', function (Request $request, Response $response) { return $response;});
$router->addRoute('GET', '@myroute2/acme/{uri}/{id:number}/{name:word}', function (Request $request, Response $response) { return $response;});
$router->addRoute('GET', '@myroute/acme/route', function (Request $request, Response $response) {    
    // do something clever
    $response->setContent('Hello world') ;
    return $response;
});

$url->generate('myroute');
$url->generate('myroute2', array('id' => 1, 'name' => 'mmamama', 'uri' => 'iusgdif ciubs dsuhb'));

$dispatcher = $router->getDispatcher();

$response = $dispatcher->dispatch($request->getMethod(), $request->getPathInfo());

$response->send();