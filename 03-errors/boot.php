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

//In a Laasti application, error reporting is sensible to the server configuration
//If you change the value to 0 here and refresh no errors will be shown
ini_set('display_errors', 1);

//We'll skip the boot up explained in 01-bare folder
$container = new Container;
$container->add('config', []);
$container->add('kernel', new HttpKernel(function(RequestInterface $request, ResponseInterface $response) {return $response;}));
$app = new Application($container);
$app->run(new Request, new HtmlResponse(''));

//To handle errors, a key is reserved in the container: "error_handler"
//Register a callable to this key to override default behavior
//By default support for league/booboo is provided automatically in the application
//Errors are shown in a table like XDEBUG and non fatal errors do not stop the script
trigger_error('Some notice', E_USER_NOTICE);
trigger_error('Deprecated warning', E_USER_DEPRECATED);
trigger_error('Deprecated warning', E_USER_DEPRECATED);

//Fatal errors and uncaught exceptions stop the script
//throw new Exception('Exception');
trigger_error('A fatal error', E_USER_ERROR);


