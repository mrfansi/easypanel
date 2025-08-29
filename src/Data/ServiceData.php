<?php

declare(strict_types=1);

namespace Mrfansi\Easypanel\Data;

final readonly class ServiceData
{
    public function __construct(
        public string $name,
        public string $type,
        public string $projectName,
        public ?array $configuration = null,
        public ?array $environment = null,
        public ?array $ports = null,
        public ?array $volumes = null,
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
