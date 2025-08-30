<?php

declare(strict_types=1);

namespace Mrfansi\Easypanel\Services;

final class ServerService extends AbstractService
{
    /**
     * Reboot the server
     */
    public function reboot(): array
    {
        return $this->makePostRequest('server.reboot');
    }
}
