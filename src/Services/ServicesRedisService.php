<?php

declare(strict_types=1);

namespace Mrfansi\Easypanel\Services;

use Mrfansi\Easypanel\Exceptions\EasypanelValidationException;
use Mrfansi\Easypanel\Validation\RequestValidator;

final class ServicesRedisService extends AbstractService
{
    /**
     * Inspect a Redis service.
     *
     * @throws EasypanelValidationException
     */
    public function inspectService(string $projectName, string $serviceName): array
    {
        RequestValidator::validateProjectName($projectName);
        RequestValidator::validateRequiredField($serviceName, 'serviceName');

        return $this->makeRequest('services.redis.inspectService', [
            'projectName' => $projectName,
            'serviceName' => $serviceName,
        ]);
    }

    /**
     * Create a new Redis service.
     *
     * @throws EasypanelValidationException
     */
    public function createService(string $projectName, array $serviceData): array
    {
        RequestValidator::validateProjectName($projectName);
        RequestValidator::validateRequiredField($serviceData['serviceName'] ?? null, 'serviceName');

        return $this->makePostRequest('services.redis.createService', array_merge([
            'projectName' => $projectName,
        ], $serviceData));
    }

    /**
     * Expose a Redis service on a specific port.
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

        return $this->makePostRequest('services.redis.exposeService', [
            'projectName' => $projectName,
            'serviceName' => $serviceName,
            'exposedPort' => $exposedPort,
        ]);
    }

    /**
     * Update resource allocation for a Redis service.
     *
     * @throws EasypanelValidationException
     */
    public function updateResources(string $projectName, string $serviceName, array $resourceData): array
    {
        RequestValidator::validateProjectName($projectName);
        RequestValidator::validateRequiredField($serviceName, 'serviceName');

        return $this->makePostRequest('services.redis.updateResources', array_merge([
            'projectName' => $projectName,
            'serviceName' => $serviceName,
        ], $resourceData));
    }

    /**
     * Enable a Redis service.
     *
     * @throws EasypanelValidationException
     */
    public function enableService(string $projectName, string $serviceName): array
    {
        RequestValidator::validateProjectName($projectName);
        RequestValidator::validateRequiredField($serviceName, 'serviceName');

        return $this->makePostRequest('services.redis.enableService', [
            'projectName' => $projectName,
            'serviceName' => $serviceName,
        ]);
    }

    /**
     * Disable a Redis service.
     *
     * @throws EasypanelValidationException
     */
    public function disableService(string $projectName, string $serviceName): array
    {
        RequestValidator::validateProjectName($projectName);
        RequestValidator::validateRequiredField($serviceName, 'serviceName');

        return $this->makePostRequest('services.redis.disableService', [
            'projectName' => $projectName,
            'serviceName' => $serviceName,
        ]);
    }

    /**
     * Destroy a Redis service.
     *
     * @throws EasypanelValidationException
     */
    public function destroyService(string $projectName, string $serviceName): array
    {
        RequestValidator::validateProjectName($projectName);
        RequestValidator::validateRequiredField($serviceName, 'serviceName');

        return $this->makePostRequest('services.redis.destroyService', [
            'projectName' => $projectName,
            'serviceName' => $serviceName,
        ]);
    }

    /**
     * Enable RedisCommander for a Redis service.
     *
     * @throws EasypanelValidationException
     */
    public function enableRedisCommander(string $projectName, string $serviceName): array
    {
        RequestValidator::validateProjectName($projectName);
        RequestValidator::validateRequiredField($serviceName, 'serviceName');

        return $this->makePostRequest('services.redis.enableRedisCommander', [
            'projectName' => $projectName,
            'serviceName' => $serviceName,
        ]);
    }

    /**
     * Disable RedisCommander for a Redis service.
     *
     * @throws EasypanelValidationException
     */
    public function disableRedisCommander(string $projectName, string $serviceName): array
    {
        RequestValidator::validateProjectName($projectName);
        RequestValidator::validateRequiredField($serviceName, 'serviceName');

        return $this->makePostRequest('services.redis.disableRedisCommander', [
            'projectName' => $projectName,
            'serviceName' => $serviceName,
        ]);
    }

    /**
     * Enable DbGate for a Redis service.
     *
     * @throws EasypanelValidationException
     */
    public function enableDbGate(string $projectName, string $serviceName): array
    {
        RequestValidator::validateProjectName($projectName);
        RequestValidator::validateRequiredField($serviceName, 'serviceName');

        return $this->makePostRequest('services.redis.enableDbGate', [
            'projectName' => $projectName,
            'serviceName' => $serviceName,
        ]);
    }

    /**
     * Disable DbGate for a Redis service.
     *
     * @throws EasypanelValidationException
     */
    public function disableDbGate(string $projectName, string $serviceName): array
    {
        RequestValidator::validateProjectName($projectName);
        RequestValidator::validateRequiredField($serviceName, 'serviceName');

        return $this->makePostRequest('services.redis.disableDbGate', [
            'projectName' => $projectName,
            'serviceName' => $serviceName,
        ]);
    }

    /**
     * Update advanced settings for a Redis service.
     *
     * @throws EasypanelValidationException
     */
    public function updateAdvanced(string $projectName, string $serviceName, array $advancedData): array
    {
        RequestValidator::validateProjectName($projectName);
        RequestValidator::validateRequiredField($serviceName, 'serviceName');

        return $this->makePostRequest('services.redis.updateAdvanced', array_merge([
            'projectName' => $projectName,
            'serviceName' => $serviceName,
        ], $advancedData));
    }

    /**
     * Update credentials for a Redis service.
     *
     * @throws EasypanelValidationException
     */
    public function updateCredentials(string $projectName, string $serviceName, array $credentialsData): array
    {
        RequestValidator::validateProjectName($projectName);
        RequestValidator::validateRequiredField($serviceName, 'serviceName');

        return $this->makePostRequest('services.redis.updateCredentials', array_merge([
            'projectName' => $projectName,
            'serviceName' => $serviceName,
        ], $credentialsData));
    }
}
