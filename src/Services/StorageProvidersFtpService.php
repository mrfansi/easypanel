<?php

declare(strict_types=1);

namespace Mrfansi\Easypanel\Services;

use Mrfansi\Easypanel\Exceptions\EasypanelValidationException;
use Mrfansi\Easypanel\Validation\RequestValidator;

/**
 * Storage Providers FTP Service
 *
 * Handles FTP storage provider operations including creating, updating, and deleting providers.
 */
final class StorageProvidersFtpService extends AbstractService
{
    /**
     * Create a new FTP storage provider.
     *
     * @throws EasypanelValidationException
     */
    public function createProvider(
        string $name,
        string $host,
        string $username,
        string $password,
        string $port
    ): array {
        RequestValidator::validateRequiredField($name, 'name');
        RequestValidator::validateRequiredField($host, 'host');
        RequestValidator::validateRequiredField($username, 'username');
        RequestValidator::validateRequiredField($password, 'password');
        RequestValidator::validateRequiredField($port, 'port');

        return $this->makePostRequest('storageProviders.ftp.createProvider', [
            'json' => [
                'name' => $name,
                'host' => $host,
                'username' => $username,
                'password' => $password,
                'port' => $port,
            ],
        ]);
    }

    /**
     * Update an existing FTP storage provider.
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

        return $this->makePostRequest('storageProviders.ftp.updateProvider', [
            'json' => $data,
        ]);
    }

    /**
     * Delete an FTP storage provider.
     *
     * @throws EasypanelValidationException
     */
    public function deleteProvider(string $id): array
    {
        RequestValidator::validateRequiredField($id, 'id');

        return $this->makePostRequest('storageProviders.ftp.deleteProvider', [
            'json' => [
                'id' => $id,
            ],
        ]);
    }
}
