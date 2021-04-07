<?php

namespace RemySd\SimpleRouter\Exception;

use Exception;
use Throwable;

class RouteNotFound extends Exception
{
    public function __construct(string $routeName, $code = 0, Throwable $previous = null)
    {
        parent::__construct(
            sprintf('The route with the "%s" not exist', $routeName),
            $code,
            $previous
        );
    }
}
