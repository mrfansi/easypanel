<?php

declare(strict_types=1);

use Illuminate\Http\Client\Factory as HttpFactory;
use Illuminate\Http\Client\PendingRequest;
use Illuminate\Http\Client\Response;
use Mrfansi\Easypanel\Easypanel;
use Mrfansi\Easypanel\Http\HttpClient;

beforeEach(function () {
    $this->httpFactory = Mockery::mock(HttpFactory::class);
    $this->pendingRequest = Mockery::mock(PendingRequest::class);
    $this->response = Mockery::mock(Response::class);

    $httpClient = new HttpClient($this->httpFactory);
    $this->easypanel = new Easypanel($httpClient);
});

afterEach(function () {
    Mockery::close();
});

it('can authenticate and get user info', function () {
    $expectedData = ['user' => ['id' => 1, 'email' => 'admin@example.com']];

    $this->httpFactory->shouldReceive('baseUrl')->andReturn($this->pendingRequest);
    $this->pendingRequest->shouldReceive('timeout')->andReturn($this->pendingRequest);
    $this->pendingRequest->shouldReceive('accept')->andReturn($this->pendingRequest);
    $this->pendingRequest->shouldReceive('withToken')->andReturn($this->pendingRequest);
    $this->pendingRequest->shouldReceive('get')->andReturn($this->response);
    $this->response->shouldReceive('status')->andReturn(200);
    $this->response->shouldReceive('json')->andReturn($expectedData);

    $result = $this->easypanel->auth()->getUser();

    expect($result)->toBe($expectedData);
});

it('can manage projects', function () {
    $projectsData = ['projects' => [['name' => 'test-project']]];

    $this->httpFactory->shouldReceive('baseUrl')->andReturn($this->pendingRequest);
    $this->pendingRequest->shouldReceive('timeout')->andReturn($this->pendingRequest);
    $this->pendingRequest->shouldReceive('accept')->andReturn($this->pendingRequest);
    $this->pendingRequest->shouldReceive('withToken')->andReturn($this->pendingRequest);
    $this->pendingRequest->shouldReceive('get')->andReturn($this->response);
    $this->response->shouldReceive('status')->andReturn(200);
    $this->response->shouldReceive('json')->andReturn($projectsData);

    $result = $this->easypanel->projects()->listProjects();

    expect($result)->toBe($projectsData);
});

it('can monitor services', function () {
    $statsData = ['cpu' => 45.2, 'memory' => 1024];

    $this->httpFactory->shouldReceive('baseUrl')->andReturn($this->pendingRequest);
    $this->pendingRequest->shouldReceive('timeout')->andReturn($this->pendingRequest);
    $this->pendingRequest->shouldReceive('accept')->andReturn($this->pendingRequest);
    $this->pendingRequest->shouldReceive('withToken')->andReturn($this->pendingRequest);
    $this->pendingRequest->shouldReceive('get')->andReturn($this->response);
    $this->response->shouldReceive('status')->andReturn(200);
    $this->response->shouldReceive('json')->andReturn($statsData);

    $result = $this->easypanel->monitor()->getSystemStats();

    expect($result)->toBe($statsData);
});

it('can configure client settings', function () {
    $easypanel = $this->easypanel
        ->setBaseUrl('https://example.com')
        ->setAuthToken('test-token')
        ->setTimeout(60);

    expect($easypanel)->toBeInstanceOf(Easypanel::class);
});

it('can fetch server ip from settings', function () {
    $settingsData = ['ip' => '203.0.113.10'];

    $this->httpFactory->shouldReceive('baseUrl')->andReturn($this->pendingRequest);
    $this->pendingRequest->shouldReceive('timeout')->andReturn($this->pendingRequest);
    $this->pendingRequest->shouldReceive('accept')->andReturn($this->pendingRequest);
    $this->pendingRequest->shouldReceive('withToken')->andReturn($this->pendingRequest);
    $this->pendingRequest->shouldReceive('get')->andReturn($this->response);
    $this->response->shouldReceive('status')->andReturn(200);
    $this->response->shouldReceive('json')->andReturn($settingsData);

    $result = $this->easypanel->settings()->getServerIp();

    expect($result)->toBe($settingsData);
});

it('can fetch demo mode from settings', function () {
    $settingsData = ['enabled' => true];

    $this->httpFactory->shouldReceive('baseUrl')->andReturn($this->pendingRequest);
    $this->pendingRequest->shouldReceive('timeout')->andReturn($this->pendingRequest);
    $this->pendingRequest->shouldReceive('accept')->andReturn($this->pendingRequest);
    $this->pendingRequest->shouldReceive('withToken')->andReturn($this->pendingRequest);
    $this->pendingRequest->shouldReceive('get')->andReturn($this->response);
    $this->response->shouldReceive('status')->andReturn(200);
    $this->response->shouldReceive('json')->andReturn($settingsData);

    $result = $this->easypanel->settings()->getDemoMode();

    expect($result)->toBe($settingsData);
});
