<?php

define('BASEPATH', __DIR__);

// include the Composer autoloader
require 'vendor/autoload.php';

//Instantiate application services
$di = new League\Container\Container();
$stack = new Laasti\Stack\Stack;
$route = new League\Route\RouteCollection($di);

//Register other services
$di->addServiceProvider('Laasti\TwigProvider\TwigServiceProvider');

//Add dependencies
$di->add('Laasti\DevEnvironment')->withArgument($di);
$di->add('League\Route\RouteCollection', $route);
$di->add('Laasti\Services\StackInterface', $stack);
$di->add('Laasti\Stack\Stack', $stack);
$di->add('Laasti\TwigProvider\TwigConfig', new Laasti\Config\TwigConfig);
$di->add('Symfony\Component\HttpFoundation\Request', Symfony\Component\HttpFoundation\Request::createFromGlobals());

//Set up environments
$env = new Laasti\Environment\EnvironmentChooser;
$env->addEnvironment($di->get('Laasti\DevEnvironment'));

//Prepare middleware stack
$stack->push(new Laasti\Environment\EnvironmentMiddleware, $env);
$stack->push(new Laasti\Route\RouteMiddleware, $route);

//Setup routes
$strategy = new League\Route\Strategy\UriStrategy();
$route->setStrategy($strategy);
$route->addRoute('GET', '/', 'Laasti\\Controllers\\HelloWorld::output');
$route->addRoute('GET', '@hello/hello/{name:word}', 'Laasti\\Controllers\\HelloWorld::hello');

//Start the application
$request = $di->get('Symfony\Component\HttpFoundation\Request');

$response = $stack->execute($request);
$response->send();

$stack->close($request, $response);
