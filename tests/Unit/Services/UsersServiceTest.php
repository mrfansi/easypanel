<?php

declare(strict_types=1);

use Mrfansi\Easypanel\Contracts\HttpClientInterface;
use Mrfansi\Easypanel\Exceptions\EasypanelValidationException;
use Mrfansi\Easypanel\Services\UsersService;

beforeEach(function () {
    $this->httpClient = Mockery::mock(HttpClientInterface::class);
    $this->service = new UsersService($this->httpClient);
});

afterEach(function () {
    Mockery::close();
});

it('can list users', function () {
    $expectedData = ['users' => []];
    $this->httpClient
        ->shouldReceive('get')
        ->with('/api/trpc/users.listUsers', [])
        ->andReturn($expectedData);

    $result = $this->service->listUsers();
    expect($result)->toBe($expectedData);
});

it('can generate api token', function () {
    $tokenName = 'test-token';
    $expectedData = ['token' => 'generated-token'];

    $this->httpClient
        ->shouldReceive('post')
        ->with('/api/trpc/users.generateApiToken', ['name' => $tokenName])
        ->andReturn($expectedData);

    $result = $this->service->generateApiToken($tokenName);
    expect($result)->toBe($expectedData);
});

it('throws validation exception for empty token name', function () {
    $this->service->generateApiToken('');
})->throws(EasypanelValidationException::class);

it('can revoke api token', function () {
    $tokenId = 'token-123';
    $expectedData = ['success' => true];

    $this->httpClient
        ->shouldReceive('delete')
        ->with('/api/trpc/users.revokeApiToken', ['tokenId' => $tokenId])
        ->andReturn($expectedData);

    $result = $this->service->revokeApiToken($tokenId);
    expect($result)->toBe($expectedData);
});

it('can create user', function () {
    $userData = ['email' => 'test@example.com', 'password' => 'password123'];
    $expectedData = ['user' => ['id' => 1]];

    $this->httpClient
        ->shouldReceive('post')
        ->with('/api/trpc/users.createUser', $userData)
        ->andReturn($expectedData);

    $result = $this->service->createUser($userData);
    expect($result)->toBe($expectedData);
});

it('throws validation exception for missing email in create user', function () {
    $this->service->createUser(['password' => 'password123']);
})->throws(EasypanelValidationException::class);

it('throws validation exception for missing password in create user', function () {
    $this->service->createUser(['email' => 'test@example.com']);
})->throws(EasypanelValidationException::class);

it('can update user', function () {
    $userId = 'user-123';
    $userData = ['name' => 'Updated Name'];
    $expectedData = ['success' => true];

    $this->httpClient
        ->shouldReceive('patch')
        ->with('/api/trpc/users.updateUser', array_merge(['userId' => $userId], $userData))
        ->andReturn($expectedData);

    $result = $this->service->updateUser($userId, $userData);
    expect($result)->toBe($expectedData);
});

it('can destroy user', function () {
    $userId = 'user-123';
    $expectedData = ['success' => true];

    $this->httpClient
        ->shouldReceive('delete')
        ->with('/api/trpc/users.destroyUser', ['userId' => $userId])
        ->andReturn($expectedData);

    $result = $this->service->destroyUser($userId);
    expect($result)->toBe($expectedData);
});
