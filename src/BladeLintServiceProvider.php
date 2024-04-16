<?php

namespace RyanChandler\BladeLint;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use RyanChandler\BladeLint\Commands\BladeLintCommand;

class BladeLintServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('blade-lint')
            ->hasConfigFile()
            ->hasViews()
            ->hasMigration('create_blade-lint_table')
            ->hasCommand(BladeLintCommand::class);
    }
}
