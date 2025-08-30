<?php

declare(strict_types=1);

namespace Mrfansi\Easypanel\Services;

final class PortalLicenseService extends AbstractService
{
    /**
     * Get license payload from portal
     */
    public function getLicensePayload(): array
    {
        return $this->makeRequest('portalLicense.getLicensePayload');
    }

    /**
     * Activate portal license
     */
    public function activate(): array
    {
        return $this->makePostRequest('portalLicense.activate');
    }

    /**
     * Deactivate portal license
     */
    public function deactivate(): array
    {
        return $this->makePostRequest('portalLicense.deactivate');
    }
}
