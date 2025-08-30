<?php

declare(strict_types=1);

namespace Mrfansi\Easypanel\Services;

final class LemonLicenseService extends AbstractService
{
    /**
     * Get license payload from Lemon Squeezy
     */
    public function getLicensePayload(): array
    {
        return $this->makeRequest('lemonLicense.getLicensePayload');
    }

    /**
     * Activate license by order ID
     */
    public function activateByOrder(string $orderId, string $identifier): array
    {
        return $this->makePostRequest('lemonLicense.activateByOrder', [
            'orderId' => $orderId,
            'identifier' => $identifier,
        ]);
    }

    /**
     * Activate license by license key
     */
    public function activate(string $licenseKey): array
    {
        return $this->makePostRequest('lemonLicense.activate', [
            'licenseKey' => $licenseKey,
        ]);
    }

    /**
     * Deactivate Lemon Squeezy license
     */
    public function deactivate(): array
    {
        return $this->makePostRequest('lemonLicense.deactivate');
    }
}
