<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Http;
use Mrfansi\Easypanel\Exceptions\EasypanelApiException;
use Mrfansi\Easypanel\Exceptions\EasypanelAuthenticationException;
use Mrfansi\Easypanel\Http\HttpClient;

beforeEach(function () {
    $this->httpClient = new HttpClient('https://example.com', 'test-token', 30);
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

    Http::fake([
        'example.com/*' => Http::response($expectedData, 200)
    ]);

    $result = $this->httpClient->get('/test-endpoint', ['param' => 'value']);

    expect($result)->toBe($expectedData);
    
    Http::assertSent(function ($request) {
        return str_contains($request->url(), 'https://example.com/test-endpoint') &&
               $request->method() === 'GET' &&
               in_array('Bearer test-token', $request->header('Authorization')) &&
               in_array('application/json', $request->header('Accept'));
    });
});

it('throws authentication exception on 401', function () {
    Http::fake([
        'example.com/*' => Http::response(['message' => 'Unauthorized'], 401)
    ]);

    $this->httpClient->get('/test-endpoint');
})->throws(EasypanelAuthenticationException::class);

it('throws api exception on other errors', function () {
    Http::fake([
        'example.com/*' => Http::response(['message' => 'Internal Server Error'], 500)
    ]);

    $this->httpClient->get('/test-endpoint');
})->throws(EasypanelApiException::class);
