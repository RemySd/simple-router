<?php

require './vendor/autoload.php';

use App\Router;

$router = new Router();

var_dump($_SERVER['REQUEST_URI']);

$router->setBasePath('/simple-router');

$router->addRoute('/test', 'test', 'test', 'test');
$router->addRoute('/test/{id}', 'test', 'testShow', 'test_show');

var_dump($router->match($_SERVER['REQUEST_URI']));
