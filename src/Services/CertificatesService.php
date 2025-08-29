<?php

declare(strict_types=1);

namespace Mrfansi\Easypanel\Services;

use Mrfansi\Easypanel\Exceptions\EasypanelValidationException;
use Mrfansi\Easypanel\Validation\RequestValidator;

final class CertificatesService extends AbstractService
{
    public function listCertificates(): array
    {
        return $this->makeRequest('certificates.listCertificates');
    }

    /**
     * @throws EasypanelValidationException
     */
    public function removeCertificate(string $certificateId): array
    {
        RequestValidator::validateRequiredField($certificateId, 'certificateId');

        return $this->makeDeleteRequest('certificates.removeCertificate', [
            'certificateId' => $certificateId,
        ]);
    }
}
