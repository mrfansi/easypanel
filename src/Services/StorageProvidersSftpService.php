<?php

declare(strict_types=1);

namespace Mrfansi\Easypanel\Services;

use Mrfansi\Easypanel\Exceptions\EasypanelValidationException;
use Mrfansi\Easypanel\Validation\RequestValidator;

/**
 * Storage Providers SFTP Service
 *
 * Handles SFTP storage provider operations including creating, updating, and deleting providers.
 */
final class StorageProvidersSftpService extends AbstractService
{
    /**
     * Create a new SFTP storage provider.
     *
     * @throws EasypanelValidationException
     */
    public function createProvider(
        string $name,
        string $host,
        string $username,
        string $password,
        ?string $port = null
    ): array {
        RequestValidator::validateRequiredField($name, 'name');
        RequestValidator::validateRequiredField($host, 'host');
        RequestValidator::validateRequiredField($username, 'username');
        RequestValidator::validateRequiredField($password, 'password');

        $data = [
            'name' => $name,
            'host' => $host,
            'username' => $username,
            'password' => $password,
        ];

        if ($port !== null) {
            $data['port'] = $port;
        }

        return $this->makePostRequest('storageProviders.sftp.createProvider', [
            'json' => $data,
        ]);
    }

    /**
     * Update an existing SFTP storage provider.
     *
     * @throws EasypanelValidationException
     */
    public function updateProvider(
        string $id,
        string $name,
        string $host,
        string $username,
        string $password,
        ?string $port = null
    ): array {
        RequestValidator::validateRequiredField($id, 'id');
        RequestValidator::validateRequiredField($name, 'name');
        RequestValidator::validateRequiredField($host, 'host');
        RequestValidator::validateRequiredField($username, 'username');
        RequestValidator::validateRequiredField($password, 'password');

        $data = [
            'id' => $id,
            'name' => $name,
            'host' => $host,
            'username' => $username,
            'password' => $password,
        ];

        if ($port !== null) {
            $data['port'] = $port;
        }

        return $this->makePostRequest('storageProviders.sftp.updateProvider', [
            'json' => $data,
        ]);
    }

    /**
     * Delete an SFTP storage provider.
     *
     * @throws EasypanelValidationException
     */
    public function deleteProvider(string $id): array
    {
        RequestValidator::validateRequiredField($id, 'id');

        return $this->makePostRequest('storageProviders.sftp.deleteProvider', [
            'json' => [
                'id' => $id,
            ],
        ]);
    }
}
