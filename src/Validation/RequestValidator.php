<?php

declare(strict_types=1);

namespace Mrfansi\Easypanel\Validation;

use Mrfansi\Easypanel\Exceptions\EasypanelValidationException;

final class RequestValidator
{
    public static function validateProjectName(string $projectName): void
    {
        if (! preg_match('/^[a-z0-9-_]+$/', $projectName)) {
            throw new EasypanelValidationException(
                'Project name must contain only lowercase letters, numbers, hyphens, and underscores'
            );
        }
    }

    public static function validateServiceName(string $serviceName): void
    {
        if (! preg_match('/^[a-z0-9-_]+$/', $serviceName)) {
            throw new EasypanelValidationException(
                'Service name must contain only lowercase letters, numbers, hyphens, and underscores'
            );
        }
    }

    public static function validateEmail(string $email): void
    {
        if (! filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new EasypanelValidationException('Invalid email address');
        }
    }

    public static function validateUrl(string $url): void
    {
        if (! filter_var($url, FILTER_VALIDATE_URL)) {
            throw new EasypanelValidationException('Invalid URL format');
        }
    }

    public static function validateWordPressStage(string $stage): void
    {
        $validStages = ['bootstrap', 'main_query', 'template'];

        if (! in_array($stage, $validStages)) {
            throw new EasypanelValidationException(
                'WordPress stage must be one of: '.implode(', ', $validStages)
            );
        }
    }

    public static function validateRequired(array $data, array $requiredFields): void
    {
        $missing = [];

        foreach ($requiredFields as $field) {
            if (! isset($data[$field]) || empty($data[$field])) {
                $missing[] = $field;
            }
        }

        if (! empty($missing)) {
            throw new EasypanelValidationException(
                'Missing required fields: '.implode(', ', $missing)
            );
        }
    }
}
