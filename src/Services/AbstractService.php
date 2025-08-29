<?php

declare(strict_types=1);

namespace Mrfansi\Easypanel\Services;

use Mrfansi\Easypanel\Contracts\HttpClientInterface;
use Mrfansi\Easypanel\Contracts\ServiceInterface;

abstract class AbstractService implements ServiceInterface
{
    protected HttpClientInterface $httpClient;

    public function __construct(HttpClientInterface $httpClient)
    {
        $this->httpClient = $httpClient;
    }

    protected function makeRequest(string $endpoint, array $parameters = []): array
    {
        return $this->httpClient->get("/api/trpc/{$endpoint}", $parameters);
    }

    protected function makePostRequest(string $endpoint, array $data = []): array
    {
        return $this->httpClient->post("/api/trpc/{$endpoint}", $data);
    }

    protected function makePatchRequest(string $endpoint, array $data = []): array
    {
        return $this->httpClient->patch("/api/trpc/{$endpoint}", $data);
    }

    protected function makeDeleteRequest(string $endpoint, array $parameters = []): array
    {
        return $this->httpClient->delete("/api/trpc/{$endpoint}", $parameters);
    }
}
