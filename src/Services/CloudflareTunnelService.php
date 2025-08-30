<?php

declare(strict_types=1);

namespace Mrfansi\Easypanel\Services;

use Mrfansi\Easypanel\Exceptions\EasypanelValidationException;
use Mrfansi\Easypanel\Validation\RequestValidator;

/**
 * Cloudflare Tunnel Service for Easypanel API
 *
 * Provides methods to manage Cloudflare tunnel configuration,
 * accounts, zones, tunnels, tunnel rules, and tunnel operations.
 */
final class CloudflareTunnelService extends AbstractService
{
    /**
     * Get Cloudflare tunnel configuration
     */
    public function getConfig(): array
    {
        return $this->makeRequest('cloudflareTunnel.getConfig');
    }

    /**
     * List Cloudflare zones
     */
    public function listZones(): array
    {
        return $this->makeRequest('cloudflareTunnel.listZones');
    }

    /**
     * List Cloudflare accounts
     *
     * @param  string  $apiToken  Cloudflare API token
     *
     * @throws EasypanelValidationException
     */
    public function listAccounts(string $apiToken): array
    {
        RequestValidator::validateRequiredField($apiToken, 'apiToken');

        return $this->makeRequest('cloudflareTunnel.listAccounts', [
            'apiToken' => $apiToken,
        ]);
    }

    /**
     * List Cloudflare tunnels
     *
     * @param  string  $apiToken  Cloudflare API token
     * @param  string  $accountId  Cloudflare account ID
     *
     * @throws EasypanelValidationException
     */
    public function listTunnels(string $apiToken, string $accountId): array
    {
        RequestValidator::validateRequiredField($apiToken, 'apiToken');
        RequestValidator::validateRequiredField($accountId, 'accountId');

        return $this->makeRequest('cloudflareTunnel.listTunnels', [
            'apiToken' => $apiToken,
            'accountId' => $accountId,
        ]);
    }

    /**
     * Get tunnel rules for a specific service
     *
     * @param  string  $projectName  Project name (lowercase letters, numbers, hyphens, underscores only)
     * @param  string  $serviceName  Service name (lowercase letters, numbers, hyphens, underscores only)
     *
     * @throws EasypanelValidationException
     */
    public function getTunnelRules(string $projectName, string $serviceName): array
    {
        RequestValidator::validateProjectName($projectName);
        RequestValidator::validateServiceName($serviceName);

        return $this->makeRequest('cloudflareTunnel.getTunnelRules', [
            'projectName' => $projectName,
            'serviceName' => $serviceName,
        ]);
    }

    /**
     * Set Cloudflare tunnel configuration
     *
     * @param  array  $configData  Configuration data containing apiToken, accountId, and tunnelId
     *
     * @throws EasypanelValidationException
     */
    public function setConfig(array $configData): array
    {
        if (isset($configData['apiToken'])) {
            RequestValidator::validateRequiredField($configData['apiToken'], 'apiToken');
        }
        if (isset($configData['accountId'])) {
            RequestValidator::validateRequiredField($configData['accountId'], 'accountId');
        }
        if (isset($configData['tunnelId'])) {
            RequestValidator::validateRequiredField($configData['tunnelId'], 'tunnelId');
        }

        return $this->makePostRequest('cloudflareTunnel.setConfig', $configData);
    }

    /**
     * Create a new tunnel rule
     *
     * @param  array  $ruleData  Rule data containing all required fields
     *
     * @throws EasypanelValidationException
     */
    public function createTunnelRule(array $ruleData): array
    {
        $required = ['projectName', 'serviceName', 'subdomain', 'domain', 'path', 'internalProtocol', 'internalPort', 'zoneId'];
        RequestValidator::validateRequired($ruleData, $required);

        RequestValidator::validateProjectName($ruleData['projectName']);
        RequestValidator::validateServiceName($ruleData['serviceName']);
        RequestValidator::validateDomainName($ruleData['domain']);
        RequestValidator::validatePort($ruleData['internalPort']);

        $validProtocols = ['http', 'https'];
        if (! in_array($ruleData['internalProtocol'], $validProtocols)) {
            throw new EasypanelValidationException('Internal protocol must be http or https');
        }

        return $this->makePostRequest('cloudflareTunnel.createTunnelRule', $ruleData);
    }

    /**
     * Update an existing tunnel rule
     *
     * @param  array  $ruleData  Rule data containing id and all required fields
     *
     * @throws EasypanelValidationException
     */
    public function updateTunnelRule(array $ruleData): array
    {
        $required = ['id', 'projectName', 'serviceName', 'subdomain', 'domain', 'path', 'internalProtocol', 'internalPort', 'zoneId', 'dnsRecordId'];
        RequestValidator::validateRequired($ruleData, $required);

        RequestValidator::validateProjectName($ruleData['projectName']);
        RequestValidator::validateServiceName($ruleData['serviceName']);
        RequestValidator::validateDomainName($ruleData['domain']);
        RequestValidator::validatePort($ruleData['internalPort']);

        $validProtocols = ['http', 'https'];
        if (! in_array($ruleData['internalProtocol'], $validProtocols)) {
            throw new EasypanelValidationException('Internal protocol must be http or https');
        }

        return $this->makePostRequest('cloudflareTunnel.updateTunnelRule', $ruleData);
    }

    /**
     * Delete a tunnel rule
     *
     * @param  string  $ruleId  Rule ID to delete
     *
     * @throws EasypanelValidationException
     */
    public function deleteTunnelRule(string $ruleId): array
    {
        RequestValidator::validateRequiredField($ruleId, 'id');

        return $this->makePostRequest('cloudflareTunnel.deleteTunnelRule', [
            'id' => $ruleId,
        ]);
    }

    /**
     * Start Cloudflare tunnel
     */
    public function startTunnel(): array
    {
        return $this->makePostRequest('cloudflareTunnel.startTunnel', []);
    }

    /**
     * Stop Cloudflare tunnel
     */
    public function stopTunnel(): array
    {
        return $this->makePostRequest('cloudflareTunnel.stopTunnel', []);
    }
}
