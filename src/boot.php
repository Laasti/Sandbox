<?php

define('BASEPATH', __DIR__);

// include the Composer autoloader
require BASEPATH.'/../vendor/autoload.php';

//Load Environment
$dotenv = new Dotenv\Dotenv(BASEPATH.'/../');
$dotenv->load();

$config = require __DIR__.'/appconfig.php';
$app = new Laasti\Application\Application($config);

//Start the application
$app->run();
