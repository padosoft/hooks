# hooks
Padosoft git hooks

[![Latest Version on Packagist][ico-version]][link-packagist]
[![Software License][ico-license]](LICENSE.md)
[![Total Downloads][ico-downloads]][link-downloads]

Table of Contents
=================

  * [hooks](#hooks)
  * [Table of Contents](#table-of-contents)
  * [Prerequisites](#prerequisites)
  * [Install](#install)
  * [Usage](#usage)
  * [Example](#example)
  * [Screenshots](#screenshots)
  * [Change Log](#change-log)
  * [Testing](#testing)
  * [Contributing](#contributing)
  * [Security](#security)
  * [API Documentation](#api-documentation)
  * [Credits](#credits)
  * [About Padosoft](#about-padosoft)
  * [License](#license)

# Prerequisites

# Install

This package can be installed through Composer.

``` bash
composer require padosoft/hooks
```

If you install in a laravel project add in config->app.php the following value in service providers array:

Padosoft\Hooks\HooksServiceProvider::class,

then use php artisan vendor:publish

In a non-laravel project you must copy the .php_cs file from vendor/padosoft/hooks/src/config to the root of project,
and the pre-commit file from vendor/padosoft/hooks/src/config to .git/hooks folder.
If you want customize the static-review operation create hooks folder in the root of project then copy pre-commit.php
file from vendor/padosoft/static-review/src/config/pre-commit.php.

Be careful in a linux or mac environment change

php.exe "vendor/padosoft/hooks/src/php-cs-fix.php"
php.exe "vendor/padosoft/hooks/src/static-review-pre-commit.php"

in the .git/hooks/pre-commit file to

php "vendor/padosoft/hooks/src/php-cs-fix.php"
php "vendor/padosoft/hooks/src/static-review-pre-commit.php"

# Usage

Pre-commit git hook is invoked by git commit. Exiting with non-zero status from this script causes the git commit to abort.
Can be bypassed with --no-verify option.


## Example

# Screenshots

# Change Log
Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

# Testing

# Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) and [CONDUCT](CONDUCT.md) for details.

# Security

If you discover any security related issues, please email  instead of using the issue tracker.

# API Documentation

# Credits

- [Padosoft](https://github.com/padosoft)
- [All Contributors](../../contributors)

# About Padosoft
Padosoft is a software house based in Florence, Italy. Specialized in E-commerce and web sites.

# License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.


[ico-version]: https://img.shields.io/packagist/v/padosoft/hooks.svg?style=flat-square
[ico-license]: https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square
[ico-downloads]: https://img.shields.io/packagist/dt/padosoft/hooks.svg?style=flat-square

[link-packagist]: https://packagist.org/packages/padosoft/hooks
[link-downloads]: https://packagist.org/packages/padosoft/hooks
