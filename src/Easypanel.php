<?php

declare(strict_types=1);

namespace Mrfansi\Easypanel;

use Mrfansi\Easypanel\Contracts\HttpClientInterface;
use Mrfansi\Easypanel\Services\AuthService;
use Mrfansi\Easypanel\Services\CertificatesService;
use Mrfansi\Easypanel\Services\DomainsService;
use Mrfansi\Easypanel\Services\MonitorService;
use Mrfansi\Easypanel\Services\ProjectService;
use Mrfansi\Easypanel\Services\ServicesAppService;
use Mrfansi\Easypanel\Services\ServiceService;
use Mrfansi\Easypanel\Services\ServicesMySqlService;
use Mrfansi\Easypanel\Services\SettingsService;
use Mrfansi\Easypanel\Services\TemplatesService;
use Mrfansi\Easypanel\Services\UsersService;

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
