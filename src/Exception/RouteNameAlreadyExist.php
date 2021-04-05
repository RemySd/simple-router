<?php

namespace RemySd\SimpleRouter\Exception;

use Exception;
use Throwable;

class RouteNameAlreadyExist extends Exception
{
    public function __construct(string $routeName, $code = 0, Throwable $previous = null) {
        parent::__construct(
            sprintf('A route with the name "%s" already exist', $routeName),
            $code,
            $previous
        );
    }
}
