<?php

declare(strict_types=1);

use Mrfansi\Easypanel\Contracts\HttpClientInterface;
use Mrfansi\Easypanel\Services\ServicesBoxService;

beforeEach(function () {
    $this->httpClient = Mockery::mock(HttpClientInterface::class);
    $this->service = new ServicesBoxService($this->httpClient);
});

afterEach(function () {
    Mockery::close();
});

it('can inspect service', function () {
    $expectedData = ['service' => ['name' => 'test-service']];
    $this->httpClient
        ->shouldReceive('get')
        ->with('/api/trpc/services.box.inspectService', [
            'projectName' => 'test-project',
            'serviceName' => 'test-service',
        ])
        ->andReturn($expectedData);

    $result = $this->service->inspectService('test-project', 'test-service');
    expect($result)->toBe($expectedData);
});

it('can list presets', function () {
    $expectedData = ['presets' => []];
    $this->httpClient
        ->shouldReceive('get')
        ->with('/api/trpc/services.box.listPresets', [])
        ->andReturn($expectedData);

    $result = $this->service->listPresets();
    expect($result)->toBe($expectedData);
});

it('can create service', function () {
    $serviceData = [
        'projectName' => 'test-project',
        'serviceName' => 'test-service',
    ];
    $expectedData = ['success' => true];

    $this->httpClient
        ->shouldReceive('post')
        ->with('/api/trpc/services.box.createService', $serviceData)
        ->andReturn($expectedData);

    $result = $this->service->createService($serviceData);
    expect($result)->toBe($expectedData);
});

it('can start service', function () {
    $expectedData = ['success' => true];
    $this->httpClient
        ->shouldReceive('post')
        ->with('/api/trpc/services.box.startService', [
            'projectName' => 'test-project',
            'serviceName' => 'test-service',
        ])
        ->andReturn($expectedData);

    $result = $this->service->startService('test-project', 'test-service');
    expect($result)->toBe($expectedData);
});

it('can stop service', function () {
    $expectedData = ['success' => true];
    $this->httpClient
        ->shouldReceive('post')
        ->with('/api/trpc/services.box.stopService', [
            'projectName' => 'test-project',
            'serviceName' => 'test-service',
        ])
        ->andReturn($expectedData);

    $result = $this->service->stopService('test-project', 'test-service');
    expect($result)->toBe($expectedData);
});

it('can restart service', function () {
    $expectedData = ['success' => true];
    $this->httpClient
        ->shouldReceive('post')
        ->with('/api/trpc/services.box.restartService', [
            'projectName' => 'test-project',
            'serviceName' => 'test-service',
        ])
        ->andReturn($expectedData);

    $result = $this->service->restartService('test-project', 'test-service');
    expect($result)->toBe($expectedData);
});
