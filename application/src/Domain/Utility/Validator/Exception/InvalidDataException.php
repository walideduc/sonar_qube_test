<?php

namespace App\Domain\Utility\Validator\Exception;

use JsonSchema\Validator;
use LogicException;

class InvalidDataException extends LogicException
{
    /**
     * @var array
     */
    private $errors;

    public function __construct(array $errors)
    {
        parent::__construct();
        $this->errors = $errors;
    }

    public function getErrors() : array
    {
        return $this->errors;
    }

    public static function fromValidator(Validator $validator) : self
    {
        return new static($validator->getErrors());
    }
}