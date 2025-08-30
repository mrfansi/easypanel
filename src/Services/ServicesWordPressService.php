<?php

declare(strict_types=1);

namespace Mrfansi\Easypanel\Services;

final class ServicesWordPressService extends AbstractService
{
    /**
     * Inspect a WordPress service
     */
    public function inspectService(string $projectName, string $serviceName): array
    {
        return $this->makeRequest('services.wordpress.inspectService', [
            'projectName' => $projectName,
            'serviceName' => $serviceName,
        ]);
    }

    /**
     * Get WordPress users
     */
    public function getUsers(string $projectName, string $serviceName): array
    {
        return $this->makeRequest('services.wordpress.getUsers', [
            'projectName' => $projectName,
            'serviceName' => $serviceName,
        ]);
    }

    /**
     * Get WordPress user roles
     */
    public function getRoles(string $projectName, string $serviceName): array
    {
        return $this->makeRequest('services.wordpress.getRoles', [
            'projectName' => $projectName,
            'serviceName' => $serviceName,
        ]);
    }

    /**
     * Get maintenance mode status
     */
    public function getMaintenanceMode(string $projectName, string $serviceName): array
    {
        return $this->makeRequest('services.wordpress.getMaintenanceMode', [
            'projectName' => $projectName,
            'serviceName' => $serviceName,
        ]);
    }

    /**
     * Get WordPress themes
     */
    public function getThemes(string $projectName, string $serviceName): array
    {
        return $this->makeRequest('services.wordpress.getThemes', [
            'projectName' => $projectName,
            'serviceName' => $serviceName,
        ]);
    }

    /**
     * Search for WordPress themes
     */
    public function searchTheme(string $projectName, string $serviceName, string $search): array
    {
        return $this->makeRequest('services.wordpress.searchTheme', [
            'projectName' => $projectName,
            'serviceName' => $serviceName,
            'search' => $search,
        ]);
    }

    /**
     * Get WordPress plugins
     */
    public function getPlugins(string $projectName, string $serviceName): array
    {
        return $this->makeRequest('services.wordpress.getPlugins', [
            'projectName' => $projectName,
            'serviceName' => $serviceName,
        ]);
    }

    /**
     * Search for WordPress plugins
     */
    public function searchPlugin(string $projectName, string $serviceName, string $search): array
    {
        return $this->makeRequest('services.wordpress.searchPlugin', [
            'projectName' => $projectName,
            'serviceName' => $serviceName,
            'search' => $search,
        ]);
    }

    /**
     * Get WordPress options
     */
    public function getOptions(string $projectName, string $serviceName): array
    {
        return $this->makeRequest('services.wordpress.getOptions', [
            'projectName' => $projectName,
            'serviceName' => $serviceName,
        ]);
    }

    /**
     * Get database services for WordPress
     */
    public function getDatabaseServices(string $projectName, ?string $serviceName = null): array
    {
        $params = ['projectName' => $projectName];
        if ($serviceName !== null) {
            $params['serviceName'] = $serviceName;
        }

        return $this->makeRequest('services.wordpress.getDatabaseServices', $params);
    }

    /**
     * Get WordPress configuration
     */
    public function getWpConfig(string $projectName, string $serviceName): array
    {
        return $this->makeRequest('services.wordpress.getWpConfig', [
            'projectName' => $projectName,
            'serviceName' => $serviceName,
        ]);
    }

    /**
     * Get WordPress profile information
     */
    public function getProfile(string $projectName, string $serviceName): array
    {
        return $this->makeRequest('services.wordpress.getProfile', [
            'projectName' => $projectName,
            'serviceName' => $serviceName,
        ]);
    }

    /**
     * Create a new WordPress service
     */
    public function createService(array $serviceData): array
    {
        return $this->makePostRequest('services.wordpress.createService', $serviceData);
    }

    /**
     * Initialize WordPress service
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

        return $this->makePostRequest('services.wordpress.initService', $data);
    }

    /**
     * Run a script on WordPress service
     */
    public function runScript(
        string $projectName,
        string $serviceName,
        string $name,
        string $content
    ): array {
        return $this->makePostRequest('services.wordpress.runScript', [
            'projectName' => $projectName,
            'serviceName' => $serviceName,
            'name' => $name,
            'content' => $content,
        ]);
    }

    /**
     * Update WordPress service scripts
     */
    public function updateScripts(string $projectName, string $serviceName, array $scripts = []): array
    {
        return $this->makePostRequest('services.wordpress.updateScripts', [
            'projectName' => $projectName,
            'serviceName' => $serviceName,
            'scripts' => $scripts,
        ]);
    }

    /**
     * Destroy WordPress service
     */
    public function destroyService(string $projectName, string $serviceName): array
    {
        return $this->makePostRequest('services.wordpress.destroyService', [
            'projectName' => $projectName,
            'serviceName' => $serviceName,
        ]);
    }

    /**
     * Clone Git repository to WordPress service
     */
    public function gitClone(
        string $projectName,
        string $serviceName,
        string $url,
        string $branch,
        bool $private = true
    ): array {
        return $this->makePostRequest('services.wordpress.gitClone', [
            'projectName' => $projectName,
            'serviceName' => $serviceName,
            'url' => $url,
            'branch' => $branch,
            'private' => $private,
        ]);
    }

    /**
     * Update Git configuration for WordPress service
     */
    public function updateGitConfig(
        string $projectName,
        string $serviceName,
        string $name,
        string $email
    ): array {
        return $this->makePostRequest('services.wordpress.updateGitConfig', [
            'projectName' => $projectName,
            'serviceName' => $serviceName,
            'name' => $name,
            'email' => $email,
        ]);
    }

    /**
     * Rebuild Docker image for WordPress service
     */
    public function rebuildDockerImage(string $projectName, string $serviceName): array
    {
        return $this->makePostRequest('services.wordpress.rebuildDockerImage', [
            'projectName' => $projectName,
            'serviceName' => $serviceName,
        ]);
    }

    /**
     * Update redirects for WordPress service
     */
    public function updateRedirects(string $projectName, string $serviceName, array $redirects = []): array
    {
        return $this->makePostRequest('services.wordpress.updateRedirects', [
            'projectName' => $projectName,
            'serviceName' => $serviceName,
            'redirects' => $redirects,
        ]);
    }

    /**
     * Update basic authentication for WordPress service
     */
    public function updateBasicAuth(string $projectName, string $serviceName, array $basicAuth = []): array
    {
        return $this->makePostRequest('services.wordpress.updateBasicAuth', [
            'projectName' => $projectName,
            'serviceName' => $serviceName,
            'basicAuth' => $basicAuth,
        ]);
    }

    /**
     * Update IDE configuration for WordPress service
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

        return $this->makePostRequest('services.wordpress.updateIde', $data);
    }

    /**
     * Update PHP configuration for WordPress service
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

        return $this->makePostRequest('services.wordpress.updatePhp', $data);
    }

    /**
     * Update Nginx configuration for WordPress service
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

        return $this->makePostRequest('services.wordpress.updateNginx', $data);
    }

    /**
     * Update environment variables for WordPress service
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

        return $this->makePostRequest('services.wordpress.updateEnv', $data);
    }

    /**
     * Start WordPress service
     */
    public function startService(string $projectName, string $serviceName): array
    {
        return $this->makePostRequest('services.wordpress.startService', [
            'projectName' => $projectName,
            'serviceName' => $serviceName,
        ]);
    }

    /**
     * Stop WordPress service
     */
    public function stopService(string $projectName, string $serviceName): array
    {
        return $this->makePostRequest('services.wordpress.stopService', [
            'projectName' => $projectName,
            'serviceName' => $serviceName,
        ]);
    }

    /**
     * Restart WordPress service
     */
    public function restartService(string $projectName, string $serviceName): array
    {
        return $this->makePostRequest('services.wordpress.restartService', [
            'projectName' => $projectName,
            'serviceName' => $serviceName,
        ]);
    }

    /**
     * Update resource limits for WordPress service
     */
    public function updateResources(string $projectName, string $serviceName, array $resources): array
    {
        return $this->makePostRequest('services.wordpress.updateResources', [
            'projectName' => $projectName,
            'serviceName' => $serviceName,
            'resources' => $resources,
        ]);
    }

    // WordPress-specific methods

    /**
     * Create WordPress user
     */
    public function createUser(
        string $projectName,
        string $serviceName,
        string $userLogin,
        string $userEmail,
        string $userPass,
        string $role,
        ?string $firstName = null,
        ?string $lastName = null
    ): array {
        $data = [
            'projectName' => $projectName,
            'serviceName' => $serviceName,
            'user_login' => $userLogin,
            'user_email' => $userEmail,
            'user_pass' => $userPass,
            'role' => $role,
        ];

        if ($firstName !== null) {
            $data['first_name'] = $firstName;
        }
        if ($lastName !== null) {
            $data['last_name'] = $lastName;
        }

        return $this->makePostRequest('services.wordpress.createUser', $data);
    }

    /**
     * Update WordPress user
     */
    public function updateUser(
        string $projectName,
        string $serviceName,
        int $id,
        array $userData
    ): array {
        return $this->makePostRequest('services.wordpress.updateUser', array_merge([
            'projectName' => $projectName,
            'serviceName' => $serviceName,
            'ID' => $id,
        ], $userData));
    }

    /**
     * Delete WordPress user
     */
    public function deleteUser(string $projectName, string $serviceName, int $id, ?int $reassign = null): array
    {
        $data = [
            'projectName' => $projectName,
            'serviceName' => $serviceName,
            'ID' => $id,
        ];

        if ($reassign !== null) {
            $data['reassign'] = $reassign;
        }

        return $this->makePostRequest('services.wordpress.deleteUser', $data);
    }

    /**
     * Create WordPress role
     */
    public function createRole(
        string $projectName,
        string $serviceName,
        string $role,
        string $displayName,
        array $capabilities = []
    ): array {
        return $this->makePostRequest('services.wordpress.createRole', [
            'projectName' => $projectName,
            'serviceName' => $serviceName,
            'role' => $role,
            'display_name' => $displayName,
            'capabilities' => $capabilities,
        ]);
    }

    /**
     * Delete WordPress role
     */
    public function deleteRole(string $projectName, string $serviceName, string $role): array
    {
        return $this->makePostRequest('services.wordpress.deleteRole', [
            'projectName' => $projectName,
            'serviceName' => $serviceName,
            'role' => $role,
        ]);
    }

    /**
     * Update WordPress maintenance mode
     */
    public function updateMaintenanceMode(string $projectName, string $serviceName, bool $active): array
    {
        return $this->makePostRequest('services.wordpress.updateMaintenanceMode', [
            'projectName' => $projectName,
            'serviceName' => $serviceName,
            'active' => $active,
        ]);
    }

    /**
     * Activate WordPress theme
     */
    public function activateTheme(string $projectName, string $serviceName, string $stylesheet): array
    {
        return $this->makePostRequest('services.wordpress.activateTheme', [
            'projectName' => $projectName,
            'serviceName' => $serviceName,
            'stylesheet' => $stylesheet,
        ]);
    }

    /**
     * Install WordPress theme
     */
    public function installTheme(string $projectName, string $serviceName, string $slug): array
    {
        return $this->makePostRequest('services.wordpress.installTheme', [
            'projectName' => $projectName,
            'serviceName' => $serviceName,
            'slug' => $slug,
        ]);
    }

    /**
     * Activate WordPress plugin
     */
    public function activatePlugin(string $projectName, string $serviceName, string $plugin): array
    {
        return $this->makePostRequest('services.wordpress.activatePlugin', [
            'projectName' => $projectName,
            'serviceName' => $serviceName,
            'plugin' => $plugin,
        ]);
    }

    /**
     * Deactivate WordPress plugin
     */
    public function deactivatePlugin(string $projectName, string $serviceName, string $plugin): array
    {
        return $this->makePostRequest('services.wordpress.deactivatePlugin', [
            'projectName' => $projectName,
            'serviceName' => $serviceName,
            'plugin' => $plugin,
        ]);
    }

    /**
     * Install WordPress plugin
     */
    public function installPlugin(string $projectName, string $serviceName, string $slug): array
    {
        return $this->makePostRequest('services.wordpress.installPlugin', [
            'projectName' => $projectName,
            'serviceName' => $serviceName,
            'slug' => $slug,
        ]);
    }

    /**
     * Create WordPress option
     */
    public function createOption(
        string $projectName,
        string $serviceName,
        string $optionName,
        string $optionValue,
        string $autoload = 'yes'
    ): array {
        return $this->makePostRequest('services.wordpress.createOption', [
            'projectName' => $projectName,
            'serviceName' => $serviceName,
            'option_name' => $optionName,
            'option_value' => $optionValue,
            'autoload' => $autoload,
        ]);
    }

    /**
     * Update WordPress option
     */
    public function updateOption(
        string $projectName,
        string $serviceName,
        string $optionName,
        string $optionValue,
        ?string $autoload = null
    ): array {
        $data = [
            'projectName' => $projectName,
            'serviceName' => $serviceName,
            'option_name' => $optionName,
            'option_value' => $optionValue,
        ];

        if ($autoload !== null) {
            $data['autoload'] = $autoload;
        }

        return $this->makePostRequest('services.wordpress.updateOption', $data);
    }

    /**
     * Delete WordPress option
     */
    public function deleteOption(string $projectName, string $serviceName, string $optionName): array
    {
        return $this->makePostRequest('services.wordpress.deleteOption', [
            'projectName' => $projectName,
            'serviceName' => $serviceName,
            'option_name' => $optionName,
        ]);
    }

    /**
     * Regenerate WordPress media thumbnails
     */
    public function mediaRegenerate(string $projectName, string $serviceName): array
    {
        return $this->makePostRequest('services.wordpress.mediaRegenerate', [
            'projectName' => $projectName,
            'serviceName' => $serviceName,
        ]);
    }

    /**
     * Flush WordPress cache
     */
    public function flushCache(string $projectName, string $serviceName): array
    {
        return $this->makePostRequest('services.wordpress.flushCache', [
            'projectName' => $projectName,
            'serviceName' => $serviceName,
        ]);
    }

    /**
     * Delete WordPress transients
     */
    public function deleteTransient(string $projectName, string $serviceName): array
    {
        return $this->makePostRequest('services.wordpress.deleteTransient', [
            'projectName' => $projectName,
            'serviceName' => $serviceName,
        ]);
    }

    /**
     * Optimize WordPress database
     */
    public function dbOptimize(string $projectName, string $serviceName): array
    {
        return $this->makePostRequest('services.wordpress.dbOptimize', [
            'projectName' => $projectName,
            'serviceName' => $serviceName,
        ]);
    }

    /**
     * Search and replace in WordPress database
     */
    public function searchReplace(string $projectName, string $serviceName, string $search, string $replace): array
    {
        return $this->makePostRequest('services.wordpress.searchReplace', [
            'projectName' => $projectName,
            'serviceName' => $serviceName,
            'search' => $search,
            'replace' => $replace,
        ]);
    }

    /**
     * Search and replace dry run in WordPress database
     */
    public function searchReplaceDryRun(string $projectName, string $serviceName, string $search, string $replace): array
    {
        return $this->makePostRequest('services.wordpress.searchReplaceDryRun', [
            'projectName' => $projectName,
            'serviceName' => $serviceName,
            'search' => $search,
            'replace' => $replace,
        ]);
    }

    /**
     * Update WordPress core
     */
    public function updateWpCore(string $projectName, string $serviceName): array
    {
        return $this->makePostRequest('services.wordpress.updateWpCore', [
            'projectName' => $projectName,
            'serviceName' => $serviceName,
        ]);
    }

    /**
     * Update WordPress configuration
     */
    public function updateWpConfig(string $projectName, string $serviceName, string $value): array
    {
        return $this->makePostRequest('services.wordpress.updateWpConfig', [
            'projectName' => $projectName,
            'serviceName' => $serviceName,
            'value' => $value,
        ]);
    }
}
