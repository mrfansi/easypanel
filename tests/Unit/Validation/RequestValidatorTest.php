<?php

declare(strict_types=1);

use Mrfansi\Easypanel\Exceptions\EasypanelValidationException;
use Mrfansi\Easypanel\Validation\RequestValidator;

describe('ProjectName validation', function () {
    it('accepts valid project names', function (string $projectName) {
        expect(fn () => RequestValidator::validateProjectName($projectName))
            ->not->toThrow(EasypanelValidationException::class);
    })->with([
        'simple-name',
        'project123',
        'my_project',
        'test-project-name',
        'api-v2',
    ]);

    it('rejects invalid project names', function (string $projectName) {
        expect(fn () => RequestValidator::validateProjectName($projectName))
            ->toThrow(EasypanelValidationException::class);
    })->with([
        'UPPERCASE',
        'project name with spaces',
        'project@name',
        'project.name',
        'project/name',
    ]);
});

describe('ServiceName validation', function () {
    it('accepts valid service names', function (string $serviceName) {
        expect(fn () => RequestValidator::validateServiceName($serviceName))
            ->not->toThrow(EasypanelValidationException::class);
    })->with([
        'simple-service',
        'service123',
        'my_service',
        'web-server',
        'database-primary',
    ]);

    it('rejects invalid service names', function (string $serviceName) {
        expect(fn () => RequestValidator::validateServiceName($serviceName))
            ->toThrow(EasypanelValidationException::class);
    })->with([
        'UPPERCASE',
        'service name with spaces',
        'service@name',
        'service.name',
        'service/name',
    ]);
});

describe('Email validation', function () {
    it('accepts valid emails', function (string $email) {
        expect(fn () => RequestValidator::validateEmail($email))
            ->not->toThrow(EasypanelValidationException::class);
    })->with([
        'test@example.com',
        'user.name@domain.co.uk',
        'admin+test@example.org',
    ]);

    it('rejects invalid emails', function (string $email) {
        expect(fn () => RequestValidator::validateEmail($email))
            ->toThrow(EasypanelValidationException::class);
    })->with([
        'invalid-email',
        '@domain.com',
        'user@',
        'user name@domain.com',
    ]);
});

describe('URL validation', function () {
    it('accepts valid URLs', function (string $url) {
        expect(fn () => RequestValidator::validateUrl($url))
            ->not->toThrow(EasypanelValidationException::class);
    })->with([
        'https://example.com',
        'http://localhost:3000',
        'https://subdomain.example.co.uk/path',
    ]);

    it('rejects invalid URLs', function (string $url) {
        expect(fn () => RequestValidator::validateUrl($url))
            ->toThrow(EasypanelValidationException::class);
    })->with([
        'invalid-url',
        'not-a-url',
    ]);
});

describe('WordPress stage validation', function () {
    it('accepts valid stages', function (string $stage) {
        expect(fn () => RequestValidator::validateWordPressStage($stage))
            ->not->toThrow(EasypanelValidationException::class);
    })->with(['bootstrap', 'main_query', 'template']);

    it('rejects invalid stages', function (string $stage) {
        expect(fn () => RequestValidator::validateWordPressStage($stage))
            ->toThrow(EasypanelValidationException::class);
    })->with(['invalid', 'wrong_stage', 'Bootstrap', 'TEMPLATE']);
});

describe('Required fields validation', function () {
    it('passes when all required fields are present', function () {
        $data = ['name' => 'test', 'email' => 'test@example.com'];
        $required = ['name', 'email'];

        expect(fn () => RequestValidator::validateRequired($data, $required))
            ->not->toThrow(EasypanelValidationException::class);
    });

    it('throws when required fields are missing', function () {
        $data = ['name' => 'test'];
        $required = ['name', 'email'];

        expect(fn () => RequestValidator::validateRequired($data, $required))
            ->toThrow(EasypanelValidationException::class, 'Missing required fields: email');
    });
});
