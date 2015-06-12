<?php

define('BASEPATH', __DIR__);

// include the Composer autoloader
require BASEPATH.'/../vendor/autoload.php';

Laasti\Application::loadEnvironment(BASEPATH.'/../');

$config = require __DIR__.'/appconfig.php';
$app = new Laasti\Application($config);

//Start the application
$app->run();
