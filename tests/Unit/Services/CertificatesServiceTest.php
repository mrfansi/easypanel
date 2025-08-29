<?php

declare(strict_types=1);

use Mrfansi\Easypanel\Contracts\HttpClientInterface;
use Mrfansi\Easypanel\Exceptions\EasypanelValidationException;
use Mrfansi\Easypanel\Services\CertificatesService;

beforeEach(function () {
    $this->httpClient = Mockery::mock(HttpClientInterface::class);
    $this->service = new CertificatesService($this->httpClient);
});

afterEach(function () {
    Mockery::close();
});

it('can list certificates', function () {
    $expectedData = ['certificates' => []];
    $this->httpClient
        ->shouldReceive('get')
        ->with('/api/trpc/certificates.listCertificates', [])
        ->andReturn($expectedData);

    $result = $this->service->listCertificates();
    expect($result)->toBe($expectedData);
});

it('can remove certificate', function () {
    $certificateId = 'cert-123';
    $expectedData = ['success' => true];

    $this->httpClient
        ->shouldReceive('delete')
        ->with('/api/trpc/certificates.removeCertificate', ['certificateId' => $certificateId])
        ->andReturn($expectedData);

    $result = $this->service->removeCertificate($certificateId);
    expect($result)->toBe($expectedData);
});

it('throws validation exception for empty certificate id', function () {
    $this->service->removeCertificate('');
})->throws(EasypanelValidationException::class);
