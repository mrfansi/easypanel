<?php

declare(strict_types=1);

namespace Mrfansi\Easypanel\Services;

final class UpdateService extends AbstractService
{
    /**
     * Get update status
     */
    public function getStatus(): array
    {
        return $this->makeRequest('update.getStatus');
    }

    /**
     * Perform system update
     */
    public function update(): array
    {
        return $this->makePostRequest('update.update');
    }
}
