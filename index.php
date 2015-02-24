<?php

// include the Composer autoloader
require 'vendor/autoload.php';

$app = new Laasti\Application();

$app->addServiceProvider('Laasti\Providers\WhoopsProvider');
$app->addServiceProvider('Laasti\Providers\MonologProvider');
$app->addServiceProvider('Laasti\Providers\TwigProvider');

$app->add('Whoops\Handler\HandlerInterface', function() {
    $handler = new Whoops\Handler\PrettyPageHandler;
    $handler->setPageTitle("Whoops! There was a problem.");

    return $handler;
});

//TODO: Move to some configuration file, maybe?
$app['template_path'] = __DIR__.'/resources/views';

$app->addMiddleware('Laasti\Middleware\Environment', $app);
$app->addMiddleware('Laasti\Middleware\Routing', $app);

/*

  use Symfony\Component\HttpFoundation\Request;
  use Symfony\Component\HttpFoundation\Response;
 */
//$url = new League\Route\UrlGenerator($app->router);
//$url->generate('@hello');
//TODO: have a way to define routes in services
//MethodArgumentStrategy As POPO
$strategy = new League\Route\Strategy\UriStrategy();
$app->getRouter()->addRoute('GET', '/', 'Laasti\\Controllers\\HelloWorld::output', $strategy);
/*$app->getRouter()->addRoute('GET', '/', function() use ($app) {

    $app->get('Laasti\TwigRenderer');
    return 'Test';
}, $strategy);*/
$app->getRouter()->addRoute('GET', '@hello/hello/{name:word}', 'Laasti\\Controllers\\HelloWorld::hello', $strategy);


$app->run();
