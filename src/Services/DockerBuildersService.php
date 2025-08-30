<?php

declare(strict_types=1);

namespace Mrfansi\Easypanel\Services;

use Mrfansi\Easypanel\Exceptions\EasypanelValidationException;
use Mrfansi\Easypanel\Validation\RequestValidator;

/**
 * Docker Builders Service for Easypanel API
 *
 * Provides methods to manage Docker builders including listing,
 * creating, using, stopping, and removing Docker builder instances.
 */
final class DockerBuildersService extends AbstractService
{
    /**
     * List all Docker builders
     */
    public function listDockerBuilders(): array
    {
        return $this->makeRequest('dockerBuilders.listDockerBuilders');
    }

    /**
     * Create a new Docker builder
     *
     * @param  array  $builderData  Builder configuration data
     *
     * @throws EasypanelValidationException
     */
    public function createDockerBuilder(array $builderData): array
    {
        $this->validateDockerBuilderData($builderData);

        return $this->makePostRequest('dockerBuilders.createDockerBuilder', $builderData);
    }

    /**
     * Use/start a Docker builder
     *
     * @param  string  $builderName  Name of the builder to use
     *
     * @throws EasypanelValidationException
     */
    public function useDockerBuilder(string $builderName): array
    {
        RequestValidator::validateRequiredField($builderName, 'name');

        return $this->makePostRequest('dockerBuilders.useDockerBuilder', [
            'name' => $builderName,
        ]);
    }

    /**
     * Stop a Docker builder
     *
     * @param  string  $builderName  Name of the builder to stop
     *
     * @throws EasypanelValidationException
     */
    public function stopDockerBuilder(string $builderName): array
    {
        RequestValidator::validateRequiredField($builderName, 'name');

        return $this->makePostRequest('dockerBuilders.stopDockerBuilder', [
            'name' => $builderName,
        ]);
    }

    /**
     * Remove a Docker builder
     *
     * @param  string  $builderName  Name of the builder to remove
     *
     * @throws EasypanelValidationException
     */
    public function removeDockerBuilder(string $builderName): array
    {
        RequestValidator::validateRequiredField($builderName, 'name');

        return $this->makePostRequest('dockerBuilders.removeDockerBuilder', [
            'name' => $builderName,
        ]);
    }

    /**
     * Validate Docker builder data
     *
     * @param  array  $data  Builder data to validate
     *
     * @throws EasypanelValidationException
     */
    private function validateDockerBuilderData(array $data): void
    {
        RequestValidator::validateRequiredField($data['name'] ?? null, 'name');

        // Validate memory if provided
        if (isset($data['memory'])) {
            if (! is_numeric($data['memory']) || $data['memory'] <= 0) {
                throw new EasypanelValidationException('Memory must be a positive number (in MB)');
            }
        }

        // Validate memory swap if provided
        if (isset($data['memorySwap'])) {
            if (! is_numeric($data['memorySwap']) || $data['memorySwap'] <= 0) {
                throw new EasypanelValidationException('Memory swap must be a positive number (in MB)');
            }
        }

        // Validate CPUs if provided
        if (isset($data['cpus'])) {
            if (! is_numeric($data['cpus']) || $data['cpus'] <= 0) {
                throw new EasypanelValidationException('CPUs must be a positive number');
            }
        }

        // Validate memory swap is not less than memory
        if (isset($data['memory']) && isset($data['memorySwap'])) {
            if ($data['memorySwap'] < $data['memory']) {
                throw new EasypanelValidationException('Memory swap cannot be less than memory allocation');
            }
        }
    }
}
