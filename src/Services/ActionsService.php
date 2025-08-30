<?php

declare(strict_types=1);

namespace Mrfansi\Easypanel\Services;

class ActionsService extends AbstractService
{
    /**
     * List actions for a project/service.
     *
     * @param  string  $projectName  The project name
     * @param  string  $serviceName  The service name
     * @param  string|null  $type  The action type filter
     * @param  int  $limit  The number of actions to return (default: 8)
     */
    public function listActions(string $projectName, string $serviceName, ?string $type = null, int $limit = 8): array
    {
        $parameters = [
            'projectName' => $projectName,
            'serviceName' => $serviceName,
            'limit' => $limit,
        ];

        if ($type !== null) {
            $parameters['type'] = $type;
        }

        return $this->makeRequest('actions.listActions', $parameters);
    }

    /**
     * Get details of a specific action.
     *
     * @param  string  $id  The action ID
     */
    public function getAction(string $id): array
    {
        return $this->makeRequest('actions.getAction', ['id' => $id]);
    }

    /**
     * Kill a running action.
     *
     * @param  string  $id  The action ID
     */
    public function killAction(string $id): array
    {
        return $this->makePostRequest('actions.killAction', ['id' => $id]);
    }
}
