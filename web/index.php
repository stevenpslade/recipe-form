<?php

require('../vendor/autoload.php');
require('header.php');


$app = new Silex\Application();
$app['debug'] = true;

// Register the monolog logging service
$app->register(new Silex\Provider\MonologServiceProvider(), array(
  'monolog.logfile' => 'php://stderr',
));

// // Our web handlers!

// $app->run();

echo "test";
