<?php

declare(strict_types=1);

namespace Mrfansi\Easypanel\Services;

class ClusterService extends AbstractService
{
    /**
     * List all nodes in the cluster.
     */
    public function listNodes(): array
    {
        return $this->makeRequest('cluster.listNodes');
    }

    /**
     * Get the command to add a worker node to the cluster.
     */
    public function addWorkerCommand(): array
    {
        return $this->makeRequest('cluster.addWorkerCommand');
    }

    /**
     * Remove a node from the cluster.
     *
     * @param  string  $id  The node ID
     */
    public function removeNode(string $id): array
    {
        return $this->makePostRequest('cluster.removeNode', ['id' => $id]);
    }
}
