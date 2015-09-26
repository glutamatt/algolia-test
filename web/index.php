<?php


require_once '../vendor/autoload.php';
$config = require_once '../config.php';

use AlgoliaTest\Controller\FrontController;
use AlgoliaTest\Lib\Application;

$app = new Application($config);
new FrontController($app);
$response = $app->run();
$response->send();
