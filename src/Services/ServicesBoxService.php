<?php

declare(strict_types=1);

namespace Mrfansi\Easypanel\Services;

final class ServicesBoxService extends AbstractService
{
    /**
     * Inspect a box service
     */
    public function inspectService(string $projectName, string $serviceName): array
    {
        return $this->makeRequest('services.box.inspectService', [
            'projectName' => $projectName,
            'serviceName' => $serviceName,
        ]);
    }

    /**
     * List available presets for box services
     */
    public function listPresets(): array
    {
        return $this->makeRequest('services.box.listPresets');
    }

    /**
     * Create a new box service
     */
    public function createService(array $serviceData): array
    {
        return $this->makePostRequest('services.box.createService', $serviceData);
    }

    /**
     * Initialize service repository
     */
    public function initService(
        string $projectName,
        string $serviceName,
        ?array $git = null,
        bool $private = true
    ): array {
        $data = [
            'projectName' => $projectName,
            'serviceName' => $serviceName,
            'private' => $private,
        ];

        if ($git !== null) {
            $data['git'] = $git;
        }

        return $this->makePostRequest('services.box.initService', $data);
    }

    /**
     * Update service processes
     */
    public function updateProcesses(string $projectName, string $serviceName, array $processes = []): array
    {
        return $this->makePostRequest('services.box.updateProcesses', [
            'projectName' => $projectName,
            'serviceName' => $serviceName,
            'processes' => $processes,
        ]);
    }

    /**
     * Run a script on the service
     */
    public function runScript(
        string $projectName,
        string $serviceName,
        string $name,
        string $content
    ): array {
        return $this->makePostRequest('services.box.runScript', [
            'projectName' => $projectName,
            'serviceName' => $serviceName,
            'name' => $name,
            'content' => $content,
        ]);
    }

    /**
     * Update service scripts
     */
    public function updateScripts(string $projectName, string $serviceName, array $scripts = []): array
    {
        return $this->makePostRequest('services.box.updateScripts', [
            'projectName' => $projectName,
            'serviceName' => $serviceName,
            'scripts' => $scripts,
        ]);
    }

    /**
     * Destroy a box service
     */
    public function destroyService(string $projectName, string $serviceName): array
    {
        return $this->makePostRequest('services.box.destroyService', [
            'projectName' => $projectName,
            'serviceName' => $serviceName,
        ]);
    }

    /**
     * Clone a Git repository to the service
     */
    public function gitClone(
        string $projectName,
        string $serviceName,
        string $url,
        string $branch,
        bool $private = true
    ): array {
        return $this->makePostRequest('services.box.gitClone', [
            'projectName' => $projectName,
            'serviceName' => $serviceName,
            'url' => $url,
            'branch' => $branch,
            'private' => $private,
        ]);
    }

    /**
     * Update Git configuration for the service
     */
    public function updateGitConfig(
        string $projectName,
        string $serviceName,
        string $name,
        string $email
    ): array {
        return $this->makePostRequest('services.box.updateGitConfig', [
            'projectName' => $projectName,
            'serviceName' => $serviceName,
            'name' => $name,
            'email' => $email,
        ]);
    }

    /**
     * Refresh deployment token for the service
     */
    public function refreshDeployToken(string $serviceName, string $projectName): array
    {
        return $this->makePostRequest('services.box.refreshDeployToken', [
            'serviceName' => $serviceName,
            'projectName' => $projectName,
        ]);
    }

    /**
     * Rebuild Docker image for the service
     */
    public function rebuildDockerImage(string $projectName, string $serviceName): array
    {
        return $this->makePostRequest('services.box.rebuildDockerImage', [
            'projectName' => $projectName,
            'serviceName' => $serviceName,
        ]);
    }

    /**
     * Update deployment script for the service
     */
    public function updateDeployScript(string $projectName, string $serviceName, array $deployment = []): array
    {
        return $this->makePostRequest('services.box.updateDeployScript', [
            'projectName' => $projectName,
            'serviceName' => $serviceName,
            'deployment' => $deployment,
        ]);
    }

    /**
     * Update redirects for the service
     */
    public function updateRedirects(string $projectName, string $serviceName, array $redirects = []): array
    {
        return $this->makePostRequest('services.box.updateRedirects', [
            'projectName' => $projectName,
            'serviceName' => $serviceName,
            'redirects' => $redirects,
        ]);
    }

    /**
     * Update basic authentication for the service
     */
    public function updateBasicAuth(string $projectName, string $serviceName, array $basicAuth = []): array
    {
        return $this->makePostRequest('services.box.updateBasicAuth', [
            'projectName' => $projectName,
            'serviceName' => $serviceName,
            'basicAuth' => $basicAuth,
        ]);
    }

    /**
     * Update service modules
     */
    public function updateModules(string $projectName, string $serviceName, array $modules = []): array
    {
        return $this->makePostRequest('services.box.updateModules', [
            'projectName' => $projectName,
            'serviceName' => $serviceName,
            'modules' => $modules,
        ]);
    }

    /**
     * Update IDE configuration
     */
    public function updateIde(string $projectName, string $serviceName, ?array $ide = null): array
    {
        $data = [
            'projectName' => $projectName,
            'serviceName' => $serviceName,
        ];

        if ($ide !== null) {
            $data['ide'] = $ide;
        }

        return $this->makePostRequest('services.box.updateIde', $data);
    }

    /**
     * Update advanced configuration
     */
    public function updateAdvanced(string $projectName, string $serviceName, ?array $advanced = null): array
    {
        $data = [
            'projectName' => $projectName,
            'serviceName' => $serviceName,
        ];

        if ($advanced !== null) {
            $data['advanced'] = $advanced;
        }

        return $this->makePostRequest('services.box.updateAdvanced', $data);
    }

    /**
     * Update PHP configuration
     */
    public function updatePhp(string $projectName, string $serviceName, ?array $php = null): array
    {
        $data = [
            'projectName' => $projectName,
            'serviceName' => $serviceName,
        ];

        if ($php !== null) {
            $data['php'] = $php;
        }

        return $this->makePostRequest('services.box.updatePhp', $data);
    }

    /**
     * Update Node.js configuration
     */
    public function updateNodejs(string $projectName, string $serviceName, ?array $nodejs = null): array
    {
        $data = [
            'projectName' => $projectName,
            'serviceName' => $serviceName,
        ];

        if ($nodejs !== null) {
            $data['nodejs'] = $nodejs;
        }

        return $this->makePostRequest('services.box.updateNodejs', $data);
    }

    /**
     * Update Nginx configuration
     */
    public function updateNginx(string $projectName, string $serviceName, ?array $nginx = null): array
    {
        $data = [
            'projectName' => $projectName,
            'serviceName' => $serviceName,
        ];

        if ($nginx !== null) {
            $data['nginx'] = $nginx;
        }

        return $this->makePostRequest('services.box.updateNginx', $data);
    }

    /**
     * Update Python configuration
     */
    public function updatePython(string $projectName, string $serviceName, ?array $python = null): array
    {
        $data = [
            'projectName' => $projectName,
            'serviceName' => $serviceName,
        ];

        if ($python !== null) {
            $data['python'] = $python;
        }

        return $this->makePostRequest('services.box.updatePython', $data);
    }

    /**
     * Update Ruby configuration
     */
    public function updateRuby(string $projectName, string $serviceName, ?array $ruby = null): array
    {
        $data = [
            'projectName' => $projectName,
            'serviceName' => $serviceName,
        ];

        if ($ruby !== null) {
            $data['ruby'] = $ruby;
        }

        return $this->makePostRequest('services.box.updateRuby', $data);
    }

    /**
     * Update environment variables
     */
    public function updateEnv(string $projectName, string $serviceName, ?array $env = null): array
    {
        $data = [
            'projectName' => $projectName,
            'serviceName' => $serviceName,
        ];

        if ($env !== null) {
            $data['env'] = $env;
        }

        return $this->makePostRequest('services.box.updateEnv', $data);
    }

    /**
     * Run deployment script
     */
    public function runDeployScript(string $projectName, string $serviceName): array
    {
        return $this->makePostRequest('services.box.runDeployScript', [
            'projectName' => $projectName,
            'serviceName' => $serviceName,
        ]);
    }

    /**
     * Load a preset for the service
     */
    public function loadPreset(string $projectName, string $serviceName, string $presetKey): array
    {
        return $this->makePostRequest('services.box.loadPreset', [
            'projectName' => $projectName,
            'serviceName' => $serviceName,
            'presetKey' => $presetKey,
        ]);
    }

    /**
     * Start the service
     */
    public function startService(string $projectName, string $serviceName): array
    {
        return $this->makePostRequest('services.box.startService', [
            'projectName' => $projectName,
            'serviceName' => $serviceName,
        ]);
    }

    /**
     * Stop the service
     */
    public function stopService(string $projectName, string $serviceName): array
    {
        return $this->makePostRequest('services.box.stopService', [
            'projectName' => $projectName,
            'serviceName' => $serviceName,
        ]);
    }

    /**
     * Restart the service
     */
    public function restartService(string $projectName, string $serviceName): array
    {
        return $this->makePostRequest('services.box.restartService', [
            'projectName' => $projectName,
            'serviceName' => $serviceName,
        ]);
    }

    /**
     * Update resource limits
     */
    public function updateResources(string $projectName, string $serviceName, array $resources): array
    {
        return $this->makePostRequest('services.box.updateResources', [
            'projectName' => $projectName,
            'serviceName' => $serviceName,
            'resources' => $resources,
        ]);
    }
}
