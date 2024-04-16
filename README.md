# Validate and analyse Blade templates in your Laravel project.

[![Latest Version on Packagist](https://img.shields.io/packagist/v/ryangjchandler/blade-lint.svg?style=flat-square)](https://packagist.org/packages/ryangjchandler/blade-lint)
[![GitHub Tests Action Status](https://img.shields.io/github/actions/workflow/status/ryangjchandler/blade-lint/run-tests.yml?branch=main&label=tests&style=flat-square)](https://github.com/ryangjchandler/blade-lint/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/actions/workflow/status/ryangjchandler/blade-lint/fix-php-code-style-issues.yml?branch=main&label=code%20style&style=flat-square)](https://github.com/ryangjchandler/blade-lint/actions?query=workflow%3A"Fix+PHP+code+style+issues"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/ryangjchandler/blade-lint.svg?style=flat-square)](https://packagist.org/packages/ryangjchandler/blade-lint)

Blade Lint provides a set of tools for linting Blade templates. It comes with a set of default rules, as well as APIs for writing your own custom rules. Under the hood, it is powered by the excellent [`blade-parser`](https://stillat.com/blade-parser) package.

> This package is not designed to format Blade templates. If you're looking for a Blade formatter, use [Pint](https://laravel.com/docs/pint) instead.

## Installation

You can install the package via Composer:

```bash
composer require ryangjchandler/blade-lint
```

Setup Blade Lint inside of your project:

```sh
php artisan install:blade-lint
```

## Usage

This package provides a single `blade:lint` command. 

```sh
php artisan blade:lint
```

This will validate the syntax and run all registered `Rule` classes against the files found in your project.

To configure which rules run, modify the `rules` array inside of the `config/blade-lint.php` file.

> For a full list of available rules, check the [Rules](#rules) section.

```php
use RyanChandler\BladeLint\Rules;

return [

    'rules' => [
        Rules\VerifyDirectivePairs::class,
        Rules\DisallowRawEcho::class,
        Rules\VerifyForelseHasEmpty::class,
        // Register your custom rules here...
    ],

];
```

### Rules

This package provides a set of useful rules out of the box. Use the table below to find a rule and an example of what it does.

> Coming soon.

### Custom Rules

Writing your own custom rules can be a really powerful way of improving your code quality.

Start by creating a class that implements `RyanChandler\BladeLint\Rules\Rule`.

```php
namespace App\Linting\Rules;

use RyanChandler\BladeLint\Rules\Rule;
use RyanChandler\BladeLint\ErrorCollector;
use Stillat\BladeParser\Nodes\AbstractNode;

class MyCustomRule implements Rule
{
    public function check(AbstractNode $node, ErrorCollector $errorCollector): void
    {
        //
    }

    public function getRuleId(): string
    {
        return 'internal.my-custom-rule';
    }
}
```

The `check()` method is used to validate a single node. For more information on the structure of a `Node`, consult the [Blade parser](https://stillat.com/blade-parser/v1/getting-started) documentation.

The `getRuleId()` method is used to specify the "readable" name for a rule. This allows you to ignore or silence the rule in certain places throughout your Blade templates.

```blade
{!! $html !!} {{-- @lint:ignore internal.my-custom-rule --}}
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

- [Ryan Chandler](https://github.com/ryangjchandler)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
