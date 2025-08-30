<?php

declare(strict_types=1);

namespace Mrfansi\Easypanel\Http;

use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use Mrfansi\Easypanel\Contracts\HttpClientInterface;
use Mrfansi\Easypanel\Exceptions\EasypanelApiException;
use Mrfansi\Easypanel\Exceptions\EasypanelAuthenticationException;
use Mrfansi\Easypanel\Exceptions\EasypanelException;
use Mrfansi\Easypanel\Exceptions\EasypanelValidationException;

final class HttpClient implements HttpClientInterface
{
    private string $baseUrl;

    private string $authToken;

    private int $timeout;

    public function __construct(string $baseUrl, string $authToken, int $timeout = 30)
    {
        $this->baseUrl = mb_rtrim($baseUrl, '/');
        $this->authToken = $authToken;
        $this->timeout = $timeout;
    }

    /**
     * @throws EasypanelException
     * @throws EasypanelValidationException
     * @throws EasypanelAuthenticationException
     * @throws EasypanelApiException
     */
    public function get(string $endpoint, array $parameters = []): array
    {
        return $this->makeRequest('GET', $endpoint, $parameters);
    }

    /**
     * @throws EasypanelException
     * @throws EasypanelValidationException
     * @throws EasypanelAuthenticationException
     * @throws EasypanelApiException
     */
    public function post(string $endpoint, array $data = []): array
    {
        return $this->makeRequest('POST', $endpoint, $data);
    }

    /**
     * @throws EasypanelException
     * @throws EasypanelValidationException
     * @throws EasypanelAuthenticationException
     * @throws EasypanelApiException
     */
    public function put(string $endpoint, array $data = []): array
    {
        return $this->makeRequest('PUT', $endpoint, $data);
    }

    /**
     * @throws EasypanelException
     * @throws EasypanelValidationException
     * @throws EasypanelAuthenticationException
     * @throws EasypanelApiException
     */
    public function patch(string $endpoint, array $data = []): array
    {
        return $this->makeRequest('PATCH', $endpoint, $data);
    }

    /**
     * @throws EasypanelException
     * @throws EasypanelValidationException
     * @throws EasypanelAuthenticationException
     * @throws EasypanelApiException
     */
    public function delete(string $endpoint, array $parameters = []): array
    {
        return $this->makeRequest('DELETE', $endpoint, $parameters);
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

    /**
     * @throws EasypanelException
     * @throws EasypanelValidationException
     * @throws EasypanelAuthenticationException
     * @throws EasypanelApiException
     */
    private function makeRequest(string $method, string $endpoint, array $data = []): array
    {
        $url = "{$this->baseUrl}{$endpoint}";

        $request = Http::timeout($this->timeout)
            ->withHeaders([
                'Authorization' => "Bearer {$this->authToken}",
                'Accept' => 'application/json',
            ]);

        $response = match (mb_strtoupper($method)) {
            'GET' => $request->get($url, $data),
            'POST' => $request->post($url, $data),
            'PUT' => $request->put($url, $data),
            'PATCH' => $request->patch($url, $data),
            'DELETE' => $request->delete($url, $data),
            default => throw new EasypanelException("Unsupported HTTP method: {$method}"),
        };

        return $this->handleResponse($response);
    }

    /**
     * @throws EasypanelException
     * @throws EasypanelValidationException
     * @throws EasypanelAuthenticationException
     * @throws EasypanelApiException
     */
    private function handleResponse(Response $response): array
    {
        if ($response->successful()) {
            return $response->json() ?? [];
        }

        $errorData = $response->json();

        match ($response->status()) {
            401 => throw new EasypanelAuthenticationException(
                $errorData['message'] ?? 'Authentication failed',
                $response->status()
            ),
            422 => throw new EasypanelValidationException(
                $errorData['message'] ?? 'Validation failed',
                $errorData['errors'] ?? []
            ),
            default => throw new EasypanelApiException(
                $errorData['message'] ?? 'API request failed',
                $response->status()
            ),
        };

        // This line will never be reached, but satisfies static analysis
        return [];
    }
}
