# A simple php router to match with your url's

## Installation

```bash
composer require remysd/simple-router
```

## Example

```php
require './vendor/autoload.php';

use RemySd\SimpleRouter\Router;

$router = new Router();

$router->setBasePath('/simple-router');

$router->addRoute('/articles', 'article', 'all', 'article_all');
$router->addRoute('/articles/{id}', 'article', 'show', 'article_single');

$properties = $router->match($_SERVER['REQUEST_URI']);

```

## Requirements

Minimun configuration required in `.htaccess`

```
RewriteEngine on
RewriteCond %{REQUEST_FILENAME} !-f
RewriteRule . index.php [L]
```