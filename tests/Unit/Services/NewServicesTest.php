<?php

declare(strict_types=1);

use Mrfansi\Easypanel\Contracts\HttpClientInterface;
use Mrfansi\Easypanel\Services\LemonLicenseService;
use Mrfansi\Easypanel\Services\PortalLicenseService;
use Mrfansi\Easypanel\Services\ServerService;
use Mrfansi\Easypanel\Services\ServicesBoxService;
use Mrfansi\Easypanel\Services\ServicesCommonService;
use Mrfansi\Easypanel\Services\ServicesComposeService;
use Mrfansi\Easypanel\Services\ServicesWordPressService;
use Mrfansi\Easypanel\Services\SetupService;
use Mrfansi\Easypanel\Services\SubscriptionService;
use Mrfansi\Easypanel\Services\UpdateService;

beforeEach(function () {
    $this->httpClient = Mockery::mock(HttpClientInterface::class);
});

afterEach(function () {
    Mockery::close();
});

it('can instantiate SetupService', function () {
    $service = new SetupService($this->httpClient);
    expect($service)->toBeInstanceOf(SetupService::class);
});

it('can instantiate UpdateService', function () {
    $service = new UpdateService($this->httpClient);
    expect($service)->toBeInstanceOf(UpdateService::class);
});

it('can instantiate SubscriptionService', function () {
    $service = new SubscriptionService($this->httpClient);
    expect($service)->toBeInstanceOf(SubscriptionService::class);
});

it('can instantiate ServerService', function () {
    $service = new ServerService($this->httpClient);
    expect($service)->toBeInstanceOf(ServerService::class);
});

it('can instantiate PortalLicenseService', function () {
    $service = new PortalLicenseService($this->httpClient);
    expect($service)->toBeInstanceOf(PortalLicenseService::class);
});

it('can instantiate LemonLicenseService', function () {
    $service = new LemonLicenseService($this->httpClient);
    expect($service)->toBeInstanceOf(LemonLicenseService::class);
});

it('can instantiate ServicesBoxService', function () {
    $service = new ServicesBoxService($this->httpClient);
    expect($service)->toBeInstanceOf(ServicesBoxService::class);
});

it('can instantiate ServicesComposeService', function () {
    $service = new ServicesComposeService($this->httpClient);
    expect($service)->toBeInstanceOf(ServicesComposeService::class);
});

it('can instantiate ServicesCommonService', function () {
    $service = new ServicesCommonService($this->httpClient);
    expect($service)->toBeInstanceOf(ServicesCommonService::class);
});

it('can instantiate ServicesWordPressService', function () {
    $service = new ServicesWordPressService($this->httpClient);
    expect($service)->toBeInstanceOf(ServicesWordPressService::class);
});
