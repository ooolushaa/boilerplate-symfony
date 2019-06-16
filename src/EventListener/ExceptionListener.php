<?php

namespace App\EventListener;

use App\Exception\ValidationException;
use App\Service\ValidatorService;
use JMS\Serializer\Exception\ValidationFailedException;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Event\GetResponseForExceptionEvent;

class ExceptionListener
{
    private $validatorService;

    public function __construct(ValidatorService $validatorService)
    {
        $this->validatorService = $validatorService;
    }

    public function onKernelException(GetResponseForExceptionEvent $event)
    {
        $exception = $event->getException();
        if (!$exception instanceof ValidationFailedException) {
            return ;
        }

        $response = JsonResponse::create(
            $this->validatorService->getValidationErrors($exception->getConstraintViolationList()),
            400
        );

        $event->setResponse($response);
    }
}
