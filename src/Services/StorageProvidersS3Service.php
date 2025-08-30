<?php

declare(strict_types=1);

namespace Mrfansi\Easypanel\Services;

use Mrfansi\Easypanel\Exceptions\EasypanelValidationException;
use Mrfansi\Easypanel\Validation\RequestValidator;

/**
 * Storage Providers S3 Service
 *
 * Handles S3 storage provider operations including creating, updating, and deleting providers.
 * Supports multiple S3-compatible services including AWS, Backblaze, Digital Ocean, and Wasabi.
 */
final class StorageProvidersS3Service extends AbstractService
{
    public const SUBTYPE_OTHER = 'other';

    public const SUBTYPE_AWS = 'aws';

    public const SUBTYPE_BACKBLAZE = 'backblaze';

    public const SUBTYPE_DIGITAL_OCEAN = 'digital-ocean';

    public const SUBTYPE_WASABI = 'wasabi';

    private const VALID_SUBTYPES = [
        self::SUBTYPE_OTHER,
        self::SUBTYPE_AWS,
        self::SUBTYPE_BACKBLAZE,
        self::SUBTYPE_DIGITAL_OCEAN,
        self::SUBTYPE_WASABI,
    ];

    /**
     * Create a new S3 storage provider.
     *
     * @throws EasypanelValidationException
     */
    public function createProvider(
        string $subtype,
        string $name,
        string $accessKeyId,
        string $secretAccessKey,
        string $bucket,
        string $region,
        ?string $endpoint = null
    ): array {
        RequestValidator::validateRequiredField($subtype, 'subtype');
        RequestValidator::validateRequiredField($name, 'name');
        RequestValidator::validateRequiredField($accessKeyId, 'accessKeyId');
        RequestValidator::validateRequiredField($secretAccessKey, 'secretAccessKey');
        RequestValidator::validateRequiredField($bucket, 'bucket');
        RequestValidator::validateRequiredField($region, 'region');

        if (! in_array($subtype, self::VALID_SUBTYPES, true)) {
            throw new EasypanelValidationException(sprintf(
                'Invalid subtype "%s". Valid subtypes are: %s',
                $subtype,
                implode(', ', self::VALID_SUBTYPES)
            ));
        }

        $data = [
            'subtype' => $subtype,
            'name' => $name,
            'accessKeyId' => $accessKeyId,
            'secretAccessKey' => $secretAccessKey,
            'bucket' => $bucket,
            'region' => $region,
        ];

        if ($endpoint !== null) {
            $data['endpoint'] = $endpoint;
        }

        return $this->makePostRequest('storageProviders.s3.createProvider', [
            'json' => $data,
        ]);
    }

    /**
     * Update an existing S3 storage provider.
     *
     * @throws EasypanelValidationException
     */
    public function updateProvider(
        string $id,
        string $name,
        string $accessKeyId,
        string $secretAccessKey,
        string $bucket,
        string $region,
        ?string $endpoint = null
    ): array {
        RequestValidator::validateRequiredField($id, 'id');
        RequestValidator::validateRequiredField($name, 'name');
        RequestValidator::validateRequiredField($accessKeyId, 'accessKeyId');
        RequestValidator::validateRequiredField($secretAccessKey, 'secretAccessKey');
        RequestValidator::validateRequiredField($bucket, 'bucket');
        RequestValidator::validateRequiredField($region, 'region');

        $data = [
            'id' => $id,
            'name' => $name,
            'accessKeyId' => $accessKeyId,
            'secretAccessKey' => $secretAccessKey,
            'bucket' => $bucket,
            'region' => $region,
        ];

        if ($endpoint !== null) {
            $data['endpoint'] = $endpoint;
        }

        return $this->makePostRequest('storageProviders.s3.updateProvider', [
            'json' => $data,
        ]);
    }

    /**
     * Delete an S3 storage provider.
     *
     * @throws EasypanelValidationException
     */
    public function deleteProvider(string $id): array
    {
        RequestValidator::validateRequiredField($id, 'id');

        return $this->makePostRequest('storageProviders.s3.deleteProvider', [
            'json' => [
                'id' => $id,
            ],
        ]);
    }
}
