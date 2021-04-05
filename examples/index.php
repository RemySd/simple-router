<?php

require './../vendor/autoload.php';

use RemySd\SimpleRouter\Router;

$router = new Router();

$router->setBasePath('/simple-router/examples');

$router->addRoute('/', 'home', 'index', 'homepage');
$router->addRoute('/articles', 'article', 'all', 'article_all');
$router->addRoute('/articles/{id}', 'article', 'show', 'article_single');

$properties = $router->match($_SERVER['REQUEST_URI']);

var_dump($properties);
