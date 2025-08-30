<?php

declare(strict_types=1);

namespace Mrfansi\Easypanel\Services;

use Mrfansi\Easypanel\Exceptions\EasypanelValidationException;

/**
 * Traefik Service for Easypanel API
 *
 * Provides methods to manage Traefik reverse proxy configuration,
 * environment variables, custom configuration, dashboard access,
 * and service restart functionality.
 */
final class TraefikService extends AbstractService
{
    /**
     * Get Traefik environment configuration
     */
    public function getEnv(): array
    {
        return $this->makeRequest('traefik.getEnv');
    }

    /**
     * Get Traefik custom configuration
     */
    public function getCustomConfig(): array
    {
        return $this->makeRequest('traefik.getCustomConfig');
    }

    /**
     * Get Traefik dashboard information
     */
    public function getDashboard(): array
    {
        return $this->makeRequest('traefik.getDashboard');
    }

    /**
     * Restart Traefik service
     */
    public function restart(): array
    {
        return $this->makePostRequest('traefik.restart', []);
    }

    /**
     * Set Traefik environment variables
     *
     * @param  string  $env  Environment variables configuration
     *
     * @throws EasypanelValidationException
     */
    public function setEnv(string $env): array
    {
        return $this->makePostRequest('traefik.setEnv', [
            'env' => $env,
        ]);
    }

    /**
     * Set Traefik custom configuration
     *
     * @param  string  $config  Custom configuration content
     *
     * @throws EasypanelValidationException
     */
    public function setCustomConfig(string $config): array
    {
        return $this->makePostRequest('traefik.setCustomConfig', [
            'config' => $config,
        ]);
    }
}
