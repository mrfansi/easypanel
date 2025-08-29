<?php

declare(strict_types=1);

namespace Mrfansi\Easypanel\Data;

final class ProjectData
{
    public function __construct(
        public readonly string $name,
        public readonly ?string $description = null,
        public readonly ?array $environment = null,
        public readonly ?array $domains = null,
        public readonly ?array $services = null,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            name: $data['name'],
            description: $data['description'] ?? null,
            environment: $data['environment'] ?? null,
            domains: $data['domains'] ?? null,
            services: $data['services'] ?? null,
        );
    }

    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'description' => $this->description,
            'environment' => $this->environment,
            'domains' => $this->domains,
            'services' => $this->services,
        ];
    }
}
