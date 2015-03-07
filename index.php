<?php

// include the Composer autoloader
require 'vendor/autoload.php';

$di = new League\Container\Container();
$di->add('League\Container\ContainerInterface', $di, true);
$di->add('League\Container\Container', $di, true);
$stack = new Laasti\Stack\Stack;
$route = new \Laasti\Route\RouteCollection($di);

//$app->addServiceProvider('Laasti\Providers\WhoopsProvider');
$di->addServiceProvider('Laasti\Providers\MonologProvider');
$di->addServiceProvider('Laasti\Renderer\TwigServiceProvider');
$di->addServiceProvider('Laasti\Translation\TranslationServiceProvider');
$di->addServiceProvider('Laasti\Providers\SpotProvider');

$di->add('Laasti\DevEnvironment')->withArgument($di);
$di->add('Laasti\Services\RouteCollectionInterface', 'Laasti\Route\RouteCollection', true)->withArgument($di);
$di->add('Laasti\Services\StackInterface', $stack, true);
$di->add('Laasti\Stack\Stack', $stack, true);

//TODO: Move to some configuration file, maybe?
$di['template_path'] = __DIR__ . '/resources/views';
//$di['twig_cache'] = __DIR__ . '/cache/twig';

$env = new Laasti\Environment\EnvironmentChooser;
$env->addEnvironment($di->get('Laasti\DevEnvironment'));
$stack->push($env);
$stack->push(new Laasti\Route\Middleware\Routing, $route);

/*

  use Symfony\Component\HttpFoundation\Request;
  use Symfony\Component\HttpFoundation\Response;
 */
//$url = new League\Route\UrlGenerator($app->router);
//$url->generate('@hello');
//TODO: have a way to define routes in services
//MethodArgumentStrategy As POPO
$strategy = new League\Route\Strategy\UriStrategy();
$route->setStrategy($strategy);
$route->addRoute('GET', '/', 'Laasti\\Controllers\\HelloWorld::output');
/* $app->getRouter()->addRoute('GET', '/', function() use ($app) {

  $app->get('Laasti\TwigRenderer');
  return 'Test';
  }, $strategy); */
$route->addRoute('GET', '@hello/hello/{name:word}', 'Laasti\\Controllers\\HelloWorld::hello');

$request_obj = $di->get('Symfony\Component\HttpFoundation\Request');
$request = $request_obj::createFromGlobals();

$response = $stack->execute($request);
$response->send();

$stack->close($request, $response);
