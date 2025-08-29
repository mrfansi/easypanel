<?php

declare(strict_types=1);

use Mrfansi\Easypanel\Contracts\HttpClientInterface;
use Mrfansi\Easypanel\Exceptions\EasypanelValidationException;
use Mrfansi\Easypanel\Services\DomainsService;

beforeEach(function () {
    $this->httpClient = Mockery::mock(HttpClientInterface::class);
    $this->service = new DomainsService($this->httpClient);
});

afterEach(function () {
    Mockery::close();
});

it('can get primary domain', function () {
    $expectedData = ['domain' => 'example.com'];
    $this->httpClient
        ->shouldReceive('get')
        ->with('/api/trpc/domains.getPrimaryDomain', [])
        ->andReturn($expectedData);

    $result = $this->service->getPrimaryDomain();
    expect($result)->toBe($expectedData);
});

it('can list domains', function () {
    $expectedData = ['domains' => []];
    $this->httpClient
        ->shouldReceive('get')
        ->with('/api/trpc/domains.listDomains', [])
        ->andReturn($expectedData);

    $result = $this->service->listDomains();
    expect($result)->toBe($expectedData);
});

it('can create domain', function () {
    $domainData = ['name' => 'example.com'];
    $expectedData = ['domain' => ['id' => 1]];

    $this->httpClient
        ->shouldReceive('post')
        ->with('/api/trpc/domains.createDomain', $domainData)
        ->andReturn($expectedData);

    $result = $this->service->createDomain($domainData);
    expect($result)->toBe($expectedData);
});

it('throws validation exception for missing domain name in create', function () {
    $this->service->createDomain([]);
})->throws(EasypanelValidationException::class);

it('can update domain', function () {
    $domainId = 'domain-123';
    $domainData = ['name' => 'updated.example.com'];
    $expectedData = ['success' => true];

    $this->httpClient
        ->shouldReceive('patch')
        ->with('/api/trpc/domains.updateDomain', array_merge(['domainId' => $domainId], $domainData))
        ->andReturn($expectedData);

    $result = $this->service->updateDomain($domainId, $domainData);
    expect($result)->toBe($expectedData);
});

it('can delete domain', function () {
    $domainId = 'domain-123';
    $expectedData = ['success' => true];

    $this->httpClient
        ->shouldReceive('delete')
        ->with('/api/trpc/domains.deleteDomain', ['domainId' => $domainId])
        ->andReturn($expectedData);

    $result = $this->service->deleteDomain($domainId);
    expect($result)->toBe($expectedData);
});

it('can set primary domain', function () {
    $domainName = 'example.com';
    $expectedData = ['success' => true];

    $this->httpClient
        ->shouldReceive('post')
        ->with('/api/trpc/domains.setPrimaryDomain', ['domainName' => $domainName])
        ->andReturn($expectedData);

    $result = $this->service->setPrimaryDomain($domainName);
    expect($result)->toBe($expectedData);
});
