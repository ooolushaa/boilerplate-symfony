<?php

namespace App\Service;

use Symfony\Component\Validator\ConstraintViolation;
use Symfony\Component\Validator\ConstraintViolationListInterface;

final class ValidatorService
{
    public function getValidationErrors(ConstraintViolationListInterface $errors)
    {
        [$messages, $violations] = $this->getMessagesAndViolations($errors);

        return [
            'title' => 'An error occurred during validation',
            'detail' => $messages ? implode("\n", $messages) : '',
            'violations' => $violations,
        ];
    }

    // TODO Pretty messages
    private function getMessagesAndViolations(ConstraintViolationListInterface $constraintViolationList): array
    {
        $violations = $messages = [];
        /** @var ConstraintViolation $violation */
        foreach ($constraintViolationList as $violation) {
            $violations[] = [
                'propertyPath' => $violation->getPropertyPath(),
                'message' => $violation->getMessage(),
                'code' => $violation->getCode(),
            ];

            $propertyPath = $violation->getPropertyPath();
            $messages[] = ($propertyPath ? $propertyPath.  ': ' : '') . $violation->getMessage();
        }

        return [$messages, $violations];
    }
}
