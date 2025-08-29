<?php

declare(strict_types=1);

namespace Mrfansi\Easypanel\Services;

final class TemplatesService extends AbstractService
{
    public function createFromSchema(array $schemaData): array
    {
        return $this->makePostRequest('templates.createFromSchema', $schemaData);
    }
}
