<?php

namespace spec\App\Domain\Utility\Validator;

use App\Domain\Utility\Validator\JsonValidator;
use App\Domain\Utility\Validator\Exception\InvalidDataException;
use PhpSpec\ObjectBehavior;
use Faker\Factory as FakerFactory;
use Prophecy\Argument;
use JsonSchema\Validator;
use stdClass;

class JsonValidatorSpec extends ObjectBehavior
{
    private $faker;

    public function __construct()
    {
        $this->faker = FakerFactory::create('fr_FR');
    }

    function let(Validator $validator) {
        $schemaPathName = realpath(__DIR__.'/Data/');
        $schemaName = 'BasicValidatorSchema.json';
        $this->beConstructedWith($schemaPathName, $schemaName, $validator);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(JsonValidator::class);
    }

    function it_validates_a_data_with_a_basic_validator(Validator $validator)
    {
        $data = new stdClass();
        $data->id = $this->faker->uuid;
        $data->amount = $this->faker->randomFloat();
        $data->currency = $this->faker->currencyCode;

        $validator->validate(Argument::any(),Argument::any())->shouldBeCalled();
        $validator->isValid()->willReturn(true);
        $this->validate($data);
    }

    function it_should_throw_an_exception_during_validation_with_invalid_payload_data(Validator $validator)
    {
        $data = new stdClass();
        $data->id = null;
        $data->amount = null;
        $data->currency = null;

        $validator->validate(Argument::any(),Argument::any())->shouldBeCalled();
        $validator->isValid()->willReturn(false);
        $validator->getErrors()->willReturn([]);

        $this->shouldThrow(InvalidDataException::class)->duringValidate($data);
    }
}