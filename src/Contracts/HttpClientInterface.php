<?php

declare(strict_types=1);

namespace Mrfansi\Easypanel\Contracts;

interface HttpClientInterface
{
    public function get(string $endpoint, array $parameters = []): array;

    public function post(string $endpoint, array $data = []): array;

    public function put(string $endpoint, array $data = []): array;

    public function patch(string $endpoint, array $data = []): array;

    public function delete(string $endpoint, array $parameters = []): array;

    public function setBaseUrl(string $baseUrl): self;

    public function setAuthToken(string $token): self;

    public function setTimeout(int $timeout): self;
}