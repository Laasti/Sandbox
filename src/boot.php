<?php

define('BASEPATH', __DIR__);

// include the Composer autoloader
require '../vendor/autoload.php';

//Instantiate application services
$di = new League\Container\Container();
$stack = new Laasti\Stack\ContainerStack($di);
$route = new League\Route\RouteCollection($di);
$router = new Laasti\Route\RouteCollector('', $route, $di);
$route->setStrategy($di->get('Laasti\Route\Strategies\RouteStrategy'));
//Add dependencies
$di->add('League\Route\RouteCollection', $route);
$di->add('Laasti\Stack\StackInterface', $stack);
$di->add('Laasti\Stack\Stack', $stack);
$di->add('Symfony\Component\HttpFoundation\Request', Symfony\Component\HttpFoundation\Request::createFromGlobals());

//Prepare middleware stack
$stack->push('Laasti\Route\Middlewares\RouteMiddleware');
$stack->push('Laasti\Route\Middlewares\ControllerMiddleware');

//Setup routes
$router->create('GET', '/', 'Laasti\\Controllers\\HelloWorld::output');
$router->create('GET', '/hello/{name:word}', 'Laasti\\Controllers\\HelloWorld::hello');

//Start the application
$request = $di->get('Symfony\Component\HttpFoundation\Request');


$response = $stack->execute($request);
$response->send();

$stack->close($request, $response);
