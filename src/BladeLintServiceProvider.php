<?php

namespace RyanChandler\BladeLint;

use Illuminate\Config\Repository;
use Illuminate\Contracts\Foundation\Application;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class BladeLintServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        $package
            ->name('blade-lint')
            ->hasConfigFile()
            ->hasCommands([
                Commands\InstallCommand::class,
                Commands\LintCommand::class,
            ]);
    }

    public function packageRegistered()
    {
        $this->app->singleton(BladeLintManager::class, static function (Application $app): BladeLintManager {
            return new BladeLintManager(
                $app,
                $app->get('view.finder'),
                $app->get(Repository::class)->get('blade-lint.rules'),
            );
        });
    }
}
