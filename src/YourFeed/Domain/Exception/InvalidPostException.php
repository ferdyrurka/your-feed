<?php

declare(strict_types=1);

namespace Ferdyrurka\YourFeed\Domain\Exception;

use InvalidArgumentException;

class InvalidPostException extends InvalidArgumentException
{
    public function __construct(string $externalId, array $errorsMessages)
    {
        parent::__construct(sprintf(
            'Give invalid Post data for external id: %s. Errors messages: %s',
            $externalId,
            json_encode($errorsMessages, JSON_THROW_ON_ERROR),
        ));
    }
}
