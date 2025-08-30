<?php

declare(strict_types=1);

namespace Mrfansi\Easypanel\Services;

/**
 * Storage Providers Common Service
 *
 * Handles common storage provider operations including listing providers and options.
 */
final class StorageProvidersCommonService extends AbstractService
{
    /**
     * List all storage providers.
     */
    public function list(): array
    {
        return $this->makeRequest('storageProviders.common.list');
    }

    /**
     * List storage provider options.
     */
    public function listOptions(): array
    {
        return $this->makeRequest('storageProviders.common.listOptions');
    }
}
