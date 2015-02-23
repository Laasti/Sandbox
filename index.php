<?php

// include the Composer autoloader
require 'vendor/autoload.php';

$app = new Laasti\Application();

$app->addServiceProvider('Laasti\Providers\WhoopsProvider');
$app->addServiceProvider('Laasti\Providers\MonologProvider');

$app->add('Whoops\Handler\HandlerInterface', function() {
    $handler = new Whoops\Handler\PrettyPageHandler;
    $handler->setPageTitle("Whoops! There was a problem.");

    return $handler;
});

$app->addMiddleware('Laasti\Middleware\Environment', $app);
$app->addMiddleware('Laasti\Middleware\Routing', $app);

/*

  use Symfony\Component\HttpFoundation\Request;
  use Symfony\Component\HttpFoundation\Response;
 */
//$url = new League\Route\UrlGenerator($app->router);
//$url->generate('@hello');
//TODO: have a way to define routes in services
$app->getRouter()->addRoute('GET', '/', 'Laasti\\Controllers\\HelloWorld::output');
$app->getRouter()->addRoute('GET', '@hello/hello/{name:word}', 'Laasti\\Controllers\\HelloWorld::hello');


$app->run();
