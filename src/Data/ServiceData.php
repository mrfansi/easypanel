<?php

declare(strict_types=1);

namespace Mrfansi\Easypanel\Data;

final class ServiceData
{
    public function __construct(
        public readonly string $name,
        public readonly string $type,
        public readonly string $projectName,
        public readonly ?array $configuration = null,
        public readonly ?array $environment = null,
        public readonly ?array $ports = null,
        public readonly ?array $volumes = null,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            name: $data['name'],
            type: $data['type'],
            projectName: $data['projectName'],
            configuration: $data['configuration'] ?? null,
            environment: $data['environment'] ?? null,
            ports: $data['ports'] ?? null,
            volumes: $data['volumes'] ?? null,
        );
    }

    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'type' => $this->type,
            'projectName' => $this->projectName,
            'configuration' => $this->configuration,
            'environment' => $this->environment,
            'ports' => $this->ports,
            'volumes' => $this->volumes,
        ];
    }
}
