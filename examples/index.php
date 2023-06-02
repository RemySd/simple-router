<?php

require './../vendor/autoload.php';

use RemySd\SimpleRouter\Router;

$router = new Router();
$router->setBasePath('');

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
echo json_encode($properties);
echo '<br>';

echo $router->generate('all_article');
echo '<br>';

echo $router->generate('single_article', ['id' => 3]);
echo '<br>';

echo $router->generate(
    'all_articles_by_categories',
    ['categoriesId' => 'decorations', 'articleId' => 10]
);