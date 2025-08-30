<?php

declare(strict_types=1);

namespace Mrfansi\Easypanel\Services;

use Mrfansi\Easypanel\Exceptions\EasypanelValidationException;
use Mrfansi\Easypanel\Validation\RequestValidator;

/**
 * Two Factor Authentication Service for Easypanel API
 *
 * Provides methods to manage two-factor authentication including
 * configuration, enabling, and disabling 2FA for user accounts.
 */
final class TwoFactorService extends AbstractService
{
    /**
     * Configure two-factor authentication
     *
     * This endpoint typically returns QR code data and secret key for setting up 2FA.
     */
    public function configure(): array
    {
        return $this->makePostRequest('twoFactor.configure', []);
    }

    /**
     * Enable two-factor authentication
     *
     * @param  string  $code  Verification code from authenticator app
     *
     * @throws EasypanelValidationException
     */
    public function enable(string $code): array
    {
        RequestValidator::validateRequiredField($code, 'code');

        $this->validateTwoFactorCode($code);

        return $this->makePostRequest('twoFactor.enable', [
            'code' => $code,
        ]);
    }

    /**
     * Disable two-factor authentication
     *
     * This will disable 2FA for the current user account.
     */
    public function disable(): array
    {
        return $this->makePostRequest('twoFactor.disable', []);
    }

    /**
     * Validate two-factor authentication code format
     *
     * @param  string  $code  Code to validate
     *
     * @throws EasypanelValidationException
     */
    private function validateTwoFactorCode(string $code): void
    {
        // TOTP codes are typically 6 digits
        if (! preg_match('/^\d{6}$/', $code)) {
            throw new EasypanelValidationException('Two-factor authentication code must be a 6-digit number');
        }
    }
}
