<?php

declare(strict_types=1);

namespace Mrfansi\Easypanel\Services;

use Mrfansi\Easypanel\Validation\RequestValidator;

final class ProjectService extends AbstractService
{
    public function listProjects(): array
    {
        return $this->makeRequest('projects.listProjects');
    }

    public function listProjectsAndServices(): array
    {
        return $this->makeRequest('projects.listProjectsAndServices');
    }

    public function inspectProject(string $projectName): array
    {
        RequestValidator::validateProjectName($projectName);

        return $this->makeRequest('projects.inspectProject', [
            'projectName' => $projectName,
        ]);
    }

    public function getDockerContainers(string $service): array
    {
        return $this->makeRequest('projects.getDockerContainers', [
            'service' => $service,
        ]);
    }

    public function createProject(array $projectData): array
    {
        return $this->makePostRequest('projects.createProject', $projectData);
    }

    public function updateProject(string $projectName, array $projectData): array
    {
        return $this->makePatchRequest('projects.updateProject', array_merge([
            'projectName' => $projectName,
        ], $projectData));
    }

    public function deleteProject(string $projectName): array
    {
        return $this->makeDeleteRequest("projects.deleteProject?projectName={$projectName}");
    }
}
