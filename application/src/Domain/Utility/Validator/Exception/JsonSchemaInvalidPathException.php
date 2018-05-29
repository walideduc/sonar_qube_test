<?php

namespace App\Domain\Utility\Validator\Exception;

use RuntimeException;

class JsonSchemaInvalidPathException extends RuntimeException
{
    public static function fromFilePath(string $path) : self
    {
        return new static('Json Schema path not valid : ' . $path);
    }
}