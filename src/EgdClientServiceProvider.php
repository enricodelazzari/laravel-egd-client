<?php

namespace EnricoDeLazzari\EgdClient;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use EnricoDeLazzari\EgdClient\Commands\EgdClientCommand;

class EgdClientServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        $package
            ->name('laravel-egd-client')
            ->hasConfigFile();
    }
}
