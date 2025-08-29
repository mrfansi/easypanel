<?php

declare(strict_types=1);

namespace Mrfansi\Easypanel\Services;

final class SettingsService extends AbstractService
{
    public function getGithubToken(): array
    {
        return $this->makeRequest('settings.getGithubToken');
    }

    public function getDailyDockerCleanup(): array
    {
        return $this->makeRequest('settings.getDailyDockerCleanup');
    }

    public function getLetsEncryptEmail(): array
    {
        return $this->makeRequest('settings.getLetsEncryptEmail');
    }

    public function getPanelDomain(): array
    {
        return $this->makeRequest('settings.getPanelDomain');
    }

    public function getServerIp(): array
    {
        return $this->makeRequest('settings.getServerIp');
    }

    public function getDemoMode(): array
    {
        return $this->makeRequest('settings.getDemoMode');
    }

    public function setGithubToken(string $token): array
    {
        return $this->makePostRequest('settings.setGithubToken', [
            'token' => $token,
        ]);
    }

    public function setDailyDockerCleanup(bool $enabled): array
    {
        return $this->makePostRequest('settings.setDailyDockerCleanup', [
            'enabled' => $enabled,
        ]);
    }

    public function setLetsEncryptEmail(string $email): array
    {
        return $this->makePostRequest('settings.setLetsEncryptEmail', [
            'email' => $email,
        ]);
    }

    public function setPanelDomain(string $domain): array
    {
        return $this->makePostRequest('settings.setPanelDomain', [
            'domain' => $domain,
        ]);
    }

    public function getGoogleAnalyticsMeasurementId(): array
    {
        return $this->makeRequest('settings.getGoogleAnalyticsMeasurementId');
    }

    public function setGoogleAnalyticsMeasurementId(string $measurementId): array
    {
        return $this->makePostRequest('settings.setGoogleAnalyticsMeasurementId', [
            'measurementId' => $measurementId,
        ]);
    }

    public function restartEasypanel(): array
    {
        return $this->makePostRequest('settings.restartEasypanel');
    }

    public function cleanupDockerImages(): array
    {
        return $this->makePostRequest('settings.cleanupDockerImages');
    }

    public function cleanupDockerBuilder(): array
    {
        return $this->makePostRequest('settings.cleanupDockerBuilder');
    }

    public function systemPrune(): array
    {
        return $this->makePostRequest('settings.systemPrune');
    }

    public function changeCredentials(array $credentials): array
    {
        return $this->makePostRequest('settings.changeCredentials', $credentials);
    }

    public function refreshServerIp(): array
    {
        return $this->makePostRequest('settings.refreshServerIp');
    }

    public function checkForUpdates(): array
    {
        return $this->makeRequest('settings.checkForUpdates');
    }
}
