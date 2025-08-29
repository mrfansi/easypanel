<?php

declare(strict_types=1);

namespace Mrfansi\Easypanel\Exceptions;

final class EasypanelApiException extends EasypanelException
{
    public function __construct(string $message, int $statusCode = 0)
    {
        parent::__construct($message, $statusCode);
    }
}
