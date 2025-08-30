<?php

declare(strict_types=1);

namespace Mrfansi\Easypanel\Services;

use Mrfansi\Easypanel\Exceptions\EasypanelValidationException;
use Mrfansi\Easypanel\Validation\RequestValidator;

/**
 * Storage Providers Dropbox Service
 *
 * Handles Dropbox storage provider operations including creating, updating, deleting,
 * and disconnecting providers.
 */
final class StorageProvidersDropboxService extends AbstractService
{
    /**
     * Create a new Dropbox storage provider.
     *
     * @throws EasypanelValidationException
     */
    public function createProvider(string $name): array
    {
        RequestValidator::validateRequiredField($name, 'name');

        return $this->makePostRequest('storageProviders.dropbox.createProvider', [
            'json' => [
                'name' => $name,
            ],
        ]);
    }

    /**
     * Update an existing Dropbox storage provider.
     *
     * @throws EasypanelValidationException
     */
    public function updateProvider(string $id, ?string $name = null): array
    {
        RequestValidator::validateRequiredField($id, 'id');

        $data = [
            'id' => $id,
        ];

        if ($name !== null) {
            $data['name'] = $name;
        }

        return $this->makePostRequest('storageProviders.dropbox.updateProvider', [
            'json' => $data,
        ]);
    }

    /**
     * Delete a Dropbox storage provider.
     *
     * @throws EasypanelValidationException
     */
    public function deleteProvider(string $id): array
    {
        RequestValidator::validateRequiredField($id, 'id');

        return $this->makePostRequest('storageProviders.dropbox.deleteProvider', [
            'json' => [
                'id' => $id,
            ],
        ]);
    }

    /**
     * Disconnect a Dropbox storage provider.
     *
     * @throws EasypanelValidationException
     */
    public function disconnectProvider(string $id): array
    {
        RequestValidator::validateRequiredField($id, 'id');

        return $this->makePostRequest('storageProviders.dropbox.disconnectProvider', [
            'json' => [
                'id' => $id,
            ],
        ]);
    }
}
