<?php

declare(strict_types=1);

namespace Mrfansi\Easypanel\Services;

final class ServicesComposeService extends AbstractService
{
    /**
     * Inspect a compose service
     */
    public function inspectService(string $projectName, string $serviceName): array
    {
        return $this->makeRequest('services.compose.inspectService', [
            'projectName' => $projectName,
            'serviceName' => $serviceName,
        ]);
    }

    /**
     * Get Docker services for a compose service
     */
    public function getDockerServices(?string $projectName = null, ?string $serviceName = null): array
    {
        $params = [];
        if ($projectName !== null) {
            $params['projectName'] = $projectName;
        }
        if ($serviceName !== null) {
            $params['serviceName'] = $serviceName;
        }

        return $this->makeRequest('services.compose.getDockerServices', $params);
    }

    /**
     * Get issues for a compose service
     */
    public function getIssues(string $projectName, string $serviceName): array
    {
        return $this->makeRequest('services.compose.getIssues', [
            'projectName' => $projectName,
            'serviceName' => $serviceName,
        ]);
    }

    /**
     * Create a new compose service
     */
    public function createService(array $serviceData): array
    {
        return $this->makePostRequest('services.compose.createService', $serviceData);
    }

    /**
     * Update environment variables for compose service
     */
    public function updateEnv(
        string $projectName,
        string $serviceName,
        string $env = '',
        ?bool $createDotEnv = null
    ): array {
        $data = [
            'projectName' => $projectName,
            'serviceName' => $serviceName,
            'env' => $env,
        ];

        if ($createDotEnv !== null) {
            $data['createDotEnv'] = $createDotEnv;
        }

        return $this->makePostRequest('services.compose.updateEnv', $data);
    }

    /**
     * Refresh deployment token for compose service
     */
    public function refreshDeployToken(string $projectName, string $serviceName): array
    {
        return $this->makePostRequest('services.compose.refreshDeployToken', [
            'projectName' => $projectName,
            'serviceName' => $serviceName,
        ]);
    }

    /**
     * Update inline source content for compose service
     */
    public function updateSourceInline(string $projectName, string $serviceName, string $content): array
    {
        return $this->makePostRequest('services.compose.updateSourceInline', [
            'projectName' => $projectName,
            'serviceName' => $serviceName,
            'content' => $content,
        ]);
    }

    /**
     * Update Git source configuration for compose service
     */
    public function updateSourceGit(
        string $projectName,
        string $serviceName,
        string $repo,
        string $ref,
        string $rootPath,
        string $composeFile
    ): array {
        return $this->makePostRequest('services.compose.updateSourceGit', [
            'projectName' => $projectName,
            'serviceName' => $serviceName,
            'repo' => $repo,
            'ref' => $ref,
            'rootPath' => $rootPath,
            'composeFile' => $composeFile,
        ]);
    }

    /**
     * Update redirects for compose service
     */
    public function updateRedirects(string $projectName, string $serviceName, ?array $redirects = null): array
    {
        $data = [
            'projectName' => $projectName,
            'serviceName' => $serviceName,
        ];

        if ($redirects !== null) {
            $data['redirects'] = $redirects;
        }

        return $this->makePostRequest('services.compose.updateRedirects', $data);
    }

    /**
     * Update basic authentication for compose service
     */
    public function updateBasicAuth(string $projectName, string $serviceName, ?array $basicAuth = null): array
    {
        $data = [
            'projectName' => $projectName,
            'serviceName' => $serviceName,
        ];

        if ($basicAuth !== null) {
            $data['basicAuth'] = $basicAuth;
        }

        return $this->makePostRequest('services.compose.updateBasicAuth', $data);
    }

    /**
     * Update maintenance mode for compose service
     */
    public function updateMaintenance(string $projectName, string $serviceName, array $maintenance): array
    {
        return $this->makePostRequest('services.compose.updateMaintenance', [
            'projectName' => $projectName,
            'serviceName' => $serviceName,
            'maintenance' => $maintenance,
        ]);
    }

    /**
     * Deploy compose service
     */
    public function deployService(string $projectName, string $serviceName, bool $forceRebuild = false): array
    {
        return $this->makePostRequest('services.compose.deployService', [
            'projectName' => $projectName,
            'serviceName' => $serviceName,
            'forceRebuild' => $forceRebuild,
        ]);
    }

    /**
     * Destroy compose service
     */
    public function destroyService(string $projectName, string $serviceName): array
    {
        return $this->makePostRequest('services.compose.destroyService', [
            'projectName' => $projectName,
            'serviceName' => $serviceName,
        ]);
    }

    /**
     * Start compose service
     */
    public function startService(string $projectName, string $serviceName): array
    {
        return $this->makePostRequest('services.compose.startService', [
            'projectName' => $projectName,
            'serviceName' => $serviceName,
        ]);
    }

    /**
     * Stop compose service
     */
    public function stopService(string $projectName, string $serviceName): array
    {
        return $this->makePostRequest('services.compose.stopService', [
            'projectName' => $projectName,
            'serviceName' => $serviceName,
        ]);
    }

    /**
     * Restart compose service
     */
    public function restartService(string $projectName, string $serviceName): array
    {
        return $this->makePostRequest('services.compose.restartService', [
            'projectName' => $projectName,
            'serviceName' => $serviceName,
        ]);
    }
}
