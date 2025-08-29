<?php

declare(strict_types=1);

namespace Mrfansi\Easypanel\Services;

final class AuthService extends AbstractService
{
    public function getUser(): array
    {
        return $this->makeRequest('auth.getUser');
    }

    public function getSession(): array
    {
        return $this->makeRequest('auth.getSession');
    }

    public function login(string $email, string $password): array
    {
        return $this->makePostRequest('auth.login', [
            'email' => $email,
            'password' => $password,
        ]);
    }

    public function logout(): array
    {
        return $this->makePostRequest('auth.logout');
    }
}
