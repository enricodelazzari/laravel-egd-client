<?php

namespace EnricoDeLazzari\EgdClient;

use EnricoDeLazzari\EgdClient\Commands\EgdClientCommand;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class EgdClientServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('laravel-egd-client')
            ->hasConfigFile()
            ->hasViews()
            ->hasMigration('create_laravel-egd-client_table')
            ->hasCommand(EgdClientCommand::class);
    }
}
