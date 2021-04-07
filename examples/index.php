<?php

require './../vendor/autoload.php';

use RemySd\SimpleRouter\Router;

$router = new Router();

$router->setBasePath('/simple-router/examples');

$router->addRoute('/', 'home', 'index', 'homepage');
$router->addRoute('/articles', 'article', 'all', 'all_article');
$router->addRoute('/articles/{id}', 'article', 'show', 'single_article');
$router->addRoute(
    '/categories/{categoriesId}/articles/{articleId}',
    'article',
    'showByCategory',
    'all_articles_by_categories'
);

$properties = $router->match($_SERVER['REQUEST_URI']);

var_dump($properties);

var_dump($router->generate('all_article'));
var_dump($router->generate('single_article', ['id' => 3]));
var_dump($router->generate(
    'all_articles_by_categories',
    ['categoriesId' => 'decorations', 'articleId' => 10]
));