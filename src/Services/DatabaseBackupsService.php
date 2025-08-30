<?php

declare(strict_types=1);

namespace Mrfansi\Easypanel\Services;

use Mrfansi\Easypanel\Exceptions\EasypanelValidationException;
use Mrfansi\Easypanel\Validation\RequestValidator;

/**
 * Database Backups Service for Easypanel API
 *
 * Provides methods to manage database backups including listing,
 * creating, updating, deleting, running, and restoring database backups.
 */
final class DatabaseBackupsService extends AbstractService
{
    /**
     * List database backups for a service
     *
     * @param  string  $projectName  Project name (lowercase letters, numbers, hyphens, underscores only)
     * @param  string  $serviceName  Service name (lowercase letters, numbers, hyphens, underscores only)
     *
     * @throws EasypanelValidationException
     */
    public function listDatabaseBackups(string $projectName, string $serviceName): array
    {
        RequestValidator::validateProjectName($projectName);
        RequestValidator::validateServiceName($serviceName);

        return $this->makeRequest('databaseBackups.listDatabaseBackups', [
            'projectName' => $projectName,
            'serviceName' => $serviceName,
        ]);
    }

    /**
     * Get available databases for a service
     *
     * @param  string  $projectName  Project name (lowercase letters, numbers, hyphens, underscores only)
     * @param  string  $serviceName  Service name (lowercase letters, numbers, hyphens, underscores only)
     *
     * @throws EasypanelValidationException
     */
    public function getServiceDatabases(string $projectName, string $serviceName): array
    {
        RequestValidator::validateProjectName($projectName);
        RequestValidator::validateServiceName($serviceName);

        return $this->makeRequest('databaseBackups.getServiceDatabases', [
            'projectName' => $projectName,
            'serviceName' => $serviceName,
        ]);
    }

    /**
     * Create a new database backup configuration
     *
     * @param  array  $backupData  Backup configuration data
     *
     * @throws EasypanelValidationException
     */
    public function createDatabaseBackup(array $backupData): array
    {
        $this->validateDatabaseBackupData($backupData);

        return $this->makePostRequest('databaseBackups.createDatabaseBackup', $backupData);
    }

    /**
     * Update an existing database backup configuration
     *
     * @param  array  $backupData  Backup configuration data including ID
     *
     * @throws EasypanelValidationException
     */
    public function updateDatabaseBackup(array $backupData): array
    {
        RequestValidator::validateRequiredField($backupData['id'] ?? null, 'id');
        $this->validateDatabaseBackupData($backupData);

        return $this->makePostRequest('databaseBackups.updateDatabaseBackup', $backupData);
    }

    /**
     * Delete a database backup configuration
     *
     * @param  string  $backupId  Backup ID to delete
     *
     * @throws EasypanelValidationException
     */
    public function deleteDatabaseBackup(string $backupId): array
    {
        RequestValidator::validateRequiredField($backupId, 'id');

        return $this->makePostRequest('databaseBackups.deleteDatabaseBackup', [
            'id' => $backupId,
        ]);
    }

    /**
     * Run a database backup immediately
     *
     * @param  string  $backupId  Backup ID to run
     *
     * @throws EasypanelValidationException
     */
    public function runDatabaseBackup(string $backupId): array
    {
        RequestValidator::validateRequiredField($backupId, 'id');

        return $this->makePostRequest('databaseBackups.runDatabaseBackup', [
            'id' => $backupId,
        ]);
    }

    /**
     * Restore a database backup
     *
     * @param  array  $restoreData  Restore configuration data
     *
     * @throws EasypanelValidationException
     */
    public function restoreDatabaseBackup(array $restoreData): array
    {
        $this->validateRestoreData($restoreData);

        return $this->makePostRequest('databaseBackups.restoreDatabaseBackup', $restoreData);
    }

    /**
     * Validate database backup data
     *
     * @param  array  $data  Backup data to validate
     *
     * @throws EasypanelValidationException
     */
    private function validateDatabaseBackupData(array $data): void
    {
        $required = ['projectName', 'serviceName', 'enabled', 'schedule', 'databaseName', 'storageProviderId', 'storageProviderPath'];
        RequestValidator::validateRequired($data, $required);

        RequestValidator::validateProjectName($data['projectName']);
        RequestValidator::validateServiceName($data['serviceName']);

        // Validate database name format
        if (! preg_match('/^[a-zA-Z][a-zA-Z0-9_-]{0,62}$/', $data['databaseName'])) {
            throw new EasypanelValidationException('Database name must start with a letter and contain only letters, numbers, underscores, and hyphens (max 63 characters)');
        }

        // Validate schedule format (should be cron expression)
        if (empty($data['schedule'])) {
            throw new EasypanelValidationException('Schedule cannot be empty');
        }

        // Validate enabled is boolean
        if (! is_bool($data['enabled'])) {
            throw new EasypanelValidationException('Enabled must be a boolean value');
        }

        // Validate storage provider ID
        if (empty($data['storageProviderId'])) {
            throw new EasypanelValidationException('Storage provider ID cannot be empty');
        }

        // Validate storage provider path
        if (empty($data['storageProviderPath'])) {
            throw new EasypanelValidationException('Storage provider path cannot be empty');
        }
    }

    /**
     * Validate restore data
     *
     * @param  array  $data  Restore data to validate
     *
     * @throws EasypanelValidationException
     */
    private function validateRestoreData(array $data): void
    {
        $required = ['projectName', 'serviceName', 'storageProviderId', 'path', 'databaseName'];
        RequestValidator::validateRequired($data, $required);

        RequestValidator::validateProjectName($data['projectName']);
        RequestValidator::validateServiceName($data['serviceName']);

        // Validate storage provider ID
        if (empty($data['storageProviderId'])) {
            throw new EasypanelValidationException('Storage provider ID cannot be empty');
        }

        // Validate backup path
        if (empty($data['path'])) {
            throw new EasypanelValidationException('Backup path cannot be empty');
        }

        // Validate database name
        if (empty($data['databaseName'])) {
            throw new EasypanelValidationException('Database name cannot be empty');
        }
    }
}
