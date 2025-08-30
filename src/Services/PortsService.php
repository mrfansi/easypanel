<?php

declare(strict_types=1);

namespace Mrfansi\Easypanel\Services;

use Mrfansi\Easypanel\Exceptions\EasypanelValidationException;
use Mrfansi\Easypanel\Validation\RequestValidator;

/**
 * Ports Service for Easypanel API
 *
 * Provides methods to manage Docker container port mappings including
 * listing, creating, updating, and deleting port configurations.
 */
final class PortsService extends AbstractService
{
    /**
     * List ports for a service
     *
     * @param  string  $projectName  Project name (lowercase letters, numbers, hyphens, underscores only)
     * @param  string  $serviceName  Service name (lowercase letters, numbers, hyphens, underscores only)
     *
     * @throws EasypanelValidationException
     */
    public function listPorts(string $projectName, string $serviceName): array
    {
        RequestValidator::validateProjectName($projectName);
        RequestValidator::validateServiceName($serviceName);

        return $this->makeRequest('ports.listPorts', [
            'projectName' => $projectName,
            'serviceName' => $serviceName,
        ]);
    }

    /**
     * Create a new port mapping
     *
     * @param  string  $projectName  Project name
     * @param  string  $serviceName  Service name
     * @param  array  $portValues  Port configuration (published, target, protocol)
     *
     * @throws EasypanelValidationException
     */
    public function createPort(string $projectName, string $serviceName, array $portValues): array
    {
        RequestValidator::validateProjectName($projectName);
        RequestValidator::validateServiceName($serviceName);

        $this->validatePortValues($portValues);

        return $this->makePostRequest('ports.createPort', [
            'projectName' => $projectName,
            'serviceName' => $serviceName,
            'values' => $portValues,
        ]);
    }

    /**
     * Update an existing port mapping
     *
     * @param  string  $projectName  Project name
     * @param  string  $serviceName  Service name
     * @param  int  $portIndex  Index of the port to update
     * @param  array  $portValues  Port configuration
     *
     * @throws EasypanelValidationException
     */
    public function updatePort(string $projectName, string $serviceName, int $portIndex, array $portValues): array
    {
        RequestValidator::validateProjectName($projectName);
        RequestValidator::validateServiceName($serviceName);

        if ($portIndex < 0) {
            throw new EasypanelValidationException('Port index must be non-negative');
        }

        $this->validatePortValues($portValues);

        return $this->makePostRequest('ports.updatePort', [
            'projectName' => $projectName,
            'serviceName' => $serviceName,
            'index' => $portIndex,
            'values' => $portValues,
        ]);
    }

    /**
     * Delete a port mapping
     *
     * @param  string  $projectName  Project name
     * @param  string  $serviceName  Service name
     * @param  int  $portIndex  Index of the port to delete
     *
     * @throws EasypanelValidationException
     */
    public function deletePort(string $projectName, string $serviceName, int $portIndex): array
    {
        RequestValidator::validateProjectName($projectName);
        RequestValidator::validateServiceName($serviceName);

        if ($portIndex < 0) {
            throw new EasypanelValidationException('Port index must be non-negative');
        }

        return $this->makePostRequest('ports.deletePort', [
            'projectName' => $projectName,
            'serviceName' => $serviceName,
            'index' => $portIndex,
        ]);
    }

    /**
     * Delete all port mappings for a service
     *
     * @param  string  $projectName  Project name
     * @param  string  $serviceName  Service name
     *
     * @throws EasypanelValidationException
     */
    public function deleteAllPorts(string $projectName, string $serviceName): array
    {
        RequestValidator::validateProjectName($projectName);
        RequestValidator::validateServiceName($serviceName);

        return $this->makePostRequest('ports.deleteAllPorts', [
            'projectName' => $projectName,
            'serviceName' => $serviceName,
        ]);
    }

    /**
     * Validate port values
     *
     * @param  array  $values  Port values to validate
     *
     * @throws EasypanelValidationException
     */
    private function validatePortValues(array $values): void
    {
        $required = ['published', 'target'];
        RequestValidator::validateRequired($values, $required);

        // Validate published port
        if (! is_int($values['published'])) {
            throw new EasypanelValidationException('Published port must be an integer');
        }
        RequestValidator::validatePort($values['published']);

        // Validate target port
        if (! is_int($values['target'])) {
            throw new EasypanelValidationException('Target port must be an integer');
        }
        RequestValidator::validatePort($values['target']);

        // Validate protocol if provided
        if (isset($values['protocol'])) {
            $validProtocols = ['tcp', 'udp'];
            if (! in_array($values['protocol'], $validProtocols)) {
                throw new EasypanelValidationException('Protocol must be either tcp or udp');
            }
        }

        // Check for common port restrictions
        if ($values['published'] < 1024 && $values['published'] !== 80 && $values['published'] !== 443) {
            throw new EasypanelValidationException('Published ports below 1024 are restricted (except 80 and 443)');
        }
    }
}
