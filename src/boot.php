<?php

define('BASEPATH', __DIR__);

// include the Composer autoloader
require BASEPATH.'/../vendor/autoload.php';

$app = new Laasti\Application();

//Instantiate application services
$stack = $app->getStack();
$router = $app->getRouter();

//Prepare middleware stack
$stack->push('Laasti\Route\Middlewares\RouteMiddleware');
$stack->push('Laasti\Route\Middlewares\ControllerMiddleware');

//Setup routes
$router->create('GET', '/', 'Laasti\\Controllers\\HelloWorld::output');
$router->create('GET', '/hello/{name:word}', 'Laasti\\Controllers\\HelloWorld::hello');

//Start the application
$app->run();
