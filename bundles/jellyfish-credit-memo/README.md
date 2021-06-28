# JellyfishCreditMemo Extension Module
[![license](https://img.shields.io/github/license/mashape/apistatus.svg)](https://packagist.org/packages/fond-of-oryx/jellyfish-credit-memo)

## Installation

```
composer require fond-of-oryx/jellyfish-credit-memo
```

## Configuration

Inject JellyfishCreditMemo command and condition into OMS. Add in config_default.php

```
$config[KernelConstants::DEPENDENCY_INJECTOR_ZED] = [
    'Payment' => [
        ...
    ],
    'Oms' => [
        ...
        'JellyfishCreditMemo',
    ],
];
```
