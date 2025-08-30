<?php

declare(strict_types=1);

namespace Mrfansi\Easypanel\Services;

final class ServicesCommonService extends AbstractService
{
    /**
     * Get service error information
     */
    public function getServiceError(string $projectName, string $serviceName): array
    {
        return $this->makeRequest('services.common.getServiceError', [
            'projectName' => $projectName,
            'serviceName' => $serviceName,
        ]);
    }

    /**
     * Get service notes
     */
    public function getNotes(string $projectName, string $serviceName): array
    {
        return $this->makeRequest('services.common.getNotes', [
            'projectName' => $projectName,
            'serviceName' => $serviceName,
        ]);
    }

    /**
     * Rename a service
     */
    public function rename(
        string $oldProjectName,
        string $oldServiceName,
        string $newProjectName,
        string $newServiceName
    ): array {
        return $this->makePostRequest('services.common.rename', [
            'oldProjectName' => $oldProjectName,
            'oldServiceName' => $oldServiceName,
            'newProjectName' => $newProjectName,
            'newServiceName' => $newServiceName,
        ]);
    }

    /**
     * Set service notes
     */
    public function setNotes(string $projectName, string $serviceName, string $notes = ''): array
    {
        return $this->makePostRequest('services.common.setNotes', [
            'projectName' => $projectName,
            'serviceName' => $serviceName,
            'notes' => $notes,
        ]);
    }
}
