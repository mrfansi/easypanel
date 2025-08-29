<?php

declare(strict_types=1);

namespace Mrfansi\Easypanel;

use Illuminate\Http\Client\Factory as HttpFactory;
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
            $httpFactory = $this->app->make(HttpFactory::class);
            $httpClient = new HttpClient($httpFactory);

            $config = config('easypanel');

            if ($config['base_url']) {
                $httpClient->setBaseUrl($config['base_url']);
            }

            if ($config['auth_token']) {
                $httpClient->setAuthToken($config['auth_token']);
            }

            if ($config['timeout']) {
                $httpClient->setTimeout($config['timeout']);
            }

            return $httpClient;
        });

        $this->app->bind(Easypanel::class, function () {
            return new Easypanel($this->app->make(HttpClientInterface::class));
        });

        $this->app->alias(Easypanel::class, 'easypanel');
    }
}
