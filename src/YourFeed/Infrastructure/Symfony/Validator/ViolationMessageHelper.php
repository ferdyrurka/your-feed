<?php

declare(strict_types=1);

namespace Ferdyrurka\YourFeed\Infrastructure\Symfony\Validator;

use Symfony\Component\Validator\ConstraintViolationListInterface;

class ViolationMessageHelper
{
    /**
     * @return string[]
     */
    public static function toArray(ConstraintViolationListInterface $violations): array
    {
        $result = [];

        foreach ($violations as $violation) {
            $result[] = $violation->getMessage();
        }

        return $result;
    }
}
