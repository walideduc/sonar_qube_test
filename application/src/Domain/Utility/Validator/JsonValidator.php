<?php

namespace App\Domain\Utility\Validator;

use App\Domain\Utility\Validator\Exception\InvalidDataException;
use App\Domain\Utility\Validator\Exception\JsonSchemaInvalidPathException;
use App\Domain\Utility\Validator\Exception\JsonSchemaNotFoundException;
use JsonSchema\Validator;
use stdClass;

/**
 * Class JsonValidator
 * @package App\Domain\Utility\Validator
 */
class JsonValidator implements ValidatorInterface
{
    /**
     * @var string
     */
    private $jsonSchemaPath;
    /**
     * @var string
     */
    private $schemaName;
    /**
     * @var JsonValidator
     */
    private $validator;

    /**
     * JsonValidator constructor.
     *
     * @param string    $jsonSchemaPath
     * @param string    $schemaName
     * @param Validator $validator
     */
    public function __construct(
        string $jsonSchemaPath,
        string $schemaName,
        Validator $validator
    ) {
        $this->jsonSchemaPath = $jsonSchemaPath;
        $this->schemaName = $schemaName;
        $this->validator = $validator;
    }

    /**
     * @inheritdoc
     */
    public function validate(stdClass $data)
    {
        $jsonSchemaFile = $this->getJsonSchemaFile();

        $this->validator->validate(
            $data,
            (object) ['$ref' => 'file://' . $jsonSchemaFile]
        );

        if (!$this->validator->isValid()) {
            throw InvalidDataException::fromValidator($this->validator);
        }
    }

    public function getJsonSchemaFile()
    {
        $path = $this->jsonSchemaPath . '/' . $this->schemaName;
        $file = realpath($path);

        if (!$file) {
            throw JsonSchemaInvalidPathException::fromFilePath($path);
        }

        if (!file_exists($file)) {
            throw JsonSchemaNotFoundException::fromFilePath($file);
        }

        return $file;
    }
}