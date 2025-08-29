<?php

declare(strict_types=1);

namespace Mrfansi\Easypanel\Services;

use Mrfansi\Easypanel\Exceptions\EasypanelValidationException;
use Mrfansi\Easypanel\Validation\RequestValidator;

final class UsersService extends AbstractService
{
    public function listUsers(): array
    {
        return $this->makeRequest('users.listUsers');
    }

    /**
     * @throws EasypanelValidationException
     */
    public function generateApiToken(string $name): array
    {
        RequestValidator::validateRequiredField($name, 'name');

        return $this->makePostRequest('users.generateApiToken', [
            'name' => $name,
        ]);
    }

    /**
     * @throws EasypanelValidationException
     */
    public function revokeApiToken(string $tokenId): array
    {
        RequestValidator::validateRequiredField($tokenId, 'tokenId');

        return $this->makeDeleteRequest('users.revokeApiToken', [
            'tokenId' => $tokenId,
        ]);
    }

    /**
     * @throws EasypanelValidationException
     */
    public function createUser(array $userData): array
    {
        RequestValidator::validateRequiredField($userData['email'] ?? null, 'email');
        RequestValidator::validateRequiredField($userData['password'] ?? null, 'password');

        return $this->makePostRequest('users.createUser', $userData);
    }

    /**
     * @throws EasypanelValidationException
     */
    public function updateUser(string $userId, array $userData): array
    {
        RequestValidator::validateRequiredField($userId, 'userId');

        return $this->makePatchRequest('users.updateUser', array_merge([
            'userId' => $userId,
        ], $userData));
    }

    /**
     * @throws EasypanelValidationException
     */
    public function destroyUser(string $userId): array
    {
        RequestValidator::validateRequiredField($userId, 'userId');

        return $this->makeDeleteRequest('users.destroyUser', [
            'userId' => $userId,
        ]);
    }
}
