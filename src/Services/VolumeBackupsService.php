<?php

declare(strict_types=1);

namespace Mrfansi\Easypanel\Services;

use Mrfansi\Easypanel\Exceptions\EasypanelValidationException;
use Mrfansi\Easypanel\Validation\RequestValidator;

/**
 * Volume Backups Service for Easypanel API
 *
 * Provides methods to manage volume backups including listing volume mounts,
 * creating, updating, deleting, and running volume backup operations.
 */
final class VolumeBackupsService extends AbstractService
{
    /**
     * List volume mounts for a service
     *
     * @param  string  $projectName  Project name (lowercase letters, numbers, hyphens, underscores only)
     * @param  string  $serviceName  Service name (lowercase letters, numbers, hyphens, underscores only)
     *
     * @throws EasypanelValidationException
     */
    public function listVolumeMounts(string $projectName, string $serviceName): array
    {
        RequestValidator::validateProjectName($projectName);
        RequestValidator::validateServiceName($serviceName);

        return $this->makeRequest('volumeBackups.listVolumeMounts', [
            'projectName' => $projectName,
            'serviceName' => $serviceName,
        ]);
    }

    /**
     * List volume backups for a service
     *
     * @param  string  $projectName  Project name (lowercase letters, numbers, hyphens, underscores only)
     * @param  string  $serviceName  Service name (lowercase letters, numbers, hyphens, underscores only)
     *
     * @throws EasypanelValidationException
     */
    public function listVolumeBackups(string $projectName, string $serviceName): array
    {
        RequestValidator::validateProjectName($projectName);
        RequestValidator::validateServiceName($serviceName);

        return $this->makeRequest('volumeBackups.listVolumeBackups', [
            'projectName' => $projectName,
            'serviceName' => $serviceName,
        ]);
    }

    /**
     * Create a new volume backup configuration
     *
     * @param  array  $backupData  Backup configuration data
     *
     * @throws EasypanelValidationException
     */
    public function createVolumeBackup(array $backupData): array
    {
        $this->validateVolumeBackupData($backupData);

        return $this->makePostRequest('volumeBackups.createVolumeBackup', $backupData);
    }

    /**
     * Update an existing volume backup configuration
     *
     * @param  array  $backupData  Backup configuration data including ID
     *
     * @throws EasypanelValidationException
     */
    public function updateVolumeBackup(array $backupData): array
    {
        RequestValidator::validateRequiredField($backupData['id'] ?? null, 'id');
        $this->validateVolumeBackupData($backupData);

        return $this->makePostRequest('volumeBackups.updateVolumeBackup', $backupData);
    }

    /**
     * Delete a volume backup configuration
     *
     * @param  string  $backupId  Backup ID to delete
     *
     * @throws EasypanelValidationException
     */
    public function destroyVolumeBackup(string $backupId): array
    {
        RequestValidator::validateRequiredField($backupId, 'id');

        return $this->makePostRequest('volumeBackups.destroyVolumeBackup', [
            'id' => $backupId,
        ]);
    }

    /**
     * Run a volume backup immediately
     *
     * @param  string  $backupId  Backup ID to run
     *
     * @throws EasypanelValidationException
     */
    public function runVolumeBackup(string $backupId): array
    {
        RequestValidator::validateRequiredField($backupId, 'id');

        return $this->makePostRequest('volumeBackups.runVolumeBackup', [
            'id' => $backupId,
        ]);
    }

    /**
     * Validate volume backup data
     *
     * @param  array  $data  Backup data to validate
     *
     * @throws EasypanelValidationException
     */
    private function validateVolumeBackupData(array $data): void
    {
        $required = ['storageProviderId', 'storageProviderPath', 'enabled', 'schedule', 'volumeName', 'projectName', 'serviceName'];
        RequestValidator::validateRequired($data, $required);

        RequestValidator::validateProjectName($data['projectName']);
        RequestValidator::validateServiceName($data['serviceName']);
        RequestValidator::validateRequiredField($data['storageProviderId'], 'storageProviderId');

        // Validate storage provider path format
        if (! preg_match('/^[\w-\/.]+$/', $data['storageProviderPath'])) {
            throw new EasypanelValidationException('Storage provider path contains invalid characters');
        }

        // Validate schedule format (should be cron expression)
        if (empty($data['schedule'])) {
            throw new EasypanelValidationException('Schedule cannot be empty');
        }

        // Validate enabled is boolean
        if (! is_bool($data['enabled'])) {
            throw new EasypanelValidationException('Enabled must be a boolean value');
        }
    }
}
