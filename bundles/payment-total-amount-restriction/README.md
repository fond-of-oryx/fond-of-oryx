# payment total amount restriction
[![license](https://img.shields.io/github/license/fond-of-oryx/payment-total-amount-restriction.svg)](https://packagist.org/packages/fond-of-oryx/payment-total-amount-restriction)

## What it does

restriction maximum allowed total amount for payment methods

## Installation

```
composer require fond-of-oryx/payment-total-amount-restriction
```

## Usage

register the plugin in your dependency provider

i.E.: Pyz\Zed\Payment\PaymentDependencyProvider.php

```
/**
 * @return array<int, \Spryker\Zed\PaymentExtension\Dependency\Plugin\PaymentMethodFilterPluginInterface>|array<int, \Spryker\Zed\Payment\Dependency\Plugin\Payment\PaymentMethodFilterPluginInterface>
 */
protected function getPaymentMethodFilterPlugins(): array
{
    return [
        ...,
        new TotalAmountRestrictionPaymentMethodFilterPlugin(),
    ];
}
```

add the following configuration to your config-file

```
$config[PaymentTotalAmountRestrictionConstants::TOTAL_AMOUNT_RESTRICTED_PAYMENT_METHOD_COMBINATIONS] = [
    'payment-method-name => 500000 // max amount 500.00
];
```
