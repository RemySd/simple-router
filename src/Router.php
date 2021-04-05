<?php

namespace App;

class Router
{
    private $routes = [];
    private $basePath;

    public function setBasePath(string $basePath): void
    {
        $this->basePath = $basePath;
    }

    /**
     * Create a new route with a name and a controller/action
     */
    public function addRoute(string $url, string $controller, string $action, string $name): void
    {
        $this->routes[] = [
            'url' => $url,
            'controller' => $controller,
            'action' => $action,
            'name' => $name
        ];
    }

    public function match(string $url): bool
    {
        $basePathExplode = explode('/', $this->basePath);
        $currentTerm = explode('/', $url);
        $currentTerm = array_values(array_filter($currentTerm));

        foreach ($this->routes as $route) {

            $terms = array_merge($basePathExplode, explode('/', $route['url']));
            $terms = array_values(array_filter($terms));

            if (count($terms) !== count($currentTerm)) {
                continue;
            }

            $isMatched = true;
            for ($i = 0; $i < count($terms); $i++) {

                // TODO: check { ... } params

                if ($terms[$i] !== $currentTerm[$i]) {
                    $isMatched = false;
                    break;
                }
            }

            if ($isMatched) {
                return true;
            }
        }
        return false;
    }
}
