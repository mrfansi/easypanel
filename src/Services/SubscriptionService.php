<?php

declare(strict_types=1);

namespace Mrfansi\Easypanel\Services;

final class SubscriptionService extends AbstractService
{
    /**
     * Handle invalidate actions subscription event
     */
    public function onInvalidateActions(): array
    {
        return $this->makePostRequest('subscription.onInvalidateActions');
    }
}
