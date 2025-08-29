<?php

declare(strict_types=1);

namespace Mrfansi\Easypanel\Exceptions;

final class EasypanelValidationException extends EasypanelException
{
    private array $errors;

    public function __construct(string $message, array $errors = [])
    {
        parent::__construct($message);
        $this->errors = $errors;
    }

    public function getErrors(): array
    {
        return $this->errors;
    }
}
