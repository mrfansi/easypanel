<?php

declare(strict_types=1);

use Illuminate\Http\Client\Factory as HttpFactory;
use Illuminate\Http\Client\PendingRequest;
use Illuminate\Http\Client\Response;
use Mrfansi\Easypanel\Exceptions\EasypanelApiException;
use Mrfansi\Easypanel\Exceptions\EasypanelAuthenticationException;
use Mrfansi\Easypanel\Http\HttpClient;

beforeEach(function () {
    $this->httpFactory = Mockery::mock(HttpFactory::class);
    $this->pendingRequest = Mockery::mock(PendingRequest::class);
    $this->response = Mockery::mock(Response::class);
    $this->httpClient = new HttpClient($this->httpFactory);
});

afterEach(function () {
    Mockery::close();
});

it('can set base url', function () {
    $result = $this->httpClient->setBaseUrl('https://example.com');
    expect($result)->toBe($this->httpClient);
});

it('can set auth token', function () {
    $result = $this->httpClient->setAuthToken('test-token');
    expect($result)->toBe($this->httpClient);
});

it('can set timeout', function () {
    $result = $this->httpClient->setTimeout(60);
    expect($result)->toBe($this->httpClient);
});

it('can make GET request', function () {
    $expectedData = ['result' => 'success'];

    $this->httpFactory->shouldReceive('baseUrl')->andReturn($this->pendingRequest);
    $this->pendingRequest->shouldReceive('timeout')->andReturn($this->pendingRequest);
    $this->pendingRequest->shouldReceive('accept')->andReturn($this->pendingRequest);
    $this->pendingRequest->shouldReceive('withToken')->andReturn($this->pendingRequest);
    $this->pendingRequest->shouldReceive('get')->andReturn($this->response);
    $this->response->shouldReceive('status')->andReturn(200);
    $this->response->shouldReceive('json')->andReturn($expectedData);

    $result = $this->httpClient->get('/test-endpoint', ['param' => 'value']);

    expect($result)->toBe($expectedData);
});

it('throws authentication exception on 401', function () {
    $this->httpFactory->shouldReceive('baseUrl')->andReturn($this->pendingRequest);
    $this->pendingRequest->shouldReceive('timeout')->andReturn($this->pendingRequest);
    $this->pendingRequest->shouldReceive('accept')->andReturn($this->pendingRequest);
    $this->pendingRequest->shouldReceive('withToken')->andReturn($this->pendingRequest);
    $this->pendingRequest->shouldReceive('get')->andReturn($this->response);
    $this->response->shouldReceive('status')->andReturn(401);
    $this->response->shouldReceive('json')->andReturn(['message' => 'Unauthorized']);

    $this->httpClient->get('/test-endpoint');
})->throws(EasypanelAuthenticationException::class);

it('throws api exception on other errors', function () {
    $this->httpFactory->shouldReceive('baseUrl')->andReturn($this->pendingRequest);
    $this->pendingRequest->shouldReceive('timeout')->andReturn($this->pendingRequest);
    $this->pendingRequest->shouldReceive('accept')->andReturn($this->pendingRequest);
    $this->pendingRequest->shouldReceive('withToken')->andReturn($this->pendingRequest);
    $this->pendingRequest->shouldReceive('get')->andReturn($this->response);
    $this->response->shouldReceive('status')->andReturn(500);
    $this->response->shouldReceive('json')->andReturn(['message' => 'Internal Server Error']);

    $this->httpClient->get('/test-endpoint');
})->throws(EasypanelApiException::class);
