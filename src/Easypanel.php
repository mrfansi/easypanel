<?php

declare(strict_types=1);

namespace Mrfansi\Easypanel;

use Mrfansi\Easypanel\Contracts\HttpClientInterface;
use Mrfansi\Easypanel\Services\ActionsService;
use Mrfansi\Easypanel\Services\AuthService;
use Mrfansi\Easypanel\Services\BrandingService;
use Mrfansi\Easypanel\Services\CertificatesService;
use Mrfansi\Easypanel\Services\CloudflareTunnelService;
use Mrfansi\Easypanel\Services\ClusterService;
use Mrfansi\Easypanel\Services\DatabaseBackupsService;
use Mrfansi\Easypanel\Services\DockerBuildersService;
use Mrfansi\Easypanel\Services\DomainsService;
use Mrfansi\Easypanel\Services\GitService;
use Mrfansi\Easypanel\Services\LemonLicenseService;
use Mrfansi\Easypanel\Services\MiddlewaresService;
use Mrfansi\Easypanel\Services\MonitorService;
use Mrfansi\Easypanel\Services\MountsService;
use Mrfansi\Easypanel\Services\NotificationsService;
use Mrfansi\Easypanel\Services\PortalLicenseService;
use Mrfansi\Easypanel\Services\PortsService;
use Mrfansi\Easypanel\Services\ProjectService;
use Mrfansi\Easypanel\Services\ServerService;
use Mrfansi\Easypanel\Services\ServicesAppService;
use Mrfansi\Easypanel\Services\ServicesBoxService;
use Mrfansi\Easypanel\Services\ServicesCommonService;
use Mrfansi\Easypanel\Services\ServicesComposeService;
use Mrfansi\Easypanel\Services\ServiceService;
use Mrfansi\Easypanel\Services\ServicesMariaDbService;
use Mrfansi\Easypanel\Services\ServicesMongoService;
use Mrfansi\Easypanel\Services\ServicesMySqlService;
use Mrfansi\Easypanel\Services\ServicesPostgresService;
use Mrfansi\Easypanel\Services\ServicesRedisService;
use Mrfansi\Easypanel\Services\ServicesWordPressService;
use Mrfansi\Easypanel\Services\SettingsService;
use Mrfansi\Easypanel\Services\SetupService;
use Mrfansi\Easypanel\Services\StorageProvidersCommonService;
use Mrfansi\Easypanel\Services\StorageProvidersDropboxService;
use Mrfansi\Easypanel\Services\StorageProvidersFtpService;
use Mrfansi\Easypanel\Services\StorageProvidersGoogleService;
use Mrfansi\Easypanel\Services\StorageProvidersLocalService;
use Mrfansi\Easypanel\Services\StorageProvidersS3Service;
use Mrfansi\Easypanel\Services\StorageProvidersSftpService;
use Mrfansi\Easypanel\Services\SubscriptionService;
use Mrfansi\Easypanel\Services\TemplatesService;
use Mrfansi\Easypanel\Services\TraefikService;
use Mrfansi\Easypanel\Services\TwoFactorService;
use Mrfansi\Easypanel\Services\UpdateService;
use Mrfansi\Easypanel\Services\UsersService;
use Mrfansi\Easypanel\Services\VolumeBackupsService;

final class Easypanel
{
    private HttpClientInterface $httpClient;

    public function __construct(HttpClientInterface $httpClient)
    {
        $this->httpClient = $httpClient;
    }

    public function auth(): AuthService
    {
        return new AuthService($this->httpClient);
    }

    public function projects(): ProjectService
    {
        return new ProjectService($this->httpClient);
    }

    public function services(): ServiceService
    {
        return new ServiceService($this->httpClient);
    }

    public function monitor(): MonitorService
    {
        return new MonitorService($this->httpClient);
    }

    public function settings(): SettingsService
    {
        return new SettingsService($this->httpClient);
    }

    public function users(): UsersService
    {
        return new UsersService($this->httpClient);
    }

    public function certificates(): CertificatesService
    {
        return new CertificatesService($this->httpClient);
    }

    public function domains(): DomainsService
    {
        return new DomainsService($this->httpClient);
    }

    public function servicesApp(): ServicesAppService
    {
        return new ServicesAppService($this->httpClient);
    }

    public function servicesMySql(): ServicesMySqlService
    {
        return new ServicesMySqlService($this->httpClient);
    }

    public function templates(): TemplatesService
    {
        return new TemplatesService($this->httpClient);
    }

    // New services added based on OpenAPI specifications

    public function actions(): ActionsService
    {
        return new ActionsService($this->httpClient);
    }

    public function branding(): BrandingService
    {
        return new BrandingService($this->httpClient);
    }

    public function cluster(): ClusterService
    {
        return new ClusterService($this->httpClient);
    }

    public function git(): GitService
    {
        return new GitService($this->httpClient);
    }

    public function servicesMariaDb(): ServicesMariaDbService
    {
        return new ServicesMariaDbService($this->httpClient);
    }

    public function servicesMongo(): ServicesMongoService
    {
        return new ServicesMongoService($this->httpClient);
    }

    public function servicesPostgres(): ServicesPostgresService
    {
        return new ServicesPostgresService($this->httpClient);
    }

    public function servicesRedis(): ServicesRedisService
    {
        return new ServicesRedisService($this->httpClient);
    }

    public function storageProvidersCommon(): StorageProvidersCommonService
    {
        return new StorageProvidersCommonService($this->httpClient);
    }

    public function storageProvidersDropbox(): StorageProvidersDropboxService
    {
        return new StorageProvidersDropboxService($this->httpClient);
    }

    public function storageProvidersFtp(): StorageProvidersFtpService
    {
        return new StorageProvidersFtpService($this->httpClient);
    }

    public function storageProvidersGoogle(): StorageProvidersGoogleService
    {
        return new StorageProvidersGoogleService($this->httpClient);
    }

    public function storageProvidersLocal(): StorageProvidersLocalService
    {
        return new StorageProvidersLocalService($this->httpClient);
    }

    public function storageProvidersS3(): StorageProvidersS3Service
    {
        return new StorageProvidersS3Service($this->httpClient);
    }

    public function storageProvidersSftp(): StorageProvidersSftpService
    {
        return new StorageProvidersSftpService($this->httpClient);
    }

    public function traefik(): TraefikService
    {
        return new TraefikService($this->httpClient);
    }

    public function cloudflareTunnel(): CloudflareTunnelService
    {
        return new CloudflareTunnelService($this->httpClient);
    }

    public function notifications(): NotificationsService
    {
        return new NotificationsService($this->httpClient);
    }

    public function middlewares(): MiddlewaresService
    {
        return new MiddlewaresService($this->httpClient);
    }

    public function volumeBackups(): VolumeBackupsService
    {
        return new VolumeBackupsService($this->httpClient);
    }

    public function databaseBackups(): DatabaseBackupsService
    {
        return new DatabaseBackupsService($this->httpClient);
    }

    public function dockerBuilders(): DockerBuildersService
    {
        return new DockerBuildersService($this->httpClient);
    }

    public function mounts(): MountsService
    {
        return new MountsService($this->httpClient);
    }

    public function ports(): PortsService
    {
        return new PortsService($this->httpClient);
    }

    public function twoFactor(): TwoFactorService
    {
        return new TwoFactorService($this->httpClient);
    }

    public function setup(): SetupService
    {
        return new SetupService($this->httpClient);
    }

    public function update(): UpdateService
    {
        return new UpdateService($this->httpClient);
    }

    public function subscription(): SubscriptionService
    {
        return new SubscriptionService($this->httpClient);
    }

    public function server(): ServerService
    {
        return new ServerService($this->httpClient);
    }

    public function portalLicense(): PortalLicenseService
    {
        return new PortalLicenseService($this->httpClient);
    }

    public function lemonLicense(): LemonLicenseService
    {
        return new LemonLicenseService($this->httpClient);
    }

    public function servicesBox(): ServicesBoxService
    {
        return new ServicesBoxService($this->httpClient);
    }

    public function servicesCompose(): ServicesComposeService
    {
        return new ServicesComposeService($this->httpClient);
    }

    public function servicesCommon(): ServicesCommonService
    {
        return new ServicesCommonService($this->httpClient);
    }

    public function servicesWordPress(): ServicesWordPressService
    {
        return new ServicesWordPressService($this->httpClient);
    }

    public function setBaseUrl(string $baseUrl): self
    {
        $this->httpClient->setBaseUrl($baseUrl);

        return $this;
    }

    public function setAuthToken(string $token): self
    {
        $this->httpClient->setAuthToken($token);

        return $this;
    }

    public function setTimeout(int $timeout): self
    {
        $this->httpClient->setTimeout($timeout);

        return $this;
    }
}
