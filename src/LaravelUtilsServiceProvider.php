<?php

namespace Teofanis\LaravelUtils;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use Teofanis\LaravelUtils\Commands\LaravelUtilsCommand;
use Teofanis\LaravelUtils\Utilities;

class LaravelUtilsServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('laravel-utils')
            ->hasConfigFile()
            ->hasViews()
            ->hasMigration('create_laravel-utils_table')
            ->hasCommand(LaravelUtilsCommand::class);

    }

    public function packageRegistered(): void
    {
        $this->app->bind('utilities', function ($app) {
            return new Utilities();
        });
    }
}
