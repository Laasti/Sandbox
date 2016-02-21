<?php

use Laasti\Http\Application;
use Laasti\Http\HttpKernel;
use League\Container\Container;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Zend\Diactoros\Request;
use Zend\Diactoros\Response\HtmlResponse;

if (!defined('PUBLIC_PATH')) {
    exit('Invalid boot up.');
}

require __DIR__.'/../vendor/autoload.php';

//To learn about the basic flow of a Laasti application, see 01-bare
$container = new Container;
$container->add('config', [
    'monolog' => [
        'channels' => [
            'default' => [
                //Default handler in application only writes warnings and above to the SAPI error log file
                //Bug you can overwrite it like we did here
                "Monolog\Handler\ErrorLogHandler" => [\Monolog\Handler\ErrorLogHandler::SAPI, Monolog\Logger::WARNING]
            ],
            'debug' => [
                //You can define multiple channels using different levels of logging
                //Tou could also have multiple handlers in one channel to react differently to different levels
                "Monolog\Handler\BrowserConsoleHandler" => [Monolog\Logger::DEBUG]
            ]
        ]
    ]
]);

//For logging, a key is reserved in the container: "logger"
//You can use any PSR-3 compatible logger
//By default, monolog is the supported logger
$container->addServiceProvider(new \Laasti\Core\Providers\MonologProvider());

//Each channel defined in the configuration is available in this format
//Warning: You have to define your config before add the service provider to ensure proper configuration
$container->get('monolog.channels.debug')->debug('Hello world logged in your browser console.');

$kernel = new HttpKernel(function(RequestInterface $request, ResponseInterface $response) {return $response;});
$app = new Application($container, $kernel);
$app->run(new Request, new HtmlResponse('Open up the browser console'));
