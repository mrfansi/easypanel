<?php

declare(strict_types=1);

namespace Mrfansi\Easypanel\Services;

use Mrfansi\Easypanel\Exceptions\EasypanelValidationException;
use Mrfansi\Easypanel\Validation\RequestValidator;

final class ServicesAppService extends AbstractService
{
    /**
     * @throws EasypanelValidationException
     */
    public function inspectService(string $projectName, string $serviceName): array
    {
        RequestValidator::validateProjectName($projectName);
        RequestValidator::validateRequiredField($serviceName, 'serviceName');

        return $this->makeRequest('services.app.inspectService', [
            'projectName' => $projectName,
            'serviceName' => $serviceName,
        ]);
    }

    /**
     * @throws EasypanelValidationException
     */
    public function getExposedPorts(string $projectName, string $serviceName): array
    {
        RequestValidator::validateProjectName($projectName);
        RequestValidator::validateRequiredField($serviceName, 'serviceName');

        return $this->makeRequest('services.app.getExposedPorts', [
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

        return $this->makePostRequest('services.app.createService', array_merge([
            'projectName' => $projectName,
        ], $serviceData));
    }

    /**
     * @throws EasypanelValidationException
     */
    public function updateDeploy(string $projectName, string $serviceName, array $deployData): array
    {
        RequestValidator::validateProjectName($projectName);
        RequestValidator::validateRequiredField($serviceName, 'serviceName');

        return $this->makePatchRequest('services.app.updateDeploy', array_merge([
            'projectName' => $projectName,
            'serviceName' => $serviceName,
        ], $deployData));
    }

    /**
     * @throws EasypanelValidationException
     */
    public function updateResources(string $projectName, string $serviceName, array $resourceData): array
    {
        RequestValidator::validateProjectName($projectName);
        RequestValidator::validateRequiredField($serviceName, 'serviceName');

        return $this->makePatchRequest('services.app.updateResources', array_merge([
            'projectName' => $projectName,
            'serviceName' => $serviceName,
        ], $resourceData));
    }

    /**
     * @throws EasypanelValidationException
     */
    public function updateEnv(string $projectName, string $serviceName, array $envData): array
    {
        RequestValidator::validateProjectName($projectName);
        RequestValidator::validateRequiredField($serviceName, 'serviceName');

        return $this->makePatchRequest('services.app.updateEnv', array_merge([
            'projectName' => $projectName,
            'serviceName' => $serviceName,
        ], $envData));
    }

    /**
     * @throws EasypanelValidationException
     */
    public function updateBasicAuth(string $projectName, string $serviceName, array $authData): array
    {
        RequestValidator::validateProjectName($projectName);
        RequestValidator::validateRequiredField($serviceName, 'serviceName');

        return $this->makePatchRequest('services.app.updateBasicAuth', array_merge([
            'projectName' => $projectName,
            'serviceName' => $serviceName,
        ], $authData));
    }

    /**
     * @throws EasypanelValidationException
     */
    public function updateRedirects(string $projectName, string $serviceName, array $redirectData): array
    {
        RequestValidator::validateProjectName($projectName);
        RequestValidator::validateRequiredField($serviceName, 'serviceName');

        return $this->makePatchRequest('services.app.updateRedirects', array_merge([
            'projectName' => $projectName,
            'serviceName' => $serviceName,
        ], $redirectData));
    }

    /**
     * @throws EasypanelValidationException
     */
    public function updateSourceGithub(string $projectName, string $serviceName, array $sourceData): array
    {
        RequestValidator::validateProjectName($projectName);
        RequestValidator::validateRequiredField($serviceName, 'serviceName');

        return $this->makePatchRequest('services.app.updateSourceGithub', array_merge([
            'projectName' => $projectName,
            'serviceName' => $serviceName,
        ], $sourceData));
    }

    /**
     * @throws EasypanelValidationException
     */
    public function updateSourceGit(string $projectName, string $serviceName, array $sourceData): array
    {
        RequestValidator::validateProjectName($projectName);
        RequestValidator::validateRequiredField($serviceName, 'serviceName');

        return $this->makePatchRequest('services.app.updateSourceGit', array_merge([
            'projectName' => $projectName,
            'serviceName' => $serviceName,
        ], $sourceData));
    }

    /**
     * @throws EasypanelValidationException
     */
    public function enableGithubDeploy(string $projectName, string $serviceName): array
    {
        RequestValidator::validateProjectName($projectName);
        RequestValidator::validateRequiredField($serviceName, 'serviceName');

        return $this->makePostRequest('services.app.enableGithubDeploy', [
            'projectName' => $projectName,
            'serviceName' => $serviceName,
        ]);
    }

    /**
     * @throws EasypanelValidationException
     */
    public function disableGithubDeploy(string $projectName, string $serviceName): array
    {
        RequestValidator::validateProjectName($projectName);
        RequestValidator::validateRequiredField($serviceName, 'serviceName');

        return $this->makePostRequest('services.app.disableGithubDeploy', [
            'projectName' => $projectName,
            'serviceName' => $serviceName,
        ]);
    }

    /**
     * @throws EasypanelValidationException
     */
    public function updateBuild(string $projectName, string $serviceName, array $buildData): array
    {
        RequestValidator::validateProjectName($projectName);
        RequestValidator::validateRequiredField($serviceName, 'serviceName');

        return $this->makePatchRequest('services.app.updateBuild', array_merge([
            'projectName' => $projectName,
            'serviceName' => $serviceName,
        ], $buildData));
    }

    /**
     * @throws EasypanelValidationException
     */
    public function refreshDeployToken(string $projectName, string $serviceName): array
    {
        RequestValidator::validateProjectName($projectName);
        RequestValidator::validateRequiredField($serviceName, 'serviceName');

        return $this->makePostRequest('services.app.refreshDeployToken', [
            'projectName' => $projectName,
            'serviceName' => $serviceName,
        ]);
    }

    /**
     * @throws EasypanelValidationException
     */
    public function updateSourceImage(string $projectName, string $serviceName, array $imageData): array
    {
        RequestValidator::validateProjectName($projectName);
        RequestValidator::validateRequiredField($serviceName, 'serviceName');

        return $this->makePatchRequest('services.app.updateSourceImage', array_merge([
            'projectName' => $projectName,
            'serviceName' => $serviceName,
        ], $imageData));
    }

    /**
     * @throws EasypanelValidationException
     */
    public function updateSourceDockerfile(string $projectName, string $serviceName, array $dockerfileData): array
    {
        RequestValidator::validateProjectName($projectName);
        RequestValidator::validateRequiredField($serviceName, 'serviceName');

        return $this->makePatchRequest('services.app.updateSourceDockerfile', array_merge([
            'projectName' => $projectName,
            'serviceName' => $serviceName,
        ], $dockerfileData));
    }

    /**
     * @throws EasypanelValidationException
     */
    public function deployService(string $projectName, string $serviceName): array
    {
        RequestValidator::validateProjectName($projectName);
        RequestValidator::validateRequiredField($serviceName, 'serviceName');

        return $this->makePostRequest('services.app.deployService', [
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

        return $this->makeDeleteRequest('services.app.destroyService', [
            'projectName' => $projectName,
            'serviceName' => $serviceName,
        ]);
    }

    /**
     * @throws EasypanelValidationException
     */
    public function startService(string $projectName, string $serviceName): array
    {
        RequestValidator::validateProjectName($projectName);
        RequestValidator::validateRequiredField($serviceName, 'serviceName');

        return $this->makePostRequest('services.app.startService', [
            'projectName' => $projectName,
            'serviceName' => $serviceName,
        ]);
    }

    /**
     * @throws EasypanelValidationException
     */
    public function stopService(string $projectName, string $serviceName): array
    {
        RequestValidator::validateProjectName($projectName);
        RequestValidator::validateRequiredField($serviceName, 'serviceName');

        return $this->makePostRequest('services.app.stopService', [
            'projectName' => $projectName,
            'serviceName' => $serviceName,
        ]);
    }

    /**
     * @throws EasypanelValidationException
     */
    public function restartService(string $projectName, string $serviceName): array
    {
        RequestValidator::validateProjectName($projectName);
        RequestValidator::validateRequiredField($serviceName, 'serviceName');

        return $this->makePostRequest('services.app.restartService', [
            'projectName' => $projectName,
            'serviceName' => $serviceName,
        ]);
    }

    /**
     * @throws EasypanelValidationException
     */
    public function updateMaintenance(string $projectName, string $serviceName, array $maintenanceData): array
    {
        RequestValidator::validateProjectName($projectName);
        RequestValidator::validateRequiredField($serviceName, 'serviceName');

        return $this->makePatchRequest('services.app.updateMaintenance', array_merge([
            'projectName' => $projectName,
            'serviceName' => $serviceName,
        ], $maintenanceData));
    }

    /**
     * @throws EasypanelValidationException
     */
    public function uploadCodeArchive(string $projectName, string $serviceName, array $archiveData): array
    {
        RequestValidator::validateProjectName($projectName);
        RequestValidator::validateRequiredField($serviceName, 'serviceName');

        return $this->makePostRequest('services.app.uploadCodeArchive', array_merge([
            'projectName' => $projectName,
            'serviceName' => $serviceName,
        ], $archiveData));
    }
}
