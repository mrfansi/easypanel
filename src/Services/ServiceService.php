<?php

declare(strict_types=1);

namespace Mrfansi\Easypanel\Services;

final class ServiceService extends AbstractService
{
    // Common service operations
    public function getServiceError(string $projectName, string $serviceName): array
    {
        return $this->makeRequest('services.common.getServiceError', [
            'projectName' => $projectName,
            'serviceName' => $serviceName,
        ]);
    }

    public function getNotes(string $projectName, string $serviceName): array
    {
        return $this->makeRequest('services.common.getNotes', [
            'projectName' => $projectName,
            'serviceName' => $serviceName,
        ]);
    }

    // App service operations
    public function inspectAppService(string $projectName, string $serviceName): array
    {
        return $this->makeRequest('services.app.inspectService', [
            'projectName' => $projectName,
            'serviceName' => $serviceName,
        ]);
    }

    public function getExposedPorts(string $projectName, string $serviceName): array
    {
        return $this->makeRequest('services.app.getExposedPorts', [
            'projectName' => $projectName,
            'serviceName' => $serviceName,
        ]);
    }

    // WordPress service operations
    public function inspectWordPressService(string $projectName, string $serviceName): array
    {
        return $this->makeRequest('services.wordpress.inspectService', [
            'projectName' => $projectName,
            'serviceName' => $serviceName,
        ]);
    }

    public function getWordPressUsers(string $projectName, string $serviceName): array
    {
        return $this->makeRequest('services.wordpress.getUsers', [
            'projectName' => $projectName,
            'serviceName' => $serviceName,
        ]);
    }

    public function getWordPressRoles(string $projectName, string $serviceName): array
    {
        return $this->makeRequest('services.wordpress.getRoles', [
            'projectName' => $projectName,
            'serviceName' => $serviceName,
        ]);
    }

    public function getWordPressMaintenanceMode(string $projectName, string $serviceName): array
    {
        return $this->makeRequest('services.wordpress.getMaintenanceMode', [
            'projectName' => $projectName,
            'serviceName' => $serviceName,
        ]);
    }

    public function getWordPressThemes(string $projectName, string $serviceName): array
    {
        return $this->makeRequest('services.wordpress.getThemes', [
            'projectName' => $projectName,
            'serviceName' => $serviceName,
        ]);
    }

    public function searchWordPressTheme(string $projectName, string $serviceName, string $search): array
    {
        return $this->makeRequest('services.wordpress.searchTheme', [
            'projectName' => $projectName,
            'serviceName' => $serviceName,
            'search' => $search,
        ]);
    }

    public function getWordPressPlugins(string $projectName, string $serviceName): array
    {
        return $this->makeRequest('services.wordpress.getPlugins', [
            'projectName' => $projectName,
            'serviceName' => $serviceName,
        ]);
    }

    public function searchWordPressPlugin(string $projectName, string $serviceName, string $search): array
    {
        return $this->makeRequest('services.wordpress.searchPlugin', [
            'projectName' => $projectName,
            'serviceName' => $serviceName,
            'search' => $search,
        ]);
    }

    public function getWordPressOptions(string $projectName, string $serviceName): array
    {
        return $this->makeRequest('services.wordpress.getOptions', [
            'projectName' => $projectName,
            'serviceName' => $serviceName,
        ]);
    }

    public function getWordPressDatabaseServices(string $projectName): array
    {
        return $this->makeRequest('services.wordpress.getDatabaseServices', [
            'projectName' => $projectName,
        ]);
    }

    public function getWordPressConfig(string $projectName, string $serviceName): array
    {
        return $this->makeRequest('services.wordpress.getWpConfig', [
            'projectName' => $projectName,
            'serviceName' => $serviceName,
        ]);
    }

    public function getWordPressProfile(string $projectName, string $serviceName, string $stage): array
    {
        return $this->makeRequest('services.wordpress.getProfile', [
            'projectName' => $projectName,
            'serviceName' => $serviceName,
            'stage' => $stage,
        ]);
    }

    // Database service operations
    public function inspectMariaDbService(string $projectName, string $serviceName): array
    {
        return $this->makeRequest('services.mariadb.inspectService', [
            'projectName' => $projectName,
            'serviceName' => $serviceName,
        ]);
    }

    public function inspectMongoService(string $projectName, string $serviceName): array
    {
        return $this->makeRequest('services.mongo.inspectService', [
            'projectName' => $projectName,
            'serviceName' => $serviceName,
        ]);
    }

    public function inspectMySqlService(string $projectName, string $serviceName): array
    {
        return $this->makeRequest('services.mysql.inspectService', [
            'projectName' => $projectName,
            'serviceName' => $serviceName,
        ]);
    }

    public function inspectPostgresService(string $projectName, string $serviceName): array
    {
        return $this->makeRequest('services.postgres.inspectService', [
            'projectName' => $projectName,
            'serviceName' => $serviceName,
        ]);
    }

    public function inspectRedisService(string $projectName, string $serviceName): array
    {
        return $this->makeRequest('services.redis.inspectService', [
            'projectName' => $projectName,
            'serviceName' => $serviceName,
        ]);
    }

    // Box service operations
    public function inspectBoxService(string $projectName, string $serviceName): array
    {
        return $this->makeRequest('services.box.inspectService', [
            'projectName' => $projectName,
            'serviceName' => $serviceName,
        ]);
    }

    public function listBoxPresets(): array
    {
        return $this->makeRequest('services.box.listPresets');
    }

    // Compose service operations
    public function inspectComposeService(string $projectName, string $serviceName): array
    {
        return $this->makeRequest('services.compose.inspectService', [
            'projectName' => $projectName,
            'serviceName' => $serviceName,
        ]);
    }

    public function getDockerServices(string $projectName, string $serviceName): array
    {
        return $this->makeRequest('services.compose.getDockerServices', [
            'projectName' => $projectName,
            'serviceName' => $serviceName,
        ]);
    }

    public function getComposeIssues(string $projectName, string $serviceName): array
    {
        return $this->makeRequest('services.compose.getIssues', [
            'projectName' => $projectName,
            'serviceName' => $serviceName,
        ]);
    }
}
