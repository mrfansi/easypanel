<?php

declare(strict_types=1);

use Mrfansi\Easypanel\Contracts\HttpClientInterface;
use Mrfansi\Easypanel\Exceptions\EasypanelValidationException;
use Mrfansi\Easypanel\Services\ProjectService;

beforeEach(function () {
    $this->httpClient = Mockery::mock(HttpClientInterface::class);
    $this->service = new ProjectService($this->httpClient);
});

afterEach(function () {
    Mockery::close();
});

it('can list projects', function () {
    $expectedData = ['projects' => []];
    $this->httpClient
        ->shouldReceive('get')
        ->with('/api/trpc/projects.listProjects', [])
        ->andReturn($expectedData);

    $result = $this->service->listProjects();
    expect($result)->toBe($expectedData);
});

it('can inspect project with valid name', function () {
    $projectName = 'valid-project-name';
    $expectedData = ['project' => ['name' => $projectName]];

    $this->httpClient
        ->shouldReceive('get')
        ->with('/api/trpc/projects.inspectProject', ['projectName' => $projectName])
        ->andReturn($expectedData);

    $result = $this->service->inspectProject($projectName);
    expect($result)->toBe($expectedData);
});

it('throws validation exception for invalid project name', function () {
    $this->service->inspectProject('INVALID_NAME');
})->throws(EasypanelValidationException::class, 'Project name must contain only lowercase letters, numbers, hyphens, and underscores');

it('can get docker containers', function () {
    $expectedData = ['containers' => []];
    $this->httpClient
        ->shouldReceive('get')
        ->with('/api/trpc/projects.getDockerContainers', ['service' => 'test-service'])
        ->andReturn($expectedData);

    $result = $this->service->getDockerContainers('test-service');
    expect($result)->toBe($expectedData);
});

it('can create project', function () {
    $projectData = ['name' => 'test-project', 'description' => 'Test project'];
    $expectedData = ['success' => true];

    $this->httpClient
        ->shouldReceive('post')
        ->with('/api/trpc/projects.createProject', $projectData)
        ->andReturn($expectedData);

    $result = $this->service->createProject($projectData);
    expect($result)->toBe($expectedData);
});

it('can update project', function () {
    $projectName = 'test-project';
    $projectData = ['description' => 'Updated description'];
    $expectedData = ['success' => true];

    $this->httpClient
        ->shouldReceive('patch')
        ->with('/api/trpc/projects.updateProject', array_merge(['projectName' => $projectName], $projectData))
        ->andReturn($expectedData);

    $result = $this->service->updateProject($projectName, $projectData);
    expect($result)->toBe($expectedData);
});

it('can delete project', function () {
    $projectName = 'test-project';
    $expectedData = ['success' => true];

    $this->httpClient
        ->shouldReceive('delete')
        ->with("/api/trpc/projects.deleteProject?projectName={$projectName}", [])
        ->andReturn($expectedData);

    $result = $this->service->deleteProject($projectName);
    expect($result)->toBe($expectedData);
});
