<?php declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use RemySd\SimpleRouter\Router;

final class SimpleRouterTest extends TestCase
{
    public function testRouteMatch(): void
    {
        $router = new Router();
        $router->addRoute('/my-route', 'aController', 'anAction', 'my_route');

        $match = $router->match('/my-route');
        $this->assertSame('my_route', $match['name']);
    }

    public function testRouteNotMatch(): void
    {
        $router = new Router();
        $router->addRoute('/test', 'aController', 'anAction', 'test');

        $match = $router->match('/test-wrong');
        $this->assertNull($match);
    }

    public function testRouteGenerate(): void
    {
        $router = new Router();
        $router->addRoute('/my-custom-route', 'aController', 'anAction', 'my_route');

        $url = $router->generate('my_route');
        $this->assertSame('/my-custom-route', $url);
    }
}