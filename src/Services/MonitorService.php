<?php

declare(strict_types=1);

namespace Mrfansi\Easypanel\Services;

final class MonitorService extends AbstractService
{
    public function getSystemStats(): array
    {
        return $this->makeRequest('monitor.getSystemStats');
    }

    public function getStorageStats(): array
    {
        return $this->makeRequest('monitor.getStorageStats');
    }

    public function getAdvancedStats(): array
    {
        return $this->makeRequest('monitor.getAdvancedStats');
    }

    public function getServiceStats(string $projectName, string $serviceName): array
    {
        return $this->makeRequest('monitor.getServiceStats', [
            'projectName' => $projectName,
            'serviceName' => $serviceName,
        ]);
    }

    public function getDockerTaskStats(): array
    {
        return $this->makeRequest('monitor.getDockerTaskStats');
    }

    public function getMonitorTableData(): array
    {
        return $this->makeRequest('monitor.getMonitorTableData');
    }
}
