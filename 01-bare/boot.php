<?php

use Laasti\Http\Application;
use Laasti\Http\HttpKernel;
use League\Container\Container;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Zend\Diactoros\Request;
use Zend\Diactoros\Response\TextResponse;

if (!defined('PUBLIC_PATH')) {
    exit('Invalid boot up.');
}

require __DIR__.'/../vendor/autoload.php';

//First, boot up your container and add a config array to it
//You need to use a Container Interop compatible container or write a bridge
$container = new Container;
$container->add('config', []);

//Then, you need to prepare a kernel that will return a response to output to the browser
//This kernel is the simplest possible, but you can use any callable that accepts a request and a response as arguments
$container->add('kernel', new HttpKernel(function(RequestInterface $request, ResponseInterface $response) {
    //Add the text to the response
    $response->getBody()->write('Hello world!');
    //Return the finale response to the kernel, the kernel will output the response
    return $response;
}));

//Initialize application
$app = new Application($container);

//Finally run the application
//The http application accepts any Http message Request and Response (PSR-7)
$app->run(new Request, new TextResponse(''));

//This is the simplest form a Laasti application can take