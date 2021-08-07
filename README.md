# A bundle of helpers and utilities to facilitate a better development experience from project to project.

[![Latest Version on Packagist](https://img.shields.io/packagist/v/teofanis/laravel-utils.svg?style=flat-square)](https://packagist.org/packages/teofanis/laravel-utils)
[![GitHub Tests Action Status](https://img.shields.io/github/workflow/status/teofanis/laravel-utils/run-tests?label=tests)](https://github.com/teofanis/laravel-utils/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/workflow/status/teofanis/laravel-utils/Check%20&%20fix%20styling?label=code%20style)](https://github.com/teofanis/laravel-utils/actions?query=workflow%3A"Check+%26+fix+styling"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/teofanis/laravel-utils.svg?style=flat-square)](https://packagist.org/packages/teofanis/laravel-utils)

Utilities & Helpers to bring along on every project :) !
Feel free to contribue with your favorite snippets.

## Installation

You can install the package via composer:

```bash
composer require teofanis/laravel-utils
```

You can publish and run the migrations with:

```bash
php artisan vendor:publish --provider="Teofanis\LaravelUtils\LaravelUtilsServiceProvider" --tag="laravel-utils-migrations"
php artisan migrate
```

You can publish the config file with:
```bash
php artisan vendor:publish --provider="Teofanis\LaravelUtils\LaravelUtilsServiceProvider" --tag="laravel-utils-config"
```

This is the contents of the published config file:

```php
return [
];
```

## Usage

```php
$laravel-utils = new Teofanis\LaravelUtils();
echo $laravel-utils->echoPhrase('Hello, Spatie!');
```

## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](.github/CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [Teofanis Papadopulos](https://github.com/teofanis)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
