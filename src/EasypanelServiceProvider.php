<?php

namespace Mrfansi\Easypanel;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use Mrfansi\Easypanel\Commands\EasypanelCommand;

class EasypanelServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('easypanel')
            ->hasConfigFile()
            ->hasViews()
            ->hasMigration('create_easypanel_table')
            ->hasCommand(EasypanelCommand::class);
    }
}
