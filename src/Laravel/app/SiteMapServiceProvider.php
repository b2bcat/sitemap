<?php

namespace B2bcat\SiteMap\Laravel;

use Spatie\LaravelPackageTools\Package;
use Illuminate\Support\ServiceProvider;

class SiteMapServiceProvider extends ServiceProvider
{
    /**
     * @param Package $package
     * @return void
     */
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package->name('sitemap');
    }

}
