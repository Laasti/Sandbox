<?php

// include the Composer autoloader
require 'vendor/autoload.php';

$app = new Laasti\Application();

//$app->addServiceProvider('Laasti\Providers\WhoopsProvider');
$app->addServiceProvider('Laasti\Providers\MonologProvider');
$app->addServiceProvider('Laasti\Renderer\TwigServiceProvider');
$app->addServiceProvider('Laasti\Translation\TranslationServiceProvider');
$app->addServiceProvider('Laasti\Providers\SpotProvider');

$app->add('Laasti\DevEnvironment')->withArgument($app);
$app->add('Laasti\Services\RouteCollectionInterface', 'Laasti\Route\RouteCollection', true)->withArgument($app);
$app->add('Laasti\Services\StackInterface', 'Laasti\Stack\Stack', true);

//TODO: Move to some configuration file, maybe?
$app['template_path'] = __DIR__ . '/resources/views';
$app['twig_cache'] = __DIR__ . '/cache/twig';

$env = new Laasti\Environment\EnvironmentChooser;
$env->addEnvironment($app->get('Laasti\DevEnvironment'));
$app->getStack()->push($env);
$app->getStack()->push(new Laasti\Route\Middleware\Routing, $app->getRoutes());

/*

  use Symfony\Component\HttpFoundation\Request;
  use Symfony\Component\HttpFoundation\Response;
 */
//$url = new League\Route\UrlGenerator($app->router);
//$url->generate('@hello');
//TODO: have a way to define routes in services
//MethodArgumentStrategy As POPO
$strategy = new League\Route\Strategy\UriStrategy();
$app->getRoutes()->addRoute('GET', '/', 'Laasti\\Controllers\\HelloWorld::output', $strategy);
/* $app->getRouter()->addRoute('GET', '/', function() use ($app) {

  $app->get('Laasti\TwigRenderer');
  return 'Test';
  }, $strategy); */
$app->getRoutes()->addRoute('GET', '@hello/hello/{name:word}', 'Laasti\\Controllers\\HelloWorld::hello', $strategy);

$app->run();