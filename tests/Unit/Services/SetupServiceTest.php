<?php

declare(strict_types=1);

use Mrfansi\Easypanel\Contracts\HttpClientInterface;
use Mrfansi\Easypanel\Services\SetupService;

beforeEach(function () {
    $this->httpClient = Mockery::mock(HttpClientInterface::class);
    $this->service = new SetupService($this->httpClient);
});

afterEach(function () {
    Mockery::close();
});

it('can get setup status', function () {
    $expectedData = ['status' => 'ready'];
    $this->httpClient
        ->shouldReceive('get')
        ->with('/api/trpc/setup.getStatus', [])
        ->andReturn($expectedData);

    $result = $this->service->getStatus();
    expect($result)->toBe($expectedData);
});

it('can setup easypanel', function () {
    $setupData = [
        'email' => 'test@example.com',
        'password' => 'securepassword',
        'subscribe' => true,
        'source' => 'test',
        'terms' => true,
    ];
    $expectedData = ['success' => true];

    $this->httpClient
        ->shouldReceive('post')
        ->with('/api/trpc/setup.setup', $setupData)
        ->andReturn($expectedData);

    $result = $this->service->setup(
        'test@example.com',
        'securepassword',
        true,
        'test',
        true
    );
    expect($result)->toBe($expectedData);
});
