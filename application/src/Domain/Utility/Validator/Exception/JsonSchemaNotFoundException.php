<?php

namespace App\Domain\Utility\Validator\Exception;

use RuntimeException;

class JsonSchemaNotFoundException extends RuntimeException
{
    public static function fromFilePath(string $path) : self
    {
        return new static('Json Schema file not found : ' . $path);
    }
}