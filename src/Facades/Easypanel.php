<?php

declare(strict_types=1);

namespace Mrfansi\Easypanel\Facades;

use Illuminate\Support\Facades\Facade;
use Mrfansi\Easypanel\Services\AuthService;
use Mrfansi\Easypanel\Services\MonitorService;
use Mrfansi\Easypanel\Services\ProjectService;
use Mrfansi\Easypanel\Services\ServiceService;
use Mrfansi\Easypanel\Services\SettingsService;

/**
 * @method static AuthService auth()
 * @method static ProjectService projects()
 * @method static ServiceService services()
 * @method static MonitorService monitor()
 * @method static SettingsService settings()
 * @method static self setBaseUrl(string $baseUrl)
 * @method static self setAuthToken(string $token)
 * @method static self setTimeout(int $timeout)
 *
 * @see \Mrfansi\Easypanel\Easypanel
 */
final class Easypanel extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return 'easypanel';
    }
}
