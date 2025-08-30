<?php

declare(strict_types=1);

namespace Mrfansi\Easypanel\Services;

use Mrfansi\Easypanel\Exceptions\EasypanelValidationException;
use Mrfansi\Easypanel\Validation\RequestValidator;

/**
 * Mounts Service for Easypanel API
 *
 * Provides methods to manage Docker container mounts including bind mounts,
 * volume mounts, and file mounts for services.
 */
final class MountsService extends AbstractService
{
    /**
     * List mounts for a service
     *
     * @param  string  $projectName  Project name (lowercase letters, numbers, hyphens, underscores only)
     * @param  string  $serviceName  Service name (lowercase letters, numbers, hyphens, underscores only)
     *
     * @throws EasypanelValidationException
     */
    public function listMounts(string $projectName, string $serviceName): array
    {
        RequestValidator::validateProjectName($projectName);
        RequestValidator::validateServiceName($serviceName);

        return $this->makeRequest('mounts.listMounts', [
            'projectName' => $projectName,
            'serviceName' => $serviceName,
        ]);
    }

    /**
     * Create a new mount
     *
     * @param  string  $projectName  Project name
     * @param  string  $serviceName  Service name
     * @param  array  $mountValues  Mount configuration (type: bind|volume|file with appropriate fields)
     *
     * @throws EasypanelValidationException
     */
    public function createMount(string $projectName, string $serviceName, array $mountValues): array
    {
        RequestValidator::validateProjectName($projectName);
        RequestValidator::validateServiceName($serviceName);

        $this->validateMountValues($mountValues);

        return $this->makePostRequest('mounts.createMount', [
            'projectName' => $projectName,
            'serviceName' => $serviceName,
            'values' => $mountValues,
        ]);
    }

    /**
     * Update an existing mount
     *
     * @param  string  $projectName  Project name
     * @param  string  $serviceName  Service name
     * @param  int  $mountIndex  Index of the mount to update
     * @param  array  $mountValues  Mount configuration
     *
     * @throws EasypanelValidationException
     */
    public function updateMount(string $projectName, string $serviceName, int $mountIndex, array $mountValues): array
    {
        RequestValidator::validateProjectName($projectName);
        RequestValidator::validateServiceName($serviceName);

        if ($mountIndex < 0) {
            throw new EasypanelValidationException('Mount index must be non-negative');
        }

        $this->validateMountValues($mountValues);

        return $this->makePostRequest('mounts.updateMount', [
            'projectName' => $projectName,
            'serviceName' => $serviceName,
            'index' => $mountIndex,
            'values' => $mountValues,
        ]);
    }

    /**
     * Delete a mount
     *
     * @param  string  $projectName  Project name
     * @param  string  $serviceName  Service name
     * @param  int  $mountIndex  Index of the mount to delete
     *
     * @throws EasypanelValidationException
     */
    public function deleteMount(string $projectName, string $serviceName, int $mountIndex): array
    {
        RequestValidator::validateProjectName($projectName);
        RequestValidator::validateServiceName($serviceName);

        if ($mountIndex < 0) {
            throw new EasypanelValidationException('Mount index must be non-negative');
        }

        return $this->makePostRequest('mounts.deleteMount', [
            'projectName' => $projectName,
            'serviceName' => $serviceName,
            'index' => $mountIndex,
        ]);
    }

    /**
     * Validate mount values based on type
     *
     * @param  array  $values  Mount values to validate
     *
     * @throws EasypanelValidationException
     */
    private function validateMountValues(array $values): void
    {
        if (! isset($values['type'])) {
            throw new EasypanelValidationException('Mount type is required');
        }

        $validTypes = ['bind', 'volume', 'file'];
        if (! in_array($values['type'], $validTypes)) {
            throw new EasypanelValidationException('Mount type must be one of: '.implode(', ', $validTypes));
        }

        switch ($values['type']) {
            case 'bind':
                $this->validateBindMount($values);
                break;
            case 'volume':
                $this->validateVolumeMount($values);
                break;
            case 'file':
                $this->validateFileMount($values);
                break;
        }
    }

    /**
     * Validate bind mount configuration
     *
     * @param  array  $values  Bind mount values
     *
     * @throws EasypanelValidationException
     */
    private function validateBindMount(array $values): void
    {
        $required = ['hostPath', 'mountPath'];
        RequestValidator::validateRequired($values, $required);

        if (empty($values['hostPath'])) {
            throw new EasypanelValidationException('Host path cannot be empty');
        }

        if (empty($values['mountPath'])) {
            throw new EasypanelValidationException('Mount path cannot be empty');
        }

        // Validate paths start with /
        if (! str_starts_with($values['hostPath'], '/')) {
            throw new EasypanelValidationException('Host path must be an absolute path starting with /');
        }

        if (! str_starts_with($values['mountPath'], '/')) {
            throw new EasypanelValidationException('Mount path must be an absolute path starting with /');
        }
    }

    /**
     * Validate volume mount configuration
     *
     * @param  array  $values  Volume mount values
     *
     * @throws EasypanelValidationException
     */
    private function validateVolumeMount(array $values): void
    {
        $required = ['name', 'mountPath'];
        RequestValidator::validateRequired($values, $required);

        // Validate volume name format
        if (! preg_match('/^[a-z0-9-_]+$/', $values['name'])) {
            throw new EasypanelValidationException('Volume name must contain only lowercase letters, numbers, hyphens, and underscores');
        }

        if (empty($values['mountPath'])) {
            throw new EasypanelValidationException('Mount path cannot be empty');
        }

        // Validate mount path starts with /
        if (! str_starts_with($values['mountPath'], '/')) {
            throw new EasypanelValidationException('Mount path must be an absolute path starting with /');
        }
    }

    /**
     * Validate file mount configuration
     *
     * @param  array  $values  File mount values
     *
     * @throws EasypanelValidationException
     */
    private function validateFileMount(array $values): void
    {
        $required = ['content', 'mountPath'];
        RequestValidator::validateRequired($values, $required);

        // Content can be empty string, but must be present
        if (! isset($values['content'])) {
            throw new EasypanelValidationException('File content is required (can be empty string)');
        }

        if (empty($values['mountPath'])) {
            throw new EasypanelValidationException('Mount path cannot be empty');
        }

        // Validate mount path starts with /
        if (! str_starts_with($values['mountPath'], '/')) {
            throw new EasypanelValidationException('Mount path must be an absolute path starting with /');
        }
    }
}
