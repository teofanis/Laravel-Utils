<?php

namespace Teofanis\LaravelUtils;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class LaravelUtilsServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        $package->name('laravel-utils')
            ->hasConfigFile();
    }

    public function packageRegistered(): void
    {
        $this->app->bind('utilities', fn () => new Utilities());
    }

    public function packageBooted(): void
    {
        collect((new MacrosRegistry())->macros())->each(function ($class) {
            $extender = app($class);
            $base = $extender->getBaseClass();
            $base::mixin($extender);
        });
        require_once __DIR__.'/aliases.php';
    }
}
