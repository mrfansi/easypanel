<?php

declare(strict_types=1);

namespace Mrfansi\Easypanel\Services;

use Mrfansi\Easypanel\Exceptions\EasypanelValidationException;
use Mrfansi\Easypanel\Validation\RequestValidator;

final class ServicesMongoService extends AbstractService
{
    /**
     * Inspect a MongoDB service.
     *
     * @throws EasypanelValidationException
     */
    public function inspectService(string $projectName, string $serviceName): array
    {
        RequestValidator::validateProjectName($projectName);
        RequestValidator::validateRequiredField($serviceName, 'serviceName');

        return $this->makeRequest('services.mongo.inspectService', [
            'projectName' => $projectName,
            'serviceName' => $serviceName,
        ]);
    }

    /**
     * Create a new MongoDB service.
     *
     * @throws EasypanelValidationException
     */
    public function createService(string $projectName, array $serviceData): array
    {
        RequestValidator::validateProjectName($projectName);
        RequestValidator::validateRequiredField($serviceData['serviceName'] ?? null, 'serviceName');

        return $this->makePostRequest('services.mongo.createService', array_merge([
            'projectName' => $projectName,
        ], $serviceData));
    }

    /**
     * Expose a MongoDB service on a specific port.
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

        return $this->makePostRequest('services.mongo.exposeService', [
            'projectName' => $projectName,
            'serviceName' => $serviceName,
            'exposedPort' => $exposedPort,
        ]);
    }

    /**
     * Update resource allocation for a MongoDB service.
     *
     * @throws EasypanelValidationException
     */
    public function updateResources(string $projectName, string $serviceName, array $resourceData): array
    {
        RequestValidator::validateProjectName($projectName);
        RequestValidator::validateRequiredField($serviceName, 'serviceName');

        return $this->makePostRequest('services.mongo.updateResources', array_merge([
            'projectName' => $projectName,
            'serviceName' => $serviceName,
        ], $resourceData));
    }

    /**
     * Enable a MongoDB service.
     *
     * @throws EasypanelValidationException
     */
    public function enableService(string $projectName, string $serviceName): array
    {
        RequestValidator::validateProjectName($projectName);
        RequestValidator::validateRequiredField($serviceName, 'serviceName');

        return $this->makePostRequest('services.mongo.enableService', [
            'projectName' => $projectName,
            'serviceName' => $serviceName,
        ]);
    }

    /**
     * Disable a MongoDB service.
     *
     * @throws EasypanelValidationException
     */
    public function disableService(string $projectName, string $serviceName): array
    {
        RequestValidator::validateProjectName($projectName);
        RequestValidator::validateRequiredField($serviceName, 'serviceName');

        return $this->makePostRequest('services.mongo.disableService', [
            'projectName' => $projectName,
            'serviceName' => $serviceName,
        ]);
    }

    /**
     * Destroy a MongoDB service.
     *
     * @throws EasypanelValidationException
     */
    public function destroyService(string $projectName, string $serviceName): array
    {
        RequestValidator::validateProjectName($projectName);
        RequestValidator::validateRequiredField($serviceName, 'serviceName');

        return $this->makePostRequest('services.mongo.destroyService', [
            'projectName' => $projectName,
            'serviceName' => $serviceName,
        ]);
    }

    /**
     * Enable MongoExpress for a MongoDB service.
     *
     * @throws EasypanelValidationException
     */
    public function enableMongoExpress(string $projectName, string $serviceName): array
    {
        RequestValidator::validateProjectName($projectName);
        RequestValidator::validateRequiredField($serviceName, 'serviceName');

        return $this->makePostRequest('services.mongo.enableMongoExpress', [
            'projectName' => $projectName,
            'serviceName' => $serviceName,
        ]);
    }

    /**
     * Disable MongoExpress for a MongoDB service.
     *
     * @throws EasypanelValidationException
     */
    public function disableMongoExpress(string $projectName, string $serviceName): array
    {
        RequestValidator::validateProjectName($projectName);
        RequestValidator::validateRequiredField($serviceName, 'serviceName');

        return $this->makePostRequest('services.mongo.disableMongoExpress', [
            'projectName' => $projectName,
            'serviceName' => $serviceName,
        ]);
    }

    /**
     * Enable DbGate for a MongoDB service.
     *
     * @throws EasypanelValidationException
     */
    public function enableDbGate(string $projectName, string $serviceName): array
    {
        RequestValidator::validateProjectName($projectName);
        RequestValidator::validateRequiredField($serviceName, 'serviceName');

        return $this->makePostRequest('services.mongo.enableDbGate', [
            'projectName' => $projectName,
            'serviceName' => $serviceName,
        ]);
    }

    /**
     * Disable DbGate for a MongoDB service.
     *
     * @throws EasypanelValidationException
     */
    public function disableDbGate(string $projectName, string $serviceName): array
    {
        RequestValidator::validateProjectName($projectName);
        RequestValidator::validateRequiredField($serviceName, 'serviceName');

        return $this->makePostRequest('services.mongo.disableDbGate', [
            'projectName' => $projectName,
            'serviceName' => $serviceName,
        ]);
    }

    /**
     * Update advanced settings for a MongoDB service.
     *
     * @throws EasypanelValidationException
     */
    public function updateAdvanced(string $projectName, string $serviceName, array $advancedData): array
    {
        RequestValidator::validateProjectName($projectName);
        RequestValidator::validateRequiredField($serviceName, 'serviceName');

        return $this->makePostRequest('services.mongo.updateAdvanced', array_merge([
            'projectName' => $projectName,
            'serviceName' => $serviceName,
        ], $advancedData));
    }

    /**
     * Update credentials for a MongoDB service.
     *
     * @throws EasypanelValidationException
     */
    public function updateCredentials(string $projectName, string $serviceName, array $credentialsData): array
    {
        RequestValidator::validateProjectName($projectName);
        RequestValidator::validateRequiredField($serviceName, 'serviceName');

        return $this->makePostRequest('services.mongo.updateCredentials', array_merge([
            'projectName' => $projectName,
            'serviceName' => $serviceName,
        ], $credentialsData));
    }
}
