<?php

declare(strict_types=1);

namespace Mrfansi\Easypanel\Services;

class GitService extends AbstractService
{
    /**
     * Get the public key for a service's git repository.
     *
     * @param  string  $projectName  The project name
     * @param  string  $serviceName  The service name
     */
    public function getPublicKey(string $projectName, string $serviceName): array
    {
        return $this->makeRequest('git.getPublicKey', [
            'projectName' => $projectName,
            'serviceName' => $serviceName,
        ]);
    }

    /**
     * Generate a new SSH key for a service's git repository.
     *
     * @param  string  $projectName  The project name
     * @param  string  $serviceName  The service name
     */
    public function generateKey(string $projectName, string $serviceName): array
    {
        return $this->makePostRequest('git.generateKey', [
            'projectName' => $projectName,
            'serviceName' => $serviceName,
        ]);
    }
}
