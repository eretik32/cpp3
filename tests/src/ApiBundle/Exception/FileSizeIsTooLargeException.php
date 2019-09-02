<?php

namespace ApiBundle\Exception;

use Throwable;

class FileSizeIsTooLargeException extends \RuntimeException
{
    public function __construct($message, array $params = [], Throwable $previous = null)
    {
        parent::__construct($message, 500, $previous);
    }
}