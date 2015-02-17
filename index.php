<?php


// include the Composer autoloader
require 'vendor/autoload.php';

$container = new League\Container\Container();
$stack = new Stack\Builder();
$router = new League\Route\RouteCollection($container);

$app = new Laasti\Application($container, $stack, $router);

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

//$url = new League\Route\UrlGenerator($app->router);
//$url->generate('@hello');

$app->router->addRoute('GET', '/', 'Laasti\\Controllers\\HelloWorld::output');
$app->router->addRoute('GET', '@hello/hello/{name:word}', 'Laasti\\Controllers\\HelloWorld::hello');


$app->run();