<?php

namespace App\Domain\Utility\Validator;

use stdClass;

/**
 * Interface ValidatorInterface
 * @package App\Domain\Utility\Validator
 */
interface ValidatorInterface
{
    /**
     * @param stdClass $data
     * @return mixed
     */
    public function validate(stdClass $data);
}