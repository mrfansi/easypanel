<?php

declare(strict_types=1);

namespace Mrfansi\Easypanel;

use Mrfansi\Easypanel\Contracts\HttpClientInterface;
use Mrfansi\Easypanel\Contracts\ServiceInterface;

final class Easypanel
{
    private HttpClientInterface $httpClient;

    private array $serviceInstances = [];

    private array $serviceMap = [
        // Core Services
        'auth' => 'AuthService',
        'projects' => 'ProjectService',
        'services' => 'ServiceService',
        'monitor' => 'MonitorService',
        'settings' => 'SettingsService',
        'users' => 'UsersService',
        'certificates' => 'CertificatesService',
        'domains' => 'DomainsService',
        'templates' => 'TemplatesService',
        
        // Infrastructure Services
        'actions' => 'ActionsService',
        'branding' => 'BrandingService',
        'cluster' => 'ClusterService',
        'git' => 'GitService',
        'traefik' => 'TraefikService',
        'cloudflareTunnel' => 'CloudflareTunnelService',
        'notifications' => 'NotificationsService',
        'middlewares' => 'MiddlewaresService',
        'dockerBuilders' => 'DockerBuildersService',
        'mounts' => 'MountsService',
        'ports' => 'PortsService',
        'twoFactor' => 'TwoFactorService',
        'setup' => 'SetupService',
        'update' => 'UpdateService',
        'subscription' => 'SubscriptionService',
        'server' => 'ServerService',
        
        // Database Services
        'servicesApp' => 'ServicesAppService',
        'servicesMySql' => 'ServicesMySqlService',
        'servicesMariaDb' => 'ServicesMariaDbService',
        'servicesMongo' => 'ServicesMongoService',
        'servicesPostgres' => 'ServicesPostgresService',
        'servicesRedis' => 'ServicesRedisService',
        'servicesWordPress' => 'ServicesWordPressService',
        'servicesBox' => 'ServicesBoxService',
        'servicesCompose' => 'ServicesComposeService',
        'servicesCommon' => 'ServicesCommonService',
        
        // Storage Services
        'storageProvidersCommon' => 'StorageProvidersCommonService',
        'storageProvidersDropbox' => 'StorageProvidersDropboxService',
        'storageProvidersFtp' => 'StorageProvidersFtpService',
        'storageProvidersGoogle' => 'StorageProvidersGoogleService',
        'storageProvidersLocal' => 'StorageProvidersLocalService',
        'storageProvidersS3' => 'StorageProvidersS3Service',
        'storageProvidersSftp' => 'StorageProvidersSftpService',
        
        // Backup Services
        'volumeBackups' => 'VolumeBackupsService',
        'databaseBackups' => 'DatabaseBackupsService',
        
        // License Services
        'portalLicense' => 'PortalLicenseService',
        'lemonLicense' => 'LemonLicenseService',
    ];

    public function __construct(HttpClientInterface $httpClient)
    {
        $this->httpClient = $httpClient;
    }

    public function __call(string $method, array $arguments): ServiceInterface
    {
        if (!isset($this->serviceMap[$method])) {
            throw new \BadMethodCallException("Service '{$method}' does not exist.");
        }

        if (!isset($this->serviceInstances[$method])) {
            $serviceClass = 'Mrfansi\\Easypanel\\Services\\' . $this->serviceMap[$method];
            
            if (!class_exists($serviceClass)) {
                throw new \RuntimeException("Service class '{$serviceClass}' does not exist.");
            }

            $this->serviceInstances[$method] = new $serviceClass($this->httpClient);
        }

        return $this->serviceInstances[$method];
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
