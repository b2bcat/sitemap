# Site map generator

[![Latest Version on Packagist](https://img.shields.io/packagist/v/b2bcat/test-sitemap.svg?style=flat-square)](https://packagist.org/packages/b2bcat/test-sitemap)
[![GitHub Tests Action Status](https://img.shields.io/github/workflow/status/b2bcat/test-sitemap/run-tests?label=tests)](https://github.com/b2bcat/test-sitemap/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/workflow/status/b2bcat/test-sitemap/Fix%20PHP%20code%20style%20issues?label=code%20style)](https://github.com/b2bcat/test-sitemap/actions?query=workflow%3A"Fix+PHP+code+style+issues"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/b2bcat/test-sitemap.svg?style=flat-square)](https://packagist.org/packages/b2bcat/test-sitemap)

## Installation

You can install the package via composer:

```bash
composer require b2bcat/sitemap
```

## Basic Usage

```php
use B2bcat\SiteMap\SiteMap;

$pages = [
    [
        'loc' => 'https://foo.me',
        'lastmod' => '2022-02-02 23.12.12',
        'priority' => 0.5,
        'changefreq' => 'daily' // hourly, daily, weekly
    ]   
];
$type = 'xml'; 
$path = '/var/www/site.ru/upload/sitemap.xml'

(new B2bcat\SiteMap(
    $pages,
    $type,
    $path
))
```

## Laravel Package





You can make the artisan command like this example:

```php
namespace App\Console\Commands;

use Illuminate\Console\Command;
use B2bcat\SiteMap\Laravel\SiteMapGenerator;
use B2bcat\SiteMap\Laravel\Generator\StaticRoute;
use B2bcat\SiteMap\Laravel\Generator\DynamicRoute;
use App\Models\Product;

class SiteMapGenerateCommand extends Command
{
    public $signature = 'sitemap:generate {file_type?}';

    public $description = 'Generate site map to file. Supported formats: xml, csv, json';

    public function handle (): int
    {
       $fileType = $this->hasArgument('file_type') ? $this->argument('file_type') : 'xml';
        
        (new SiteMapGenerator())
            ->route(
                (new StaticRoute())
                    ->setRouteName('products.list') // is required
                    ->setPriority(1) // is required
                    ->setChangefreq('daily')
                    ->setLastmod('2022-11-20 01:12:10')
            )
            ->route(
                (new DynamicRoute())
                    ->setRouteName('products.show') // is required
                    ->setQueryBuilder(Product::query()) // is required
                    ->setPriority(1)
                    ->setChangefreq('daily')
                    ->setLastmodField('updated_at')
            )
            ->generate(
                '/path/to/sitemap.' . $fileType
            );

        return self::SUCCESS;
    }
}

```
That command must be scheduled in the console kernel:

```php
// app/Console/Kernel.php
protected function schedule(Schedule $schedule)
{
    ...
    $schedule->command('sitemap:generate')->daily();
    ...
}
```

## Testing

```bash
composer test
```

## Credits

- [Sergey Sadikov](https://github.com/b2bcat)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
