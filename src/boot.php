<?php

define('BASEPATH', __DIR__);

// include the Composer autoloader
require BASEPATH.'/../vendor/autoload.php';

//Load Environment
$dotenv = new Dotenv\Dotenv(BASEPATH.'/../');
$dotenv->load();

$app = new Laasti\Application\Application(require __DIR__.'/config.php');
$app->inflector('League\Container\ContainerAwareTrait')
          ->invokeMethod('setContainer', [$app]);
//Start the application
$app->run();