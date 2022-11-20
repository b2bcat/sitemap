<?php


use B2bcat\SiteMap\Laravel\SiteMapGenerator;
use B2bcat\SiteMap\Laravel\Generator\StaticRoute;
use Illuminate\Support\Facades\Route;

beforeEach(function () {
    Route::get('/products', function () {
    })->name('products.list');

    $this->data = [[
        "loc"        => "http://localhost/products",
        "lastmod"    => "2022-11-20 01:12:10",
        "priority"   => 1.0,
        "changefreq" => "daily",
    ]];
});

test('can parse static route', function () {
    $data = (new StaticRoute())
        ->setRouteName('products.list') // is required
        ->setPriority(1) // is required
        ->setChangefreq('daily')
        ->setLastmod('2022-11-20 01:12:10')
        ->getData();

    $this->assertEquals($data, $this->data);
});

test('can generate static routes', function () {
    $path = $this->tmp . 'g.json';
    (new SiteMapGenerator())
        ->route(
            (new StaticRoute())
                ->setRouteName('products.list') // is required
                ->setPriority(1) // is required
                ->setChangefreq('daily')
                ->setLastmod('2022-11-20 01:12:10')
        )
        ->generate($path);

    $data = json_decode(file_get_contents($path), true);
    $this->assertEquals($data, $this->data);
});
