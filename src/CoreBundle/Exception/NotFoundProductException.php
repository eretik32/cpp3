<?php

namespace CoreBundle\Exception;

use Throwable;

class NotFoundProductException extends \RuntimeException
{
    public function __construct($message, array $params = [], Throwable $previous = null)
    {
        parent::__construct($message, 500, $previous);
    }
}