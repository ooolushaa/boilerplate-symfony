<?php

namespace App\Exception;

use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

final class UserWithSameEmailWasAlreadyRegisteredException extends BadRequestHttpException
{
    public function __construct(string $message = null, \Exception $previous = null, int $code = 0, array $headers = [])
    {
        parent::__construct('UserWithSameEmailWasAlreadyRegisteredException', $previous, $code, $headers);
    }
}
