<?php

namespace RemySd\SimpleRouter;

use RemySd\SimpleRouter\Exception\RouteNameAlreadyExist;
use RemySd\SimpleRouter\Exception\RouteNotFound;

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
    public function addRoute(string $url, string $controller, string $action, string $routeName): void
    {
        if (array_key_exists($routeName, $this->routes)) {
            throw new RouteNameAlreadyExist($routeName);
        }

        $this->routes[$routeName] = [
            'url' => $url,
            'controller' => $controller,
            'action' => $action,
            'name' => $routeName
        ];
    }

    public function match(string $url): ?array
    {
        $basePathExplode = explode('/', $this->basePath);
        $currentTerm = explode('/', $url);
        $currentTerm = array_values(array_filter($currentTerm));
        $params = ['params' => []];

        foreach ($this->routes as $route) {

            $terms = array_merge($basePathExplode, explode('/', $route['url']));
            $terms = array_values(array_filter($terms));

            if (count($terms) !== count($currentTerm)) {
                continue;
            }

            $isMatched = true;
            for ($i = 0; $i < count($terms); $i++) {

                $param = preg_match('/\{[0-9a-zA-Z]*\}/', $terms[$i]);
                if ($param) {
                    $key = str_replace(['{', '}'], '', $terms[$i]);
                    $params['params'][$key] = $currentTerm[$i];
                    continue;
                }

                if ($terms[$i] !== $currentTerm[$i]) {
                    $isMatched = false;
                    break;
                }
            }

            if ($isMatched) {
                return $params ? array_merge($route, $params) : $route;
            }
        }
        return null;
    }

    /**
     * Generate a url with name and params
     */
    public function generate(string $routeName, array $params = []): ?string
    {
        if (!array_key_exists($routeName, $this->routes)) {
            throw new RouteNotFound($routeName);
        }

        $route = $this->routes[$routeName];
        $url = $route['url'];

        preg_match_all('/\{[0-9a-zA-Z]*\}/', $url, $paramsMatches);
        $paramsMatches = $paramsMatches[0];
        if ($paramsMatches) {
            foreach ($paramsMatches as $paramsMatch) {
                $paramToCheck = str_replace(['{', '}'], '', $paramsMatch);
                if (!array_key_exists($paramToCheck, $params)) {
                    throw new \Exception(sprintf(
                        'Param "%s" is required to generate the route "%s"',
                        $paramToCheck,
                        $routeName
                    ));
                }
                $url = str_replace($paramsMatch, $params[$paramToCheck], $url);
            }
        }

        return $url;
    }
}
