<?php

declare(strict_types=1);

namespace Mrfansi\Easypanel\Services;

use Mrfansi\Easypanel\Exceptions\EasypanelValidationException;
use Mrfansi\Easypanel\Validation\RequestValidator;

final class DomainsService extends AbstractService
{
    public function getPrimaryDomain(): array
    {
        return $this->makeRequest('domains.getPrimaryDomain');
    }

    public function listDomains(): array
    {
        return $this->makeRequest('domains.listDomains');
    }

    /**
     * @throws EasypanelValidationException
     */
    public function createDomain(array $domainData): array
    {
        RequestValidator::validateRequiredField($domainData['name'] ?? null, 'name');

        return $this->makePostRequest('domains.createDomain', $domainData);
    }

    /**
     * @throws EasypanelValidationException
     */
    public function updateDomain(string $domainId, array $domainData): array
    {
        RequestValidator::validateRequiredField($domainId, 'domainId');

        return $this->makePatchRequest('domains.updateDomain', array_merge([
            'domainId' => $domainId,
        ], $domainData));
    }

    /**
     * @throws EasypanelValidationException
     */
    public function deleteDomain(string $domainId): array
    {
        RequestValidator::validateRequiredField($domainId, 'domainId');

        return $this->makeDeleteRequest('domains.deleteDomain', [
            'domainId' => $domainId,
        ]);
    }

    /**
     * @throws EasypanelValidationException
     */
    public function setPrimaryDomain(string $domainName): array
    {
        RequestValidator::validateRequiredField($domainName, 'domainName');

        return $this->makePostRequest('domains.setPrimaryDomain', [
            'domainName' => $domainName,
        ]);
    }
}
