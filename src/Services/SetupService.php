<?php

declare(strict_types=1);

namespace Mrfansi\Easypanel\Services;

final class SetupService extends AbstractService
{
    /**
     * Get setup status
     */
    public function getStatus(): array
    {
        return $this->makeRequest('setup.getStatus');
    }

    /**
     * Setup Easypanel with initial configuration
     */
    public function setup(
        string $email,
        string $password,
        bool $subscribe,
        string $source,
        bool $terms
    ): array {
        return $this->makePostRequest('setup.setup', [
            'email' => $email,
            'password' => $password,
            'subscribe' => $subscribe,
            'source' => $source,
            'terms' => $terms,
        ]);
    }
}
