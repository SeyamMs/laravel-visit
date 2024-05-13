<?php

namespace SeyamMs\LaravelVisit;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class LaravelVisitServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        $package
            ->name('laravel-visit')
            ->hasConfigFile()
            ->hasMigration('create_visits_table');
    }

    public function packageRegistered(): void
    {
        $this->app->bind('LaravelVisit', LaravelVisit::class);
    }
}
