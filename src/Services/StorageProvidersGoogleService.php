<?php

declare(strict_types=1);

namespace Mrfansi\Easypanel\Services;

use Mrfansi\Easypanel\Exceptions\EasypanelValidationException;
use Mrfansi\Easypanel\Validation\RequestValidator;

/**
 * Storage Providers Google Service
 *
 * Handles Google storage provider operations including creating, updating, deleting,
 * and disconnecting providers.
 */
final class StorageProvidersGoogleService extends AbstractService
{
    /**
     * Create a new Google storage provider.
     *
     * @throws EasypanelValidationException
     */
    public function createProvider(string $name): array
    {
        RequestValidator::validateRequiredField($name, 'name');

        return $this->makePostRequest('storageProviders.google.createProvider', [
            'json' => [
                'name' => $name,
            ],
        ]);
    }

    /**
     * Update an existing Google storage provider.
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

        return $this->makePostRequest('storageProviders.google.updateProvider', [
            'json' => $data,
        ]);
    }

    /**
     * Delete a Google storage provider.
     *
     * @throws EasypanelValidationException
     */
    public function deleteProvider(string $id): array
    {
        RequestValidator::validateRequiredField($id, 'id');

        return $this->makePostRequest('storageProviders.google.deleteProvider', [
            'json' => [
                'id' => $id,
            ],
        ]);
    }

    /**
     * Disconnect a Google storage provider.
     *
     * @throws EasypanelValidationException
     */
    public function disconnectProvider(string $id): array
    {
        RequestValidator::validateRequiredField($id, 'id');

        return $this->makePostRequest('storageProviders.google.disconnectProvider', [
            'json' => [
                'id' => $id,
            ],
        ]);
    }
}
