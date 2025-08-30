<?php

declare(strict_types=1);

namespace Mrfansi\Easypanel\Services;

use Mrfansi\Easypanel\Exceptions\EasypanelValidationException;
use Mrfansi\Easypanel\Validation\RequestValidator;

/**
 * Notifications Service for Easypanel API
 *
 * Provides methods to manage notification channels including creation,
 * updates, deletion, and testing of notifications for various platforms
 * (Discord, Telegram, Slack, SMTP, Webhook).
 */
final class NotificationsService extends AbstractService
{
    /**
     * List all notification channels
     */
    public function listNotificationChannels(): array
    {
        return $this->makeRequest('notifications.listNotificationChannels');
    }

    /**
     * Send a test notification to a channel
     *
     * @param  array  $notificationData  Notification channel data with target and events configuration
     *
     * @throws EasypanelValidationException
     */
    public function sendTestNotification(array $notificationData): array
    {
        $this->validateNotificationChannel($notificationData);

        return $this->makePostRequest('notifications.sendTestNotification', $notificationData);
    }

    /**
     * Create a new notification channel
     *
     * @param  array  $channelData  Channel data with name, target, and events configuration
     *
     * @throws EasypanelValidationException
     */
    public function createNotificationChannel(array $channelData): array
    {
        $this->validateNotificationChannel($channelData);

        return $this->makePostRequest('notifications.createNotificationChannel', $channelData);
    }

    /**
     * Update an existing notification channel
     *
     * @param  array  $channelData  Channel data including ID and all configuration
     *
     * @throws EasypanelValidationException
     */
    public function updateNotificationChannel(array $channelData): array
    {
        RequestValidator::validateRequiredField($channelData['id'] ?? null, 'id');
        $this->validateNotificationChannel($channelData);

        return $this->makePostRequest('notifications.updateNotificationChannel', $channelData);
    }

    /**
     * Delete a notification channel
     *
     * @param  string  $channelId  Channel ID to delete
     *
     * @throws EasypanelValidationException
     */
    public function destroyNotificationChannel(string $channelId): array
    {
        RequestValidator::validateRequiredField($channelId, 'id');

        return $this->makePostRequest('notifications.destroyNotificationChannel', [
            'id' => $channelId,
        ]);
    }

    /**
     * Validate notification channel data
     *
     * @param  array  $data  Channel data to validate
     *
     * @throws EasypanelValidationException
     */
    private function validateNotificationChannel(array $data): void
    {
        $required = ['name', 'target', 'events'];
        RequestValidator::validateRequired($data, $required);

        $this->validateTarget($data['target']);
        $this->validateEvents($data['events']);
    }

    /**
     * Validate notification target configuration
     *
     * @param  array  $target  Target configuration
     *
     * @throws EasypanelValidationException
     */
    private function validateTarget(array $target): void
    {
        if (! isset($target['type'])) {
            throw new EasypanelValidationException('Target type is required');
        }

        switch ($target['type']) {
            case 'discord':
                $this->validateDiscordTarget($target);
                break;
            case 'telegram':
                $this->validateTelegramTarget($target);
                break;
            case 'slack':
                $this->validateSlackTarget($target);
                break;
            case 'smtp':
                $this->validateSmtpTarget($target);
                break;
            case 'webhook':
                $this->validateWebhookTarget($target);
                break;
            default:
                throw new EasypanelValidationException('Invalid target type. Must be one of: discord, telegram, slack, smtp, webhook');
        }
    }

    /**
     * Validate Discord target configuration
     *
     * @param  array  $target  Discord target data
     *
     * @throws EasypanelValidationException
     */
    private function validateDiscordTarget(array $target): void
    {
        RequestValidator::validateRequiredField($target['url'] ?? null, 'url');
        RequestValidator::validateUrl($target['url']);
    }

    /**
     * Validate Telegram target configuration
     *
     * @param  array  $target  Telegram target data
     *
     * @throws EasypanelValidationException
     */
    private function validateTelegramTarget(array $target): void
    {
        $required = ['access_token', 'chat_id'];
        RequestValidator::validateRequired($target, $required);
    }

    /**
     * Validate Slack target configuration
     *
     * @param  array  $target  Slack target data
     *
     * @throws EasypanelValidationException
     */
    private function validateSlackTarget(array $target): void
    {
        RequestValidator::validateRequiredField($target['url'] ?? null, 'url');
        RequestValidator::validateUrl($target['url']);
    }

    /**
     * Validate SMTP target configuration
     *
     * @param  array  $target  SMTP target data
     *
     * @throws EasypanelValidationException
     */
    private function validateSmtpTarget(array $target): void
    {
        $required = ['host', 'port', 'username', 'password', 'recipients'];
        RequestValidator::validateRequired($target, $required);

        RequestValidator::validatePort($target['port']);

        if (! is_array($target['recipients'])) {
            throw new EasypanelValidationException('Recipients must be an array of email addresses');
        }

        foreach ($target['recipients'] as $recipient) {
            RequestValidator::validateEmail($recipient);
        }
    }

    /**
     * Validate webhook target configuration
     *
     * @param  array  $target  Webhook target data
     *
     * @throws EasypanelValidationException
     */
    private function validateWebhookTarget(array $target): void
    {
        RequestValidator::validateRequiredField($target['url'] ?? null, 'url');
        RequestValidator::validateUrl($target['url']);
        // Note: secret is optional for webhook targets
    }

    /**
     * Validate events configuration
     *
     * @param  array  $events  Events configuration
     *
     * @throws EasypanelValidationException
     */
    private function validateEvents(array $events): void
    {
        $validEvents = ['updateAvailable', 'dockerCleanup', 'diskLoad', 'appDeploy', 'databaseBackup'];

        foreach ($events as $eventType => $eventConfig) {
            if (! in_array($eventType, $validEvents)) {
                throw new EasypanelValidationException("Invalid event type: {$eventType}");
            }

            if (! is_array($eventConfig)) {
                throw new EasypanelValidationException("Event configuration for {$eventType} must be an array");
            }

            if (! isset($eventConfig['enabled']) || ! is_bool($eventConfig['enabled'])) {
                throw new EasypanelValidationException("Event {$eventType} must have a boolean 'enabled' field");
            }

            // Special validation for diskLoad event
            if ($eventType === 'diskLoad' && $eventConfig['enabled']) {
                if (! isset($eventConfig['min']) || ! is_numeric($eventConfig['min'])) {
                    throw new EasypanelValidationException('DiskLoad event requires a numeric "min" field');
                }

                if (! isset($eventConfig['schedule']) || empty($eventConfig['schedule'])) {
                    throw new EasypanelValidationException('DiskLoad event requires a "schedule" field');
                }
            }
        }
    }
}
