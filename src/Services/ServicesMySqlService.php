<?php

declare(strict_types=1);

namespace Mrfansi\Easypanel\Services;

use Mrfansi\Easypanel\Exceptions\EasypanelValidationException;
use Mrfansi\Easypanel\Validation\RequestValidator;

final class ServicesMySqlService extends AbstractService
{
    /**
     * @throws EasypanelValidationException
     */
    public function inspectService(string $projectName, string $serviceName): array
    {
        RequestValidator::validateProjectName($projectName);
        RequestValidator::validateRequiredField($serviceName, 'serviceName');

        return $this->makeRequest('services.mysql.inspectService', [
            'projectName' => $projectName,
            'serviceName' => $serviceName,
        ]);
    }

    /**
     * @throws EasypanelValidationException
     */
    public function createService(string $projectName, array $serviceData): array
    {
        RequestValidator::validateProjectName($projectName);
        RequestValidator::validateRequiredField($serviceData['name'] ?? null, 'name');

        return $this->makePostRequest('services.mysql.createService', array_merge([
            'projectName' => $projectName,
        ], $serviceData));
    }

    /**
     * @throws EasypanelValidationException
     */
    public function exposeService(string $projectName, string $serviceName, array $exposeData): array
    {
        RequestValidator::validateProjectName($projectName);
        RequestValidator::validateRequiredField($serviceName, 'serviceName');

        return $this->makePatchRequest('services.mysql.exposeService', array_merge([
            'projectName' => $projectName,
            'serviceName' => $serviceName,
        ], $exposeData));
    }

    /**
     * @throws EasypanelValidationException
     */
    public function updateResources(string $projectName, string $serviceName, array $resourceData): array
    {
        RequestValidator::validateProjectName($projectName);
        RequestValidator::validateRequiredField($serviceName, 'serviceName');

        return $this->makePatchRequest('services.mysql.updateResources', array_merge([
            'projectName' => $projectName,
            'serviceName' => $serviceName,
        ], $resourceData));
    }

    /**
     * @throws EasypanelValidationException
     */
    public function enableService(string $projectName, string $serviceName): array
    {
        RequestValidator::validateProjectName($projectName);
        RequestValidator::validateRequiredField($serviceName, 'serviceName');

        return $this->makePostRequest('services.mysql.enableService', [
            'projectName' => $projectName,
            'serviceName' => $serviceName,
        ]);
    }

    /**
     * @throws EasypanelValidationException
     */
    public function disableService(string $projectName, string $serviceName): array
    {
        RequestValidator::validateProjectName($projectName);
        RequestValidator::validateRequiredField($serviceName, 'serviceName');

        return $this->makePostRequest('services.mysql.disableService', [
            'projectName' => $projectName,
            'serviceName' => $serviceName,
        ]);
    }

    /**
     * @throws EasypanelValidationException
     */
    public function destroyService(string $projectName, string $serviceName): array
    {
        RequestValidator::validateProjectName($projectName);
        RequestValidator::validateRequiredField($serviceName, 'serviceName');

        return $this->makeDeleteRequest('services.mysql.destroyService', [
            'projectName' => $projectName,
            'serviceName' => $serviceName,
        ]);
    }

    /**
     * @throws EasypanelValidationException
     */
    public function enablePhpMyAdmin(string $projectName, string $serviceName): array
    {
        RequestValidator::validateProjectName($projectName);
        RequestValidator::validateRequiredField($serviceName, 'serviceName');

        return $this->makePostRequest('services.mysql.enablePhpMyAdmin', [
            'projectName' => $projectName,
            'serviceName' => $serviceName,
        ]);
    }

    /**
     * @throws EasypanelValidationException
     */
    public function disablePhpMyAdmin(string $projectName, string $serviceName): array
    {
        RequestValidator::validateProjectName($projectName);
        RequestValidator::validateRequiredField($serviceName, 'serviceName');

        return $this->makePostRequest('services.mysql.disablePhpMyAdmin', [
            'projectName' => $projectName,
            'serviceName' => $serviceName,
        ]);
    }

    /**
     * @throws EasypanelValidationException
     */
    public function enableDbGate(string $projectName, string $serviceName): array
    {
        RequestValidator::validateProjectName($projectName);
        RequestValidator::validateRequiredField($serviceName, 'serviceName');

        return $this->makePostRequest('services.mysql.enableDbGate', [
            'projectName' => $projectName,
            'serviceName' => $serviceName,
        ]);
    }

    /**
     * @throws EasypanelValidationException
     */
    public function disableDbGate(string $projectName, string $serviceName): array
    {
        RequestValidator::validateProjectName($projectName);
        RequestValidator::validateRequiredField($serviceName, 'serviceName');

        return $this->makePostRequest('services.mysql.disableDbGate', [
            'projectName' => $projectName,
            'serviceName' => $serviceName,
        ]);
    }

    /**
     * @throws EasypanelValidationException
     */
    public function updateAdvanced(string $projectName, string $serviceName, array $advancedData): array
    {
        RequestValidator::validateProjectName($projectName);
        RequestValidator::validateRequiredField($serviceName, 'serviceName');

        return $this->makePatchRequest('services.mysql.updateAdvanced', array_merge([
            'projectName' => $projectName,
            'serviceName' => $serviceName,
        ], $advancedData));
    }

    /**
     * @throws EasypanelValidationException
     */
    public function updateCredentials(string $projectName, string $serviceName, array $credentialsData): array
    {
        RequestValidator::validateProjectName($projectName);
        RequestValidator::validateRequiredField($serviceName, 'serviceName');

        return $this->makePatchRequest('services.mysql.updateCredentials', array_merge([
            'projectName' => $projectName,
            'serviceName' => $serviceName,
        ], $credentialsData));
    }
}
