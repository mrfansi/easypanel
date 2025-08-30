<?php

declare(strict_types=1);

namespace Mrfansi\Easypanel\Services;

use Mrfansi\Easypanel\Exceptions\EasypanelValidationException;
use Mrfansi\Easypanel\Validation\RequestValidator;

final class ServicesPostgresService extends AbstractService
{
    /**
     * Inspect a PostgreSQL service.
     *
     * @throws EasypanelValidationException
     */
    public function inspectService(string $projectName, string $serviceName): array
    {
        RequestValidator::validateProjectName($projectName);
        RequestValidator::validateRequiredField($serviceName, 'serviceName');

        return $this->makeRequest('services.postgres.inspectService', [
            'projectName' => $projectName,
            'serviceName' => $serviceName,
        ]);
    }

    /**
     * Create a new PostgreSQL service.
     *
     * @throws EasypanelValidationException
     */
    public function createService(string $projectName, array $serviceData): array
    {
        RequestValidator::validateProjectName($projectName);
        RequestValidator::validateRequiredField($serviceData['serviceName'] ?? null, 'serviceName');

        return $this->makePostRequest('services.postgres.createService', array_merge([
            'projectName' => $projectName,
        ], $serviceData));
    }

    /**
     * Expose a PostgreSQL service on a specific port.
     *
     * @throws EasypanelValidationException
     */
    public function exposeService(string $projectName, string $serviceName, int $exposedPort): array
    {
        RequestValidator::validateProjectName($projectName);
        RequestValidator::validateRequiredField($serviceName, 'serviceName');

        if ($exposedPort < 0 || $exposedPort > 65535) {
            throw new EasypanelValidationException('Exposed port must be between 0 and 65535');
        }

        return $this->makePostRequest('services.postgres.exposeService', [
            'projectName' => $projectName,
            'serviceName' => $serviceName,
            'exposedPort' => $exposedPort,
        ]);
    }

    /**
     * Update resource allocation for a PostgreSQL service.
     *
     * @throws EasypanelValidationException
     */
    public function updateResources(string $projectName, string $serviceName, array $resourceData): array
    {
        RequestValidator::validateProjectName($projectName);
        RequestValidator::validateRequiredField($serviceName, 'serviceName');

        return $this->makePostRequest('services.postgres.updateResources', array_merge([
            'projectName' => $projectName,
            'serviceName' => $serviceName,
        ], $resourceData));
    }

    /**
     * Enable a PostgreSQL service.
     *
     * @throws EasypanelValidationException
     */
    public function enableService(string $projectName, string $serviceName): array
    {
        RequestValidator::validateProjectName($projectName);
        RequestValidator::validateRequiredField($serviceName, 'serviceName');

        return $this->makePostRequest('services.postgres.enableService', [
            'projectName' => $projectName,
            'serviceName' => $serviceName,
        ]);
    }

    /**
     * Disable a PostgreSQL service.
     *
     * @throws EasypanelValidationException
     */
    public function disableService(string $projectName, string $serviceName): array
    {
        RequestValidator::validateProjectName($projectName);
        RequestValidator::validateRequiredField($serviceName, 'serviceName');

        return $this->makePostRequest('services.postgres.disableService', [
            'projectName' => $projectName,
            'serviceName' => $serviceName,
        ]);
    }

    /**
     * Destroy a PostgreSQL service.
     *
     * @throws EasypanelValidationException
     */
    public function destroyService(string $projectName, string $serviceName): array
    {
        RequestValidator::validateProjectName($projectName);
        RequestValidator::validateRequiredField($serviceName, 'serviceName');

        return $this->makePostRequest('services.postgres.destroyService', [
            'projectName' => $projectName,
            'serviceName' => $serviceName,
        ]);
    }

    /**
     * Enable PgWeb for a PostgreSQL service.
     *
     * @throws EasypanelValidationException
     */
    public function enablePgWeb(string $projectName, string $serviceName): array
    {
        RequestValidator::validateProjectName($projectName);
        RequestValidator::validateRequiredField($serviceName, 'serviceName');

        return $this->makePostRequest('services.postgres.enablePgWeb', [
            'projectName' => $projectName,
            'serviceName' => $serviceName,
        ]);
    }

    /**
     * Disable PgWeb for a PostgreSQL service.
     *
     * @throws EasypanelValidationException
     */
    public function disablePgWeb(string $projectName, string $serviceName): array
    {
        RequestValidator::validateProjectName($projectName);
        RequestValidator::validateRequiredField($serviceName, 'serviceName');

        return $this->makePostRequest('services.postgres.disablePgWeb', [
            'projectName' => $projectName,
            'serviceName' => $serviceName,
        ]);
    }

    /**
     * Enable DbGate for a PostgreSQL service.
     *
     * @throws EasypanelValidationException
     */
    public function enableDbGate(string $projectName, string $serviceName): array
    {
        RequestValidator::validateProjectName($projectName);
        RequestValidator::validateRequiredField($serviceName, 'serviceName');

        return $this->makePostRequest('services.postgres.enableDbGate', [
            'projectName' => $projectName,
            'serviceName' => $serviceName,
        ]);
    }

    /**
     * Disable DbGate for a PostgreSQL service.
     *
     * @throws EasypanelValidationException
     */
    public function disableDbGate(string $projectName, string $serviceName): array
    {
        RequestValidator::validateProjectName($projectName);
        RequestValidator::validateRequiredField($serviceName, 'serviceName');

        return $this->makePostRequest('services.postgres.disableDbGate', [
            'projectName' => $projectName,
            'serviceName' => $serviceName,
        ]);
    }

    /**
     * Update advanced settings for a PostgreSQL service.
     *
     * @throws EasypanelValidationException
     */
    public function updateAdvanced(string $projectName, string $serviceName, array $advancedData): array
    {
        RequestValidator::validateProjectName($projectName);
        RequestValidator::validateRequiredField($serviceName, 'serviceName');

        return $this->makePostRequest('services.postgres.updateAdvanced', array_merge([
            'projectName' => $projectName,
            'serviceName' => $serviceName,
        ], $advancedData));
    }

    /**
     * Update credentials for a PostgreSQL service.
     *
     * @throws EasypanelValidationException
     */
    public function updateCredentials(string $projectName, string $serviceName, array $credentialsData): array
    {
        RequestValidator::validateProjectName($projectName);
        RequestValidator::validateRequiredField($serviceName, 'serviceName');

        return $this->makePostRequest('services.postgres.updateCredentials', array_merge([
            'projectName' => $projectName,
            'serviceName' => $serviceName,
        ], $credentialsData));
    }
}
