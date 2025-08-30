<?php

declare(strict_types=1);

namespace Mrfansi\Easypanel\Services;

use Mrfansi\Easypanel\Exceptions\EasypanelValidationException;
use Mrfansi\Easypanel\Validation\RequestValidator;

/**
 * Storage Providers Local Service
 *
 * Handles local storage provider operations including creating, updating, and deleting providers.
 */
final class StorageProvidersLocalService extends AbstractService
{
    /**
     * Create a new local storage provider.
     *
     * @throws EasypanelValidationException
     */
    public function createProvider(string $name, string $path): array
    {
        RequestValidator::validateRequiredField($name, 'name');
        RequestValidator::validateRequiredField($path, 'path');

        return $this->makePostRequest('storageProviders.local.createProvider', [
            'json' => [
                'name' => $name,
                'path' => $path,
            ],
        ]);
    }

    /**
     * Update an existing local storage provider.
     *
     * @throws EasypanelValidationException
     */
    public function updateProvider(string $id, string $name, string $path): array
    {
        RequestValidator::validateRequiredField($id, 'id');
        RequestValidator::validateRequiredField($name, 'name');
        RequestValidator::validateRequiredField($path, 'path');

        return $this->makePostRequest('storageProviders.local.updateProvider', [
            'json' => [
                'id' => $id,
                'name' => $name,
                'path' => $path,
            ],
        ]);
    }

    /**
     * Delete a local storage provider.
     *
     * @throws EasypanelValidationException
     */
    public function deleteProvider(string $id): array
    {
        RequestValidator::validateRequiredField($id, 'id');

        return $this->makePostRequest('storageProviders.local.deleteProvider', [
            'json' => [
                'id' => $id,
            ],
        ]);
    }
}
