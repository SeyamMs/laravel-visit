# Laravel package for counting model visits

[![Latest Version on Packagist](https://img.shields.io/packagist/v/seyamms/laravel-visit.svg?style=flat-square)](https://packagist.org/packages/seyamms/laravel-visit)
[![GitHub Tests Action Status](https://img.shields.io/github/actions/workflow/status/seyamms/laravel-visit/run-tests.yml?branch=main&label=tests&style=flat-square)](https://github.com/seyamms/laravel-visit/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/actions/workflow/status/seyamms/laravel-visit/fix-php-code-style-issues.yml?branch=main&label=code%20style&style=flat-square)](https://github.com/seyamms/laravel-visit/actions?query=workflow%3A"Fix+PHP+code+style+issues"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/seyamms/laravel-visit.svg?style=flat-square)](https://packagist.org/packages/seyamms/laravel-visit)

This package is intended to count visits of model records with some sort of uniqueness factors (see the config file).

## Installation

You can install the package via composer:

```bash
composer require seyamms/laravel-visit
```

You can publish and run the migrations with:

```bash
php artisan vendor:publish --tag="laravel-visit-migrations"
php artisan migrate
```

You can publish the config file with:

```bash
php artisan vendor:publish --tag="laravel-visit-config"
```

After publishing the config you will have visit.php in your config directory the contains these options:

```php
/**
 * available factors are:
 * ['ip_address', 'platform', 'device', 'browser', 'language']
 * default: ['ip_address', 'platform']
 */
'factors' => [
    'ip_address',
    'platform',
    // 'device',
    // 'browser',
    // 'language',
],


// this accepts a valid carbon interval. 
// 1 day, 2 days, 1 week, 2 months ...etc
// default: 1 day 
'span' => '1 day',
```

## Usage

just add Visitable trait to your model

```php
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use SeyamMs\LaravelVisit\Traits\Visitable;

class Page extends Model
{
    use Visitable;
```

then you will have access to vzt() on each record that you can use to get the total visits count to that model or increment the counter upon page loading.

```php
$page->vzt()->increment();
```

```php
$page->vzt()->count()
```

## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

-   [Mohammed Seyam](https://github.com/SeyamMs)
-   [All Contributors](../../contributors)
-   Special thanks to [Spatie](https://github.com/spatie) Team

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
