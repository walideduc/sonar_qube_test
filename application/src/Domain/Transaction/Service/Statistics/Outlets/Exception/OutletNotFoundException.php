<?php
namespace App\Domain\Transaction\Service\Statistics\Outlets\Exception;
use App\Domain\Transaction\Repository\Statistics\Outlets\Exception\OutletNotFoundException as RepositoryOutletNotFoundException ;
use RuntimeException;

class OutletNotFoundException extends RuntimeException
{
    public static function createFromOutletNotFoundExceptionFromRepository(RepositoryOutletNotFoundException $exception)
    {
        return new static(
            $exception->getMessage()
        );
    }
}