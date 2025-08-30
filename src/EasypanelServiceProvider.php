<?php

declare(strict_types=1);

namespace Mrfansi\Easypanel;

use Mrfansi\Easypanel\Commands\EasypanelCommand;
use Mrfansi\Easypanel\Contracts\HttpClientInterface;
use Mrfansi\Easypanel\Http\HttpClient;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

final class EasypanelServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        $package
            ->name('easypanel')
            ->hasConfigFile()
            ->hasViews()
            ->hasMigration('create_easypanel_table')
            ->hasCommand(EasypanelCommand::class);
    }

    public function packageRegistered(): void
    {
        $this->app->bind(HttpClientInterface::class, function () {
            $config = config('easypanel');

            return new HttpClient(
                $config['base_url'] ?? '',
                $config['auth_token'] ?? '',
                $config['timeout'] ?? 30
            );
        });

        $this->app->bind(Easypanel::class, function () {
            return new Easypanel($this->app->make(HttpClientInterface::class));
        });

        $this->app->alias(Easypanel::class, 'easypanel');
    }
}
