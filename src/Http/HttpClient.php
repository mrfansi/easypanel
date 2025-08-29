<?php

declare(strict_types=1);

namespace Mrfansi\Easypanel\Http;

use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\Client\Factory as HttpFactory;
use Illuminate\Http\Client\PendingRequest;
use Illuminate\Http\Client\Response;
use Mrfansi\Easypanel\Contracts\HttpClientInterface;
use Mrfansi\Easypanel\Exceptions\EasypanelApiException;
use Mrfansi\Easypanel\Exceptions\EasypanelAuthenticationException;
use Mrfansi\Easypanel\Exceptions\EasypanelValidationException;

final class HttpClient implements HttpClientInterface
{
    private HttpFactory $httpFactory;

    private string $baseUrl = '';

    private string $authToken = '';

    private int $timeout = 30;

    public function __construct(HttpFactory $httpFactory)
    {
        $this->httpFactory = $httpFactory;
    }

    /**
     * @throws EasypanelAuthenticationException
     * @throws EasypanelApiException
     * @throws ConnectionException
     * @throws EasypanelValidationException
     */
    public function get(string $endpoint, array $parameters = []): array
    {
        $query = $this->buildTrpcQuery($parameters);

        return $this->makeRequest('GET', $endpoint.($query ? '?'.$query : ''));
    }

    /**
     * @throws EasypanelApiException
     * @throws EasypanelAuthenticationException
     * @throws ConnectionException
     * @throws EasypanelValidationException
     */
    public function post(string $endpoint, array $data = []): array
    {
        return $this->makeRequest('POST', $endpoint, $data);
    }

    /**
     * @throws EasypanelApiException
     * @throws EasypanelAuthenticationException
     * @throws ConnectionException
     * @throws EasypanelValidationException
     */
    public function put(string $endpoint, array $data = []): array
    {
        return $this->makeRequest('PUT', $endpoint, $data);
    }

    /**
     * @throws EasypanelAuthenticationException
     * @throws EasypanelApiException
     * @throws ConnectionException
     * @throws EasypanelValidationException
     */
    public function patch(string $endpoint, array $data = []): array
    {
        return $this->makeRequest('PATCH', $endpoint, $data);
    }

    /**
     * @throws EasypanelAuthenticationException
     * @throws EasypanelApiException
     * @throws ConnectionException
     * @throws EasypanelValidationException
     */
    public function delete(string $endpoint): array
    {
        return $this->makeRequest('DELETE', $endpoint);
    }

    public function setBaseUrl(string $baseUrl): self
    {
        $this->baseUrl = mb_rtrim($baseUrl, '/');

        return $this;
    }

    public function setAuthToken(string $token): self
    {
        $this->authToken = $token;

        return $this;
    }

    public function setTimeout(int $timeout): self
    {
        $this->timeout = $timeout;

        return $this;
    }

    private function buildTrpcQuery(array $parameters): string
    {
        if (empty($parameters)) {
            return '';
        }

        return http_build_query([
            'input' => json_encode([
                'json' => $parameters,
            ]),
        ]);
    }

    /**
     * @throws EasypanelAuthenticationException
     * @throws EasypanelApiException
     * @throws ConnectionException
     * @throws EasypanelValidationException
     */
    private function makeRequest(string $method, string $endpoint, array $data = []): array
    {
        $client = $this->buildClient();

        $response = match (mb_strtoupper($method)) {
            'GET' => $client->get($endpoint),
            'POST' => $client->post($endpoint, $data),
            'PUT' => $client->put($endpoint, $data),
            'PATCH' => $client->patch($endpoint, $data),
            'DELETE' => $client->delete($endpoint),
            default => throw new EasypanelApiException("Unsupported HTTP method: $method")
        };

        return $this->handleResponse($response);
    }

    private function buildClient(): PendingRequest
    {
        $client = $this->httpFactory
            ->baseUrl($this->baseUrl)
            ->timeout($this->timeout)
            ->accept('application/json');

        if ($this->authToken) {
            $client->withToken($this->authToken);
        }

        return $client;
    }

    /**
     * @throws EasypanelAuthenticationException
     * @throws EasypanelApiException
     * @throws EasypanelValidationException
     */
    private function handleResponse(Response $response): array
    {
        $statusCode = $response->status();
        $data = $response->json();

        if ($statusCode >= 200 && $statusCode < 300) {
            return $data ?? [];
        }

        $this->throwAppropriateException($statusCode, $data);
    }

    /**
     * @throws EasypanelAuthenticationException
     * @throws EasypanelValidationException
     * @throws EasypanelApiException
     */
    private function throwAppropriateException(int $statusCode, ?array $data): never
    {
        $message = $data['message'] ?? $data['error'] ?? 'Unknown error occurred';

        match ($statusCode) {
            401 => throw new EasypanelAuthenticationException($message),
            422 => throw new EasypanelValidationException($message, $data['errors'] ?? []),
            default => throw new EasypanelApiException($message, $statusCode)
        };
    }
}
