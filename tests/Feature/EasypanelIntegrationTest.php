<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Http;
use Mrfansi\Easypanel\Easypanel;
use Mrfansi\Easypanel\Http\HttpClient;

beforeEach(function () {
    $httpClient = new HttpClient('https://example.com', 'test-token', 30);
    $this->easypanel = new Easypanel($httpClient);
});

it('can authenticate and get user info', function () {
    $expectedData = ['user' => ['id' => 1, 'email' => 'admin@example.com']];

    Http::fake([
        'example.com/*' => Http::response($expectedData, 200)
    ]);

    $result = $this->easypanel->auth()->getUser();

    expect($result)->toBe($expectedData);
});

it('can manage projects', function () {
    $projectsData = ['projects' => [['name' => 'test-project']]];

    Http::fake([
        'example.com/*' => Http::response($projectsData, 200)
    ]);

    $result = $this->easypanel->projects()->listProjects();

    expect($result)->toBe($projectsData);
});

it('can monitor services', function () {
    $statsData = ['cpu' => 45.2, 'memory' => 1024];

    Http::fake([
        'example.com/*' => Http::response($statsData, 200)
    ]);

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

    Http::fake([
        'example.com/*' => Http::response($settingsData, 200)
    ]);

    $result = $this->easypanel->settings()->getServerIp();

    expect($result)->toBe($settingsData);
});

it('can fetch demo mode from settings', function () {
    $settingsData = ['enabled' => true];

    Http::fake([
        'example.com/*' => Http::response($settingsData, 200)
    ]);

    $result = $this->easypanel->settings()->getDemoMode();

    expect($result)->toBe($settingsData);
});
