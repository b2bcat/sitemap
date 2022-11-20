<?php

namespace B2bcat\SiteMap\Tests;

use Orchestra\Testbench\TestCase as Orchestra;
use B2bcat\SiteMap\Laravel\SiteMapServiceProvider;

class TestCase extends Orchestra
{
    public $tmp = __DIR__ . '/temp/';

    protected function getPackageProviders($app)
    {
        return [
            SiteMapServiceProvider::class,
        ];
    }

}
