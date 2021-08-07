<?php

namespace Teofanis\LaravelUtils;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class LaravelUtilsServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package->name('laravel-utils');
    }

    public function packageRegistered(): void
    {
        $this->app->bind('utilities', fn () => new Utilities());
    }
}
