<?php

declare(strict_types=1);

namespace Mrfansi\Easypanel\Services;

use Mrfansi\Easypanel\Exceptions\EasypanelValidationException;
use Mrfansi\Easypanel\Validation\RequestValidator;

/**
 * Middlewares Service for Easypanel API
 *
 * Provides methods to manage Traefik middlewares including listing,
 * creation, updates, and deletion of middleware configurations.
 */
final class MiddlewaresService extends AbstractService
{
    /**
     * List all middlewares
     */
    public function listMiddlewares(): array
    {
        return $this->makeRequest('middlewares.listMiddlewares');
    }

    /**
     * Create a new middleware
     *
     * @param  array  $middlewareData  Middleware configuration data
     *
     * @throws EasypanelValidationException
     */
    public function createMiddleware(array $middlewareData): array
    {
        // Note: The OpenAPI spec shows "Unknown object properties" for the schema
        // This suggests the middleware data structure is flexible and depends on the middleware type
        return $this->makePostRequest('middlewares.createMiddleware', $middlewareData);
    }

    /**
     * Update an existing middleware
     *
     * @param  array  $middlewareData  Middleware configuration data with ID
     *
     * @throws EasypanelValidationException
     */
    public function updateMiddleware(array $middlewareData): array
    {
        // Note: The OpenAPI spec shows "Unknown object properties" for the schema
        // This suggests the middleware data structure is flexible and depends on the middleware type
        return $this->makePostRequest('middlewares.updateMiddleware', $middlewareData);
    }

    /**
     * Delete a middleware
     *
     * @param  string  $middlewareId  Middleware ID to delete
     *
     * @throws EasypanelValidationException
     */
    public function destroyMiddleware(string $middlewareId): array
    {
        RequestValidator::validateRequiredField($middlewareId, 'id');

        return $this->makePostRequest('middlewares.destroyMiddleware', [
            'id' => $middlewareId,
        ]);
    }
}
