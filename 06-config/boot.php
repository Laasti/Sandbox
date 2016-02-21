<?php

use Laasti\Core\Providers\MonologProvider;
use Laasti\Http\Application;
use Laasti\Http\HttpKernel;
use League\Container\Container;
use Zend\Diactoros\Response\HtmlResponse;
use Zend\Diactoros\ServerRequestFactory;

if (!defined('PUBLIC_PATH')) {
    exit('Invalid boot up.');
}

require __DIR__.'/../vendor/autoload.php';

//We'll skip the boot up explained in 01-bare folder
$container = new Container;
$container->share('Interop\Container\ContainerInterface', $container);
//Can also be a folder
$container->add('config_files', [__DIR__.'/config.php']);
$container->addServiceProvider(new Laasti\Core\Providers\ConfigFilesProvider());
$app = new Application($container, new HttpKernel(function($request, $response) {return $response;}));
$app->run(ServerRequestFactory::fromGlobals(), new HtmlResponse('Nothing'));



