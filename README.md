# By using this standalone package, you can convert numeric values into words in English based on Bangladeshi numeric counting (lakh-crore)

[![Latest Version on Packagist](https://img.shields.io/packagist/v/devtarekmia/spell-money.svg?style=flat-square)](https://packagist.org/packages/devtarekmia/spell-money)
[![Tests](https://img.shields.io/github/actions/workflow/status/devtarekmia/spell-money/run-tests.yml?branch=main&label=tests&style=flat-square)](https://github.com/devtarekmia/spell-money/actions/workflows/run-tests.yml)
[![Total Downloads](https://img.shields.io/packagist/dt/devtarekmia/spell-money.svg?style=flat-square)](https://packagist.org/packages/devtarekmia/spell-money)

Specifically tailored for the Bangladeshi numeric system, which includes units such as lakh and crore, this package offers a comprehensive solution for converting numeric values into their word equivalents in English. In addition to handling integer and decimal parts seamlessly, it also ensures grammatically accurate outputs. Designed for ease of use, the package integrates seamlessly into any PHP project, including Laravel applications. For developers creating financial documents, invoices, and reports requiring numbers to be presented as words, it's a reliable tool.

## Installation

You can install the package via composer:

```bash
composer require devtarekmia/spell-money
```

## Usage

```php

use TarekMia\SpellMoney\SpellMoney;


$spellMoney = new SpellMoney();

$spellMoney->spell(4586); // four thousand five hundred and eighty six taka
$spellMoney->spell(25.85); // twenty five taka and eighty five paisa

// example of big values
$spellMoney->spell(548752154836.52); // eight hundred seventy five crore twenty one lakh fifty four thousand eight hundred thirty six taka and fifty two paisa
```

## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](https://github.com/spatie/.github/blob/main/CONTRIBUTING.md) for details.

## Credits

- [Tarek Mia](https://github.com/devtarekmia)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
