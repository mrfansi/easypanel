<?php

declare(strict_types=1);

use Mrfansi\Easypanel\Easypanel;
use Mrfansi\Easypanel\Http\HttpClient;
use Mrfansi\Easypanel\Services\AuthService;
use Mrfansi\Easypanel\Services\ProjectService;
use Mrfansi\Easypanel\Services\StorageProvidersS3Service;

beforeEach(function () {
    $this->httpClient = new HttpClient('https://example.com', 'test-token', 30);
    $this->easypanel = new Easypanel($this->httpClient);
});

it('can instantiate core services via factory pattern', function () {
    $auth = $this->easypanel->auth();
    $projects = $this->easypanel->projects();
    $settings = $this->easypanel->settings();

    expect($auth)->toBeInstanceOf(AuthService::class);
    expect($projects)->toBeInstanceOf(ProjectService::class);
    expect($settings)->toBeInstanceOf(\Mrfansi\Easypanel\Services\SettingsService::class);
});

it('can instantiate storage services via factory pattern', function () {
    $s3 = $this->easypanel->storageProvidersS3();
    $local = $this->easypanel->storageProvidersLocal();

    expect($s3)->toBeInstanceOf(StorageProvidersS3Service::class);
    expect($local)->toBeInstanceOf(\Mrfansi\Easypanel\Services\StorageProvidersLocalService::class);
});

it('returns same instance on multiple calls (singleton behavior)', function () {
    $auth1 = $this->easypanel->auth();
    $auth2 = $this->easypanel->auth();

    expect($auth1)->toBe($auth2);
});

it('throws exception for non-existent service', function () {
    $this->easypanel->nonExistentService();
})->throws(BadMethodCallException::class, "Service 'nonExistentService' does not exist.");

it('can access all documented services without errors', function () {
    // Core Services
    expect($this->easypanel->auth())->toBeInstanceOf(\Mrfansi\Easypanel\Contracts\ServiceInterface::class);
    expect($this->easypanel->projects())->toBeInstanceOf(\Mrfansi\Easypanel\Contracts\ServiceInterface::class);
    expect($this->easypanel->monitor())->toBeInstanceOf(\Mrfansi\Easypanel\Contracts\ServiceInterface::class);
    
    // Database Services  
    expect($this->easypanel->servicesMySql())->toBeInstanceOf(\Mrfansi\Easypanel\Contracts\ServiceInterface::class);
    expect($this->easypanel->servicesPostgres())->toBeInstanceOf(\Mrfansi\Easypanel\Contracts\ServiceInterface::class);
    expect($this->easypanel->servicesRedis())->toBeInstanceOf(\Mrfansi\Easypanel\Contracts\ServiceInterface::class);
    
    // Infrastructure Services
    expect($this->easypanel->cluster())->toBeInstanceOf(\Mrfansi\Easypanel\Contracts\ServiceInterface::class);
    expect($this->easypanel->traefik())->toBeInstanceOf(\Mrfansi\Easypanel\Contracts\ServiceInterface::class);
    expect($this->easypanel->dockerBuilders())->toBeInstanceOf(\Mrfansi\Easypanel\Contracts\ServiceInterface::class);
    
    // Storage Services
    expect($this->easypanel->storageProvidersS3())->toBeInstanceOf(\Mrfansi\Easypanel\Contracts\ServiceInterface::class);
    expect($this->easypanel->storageProvidersDropbox())->toBeInstanceOf(\Mrfansi\Easypanel\Contracts\ServiceInterface::class);
    expect($this->easypanel->storageProvidersLocal())->toBeInstanceOf(\Mrfansi\Easypanel\Contracts\ServiceInterface::class);
});