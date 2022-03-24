# payment address restriction
[![license](https://img.shields.io/github/license/fond-of-oryx/payment-address-restriction.svg)](https://packagist.org/packages/fond-of-oryx/payment-address-restriction)

## What it does

## Installation

```
composer require fond-of-oryx/payment-address-restriction
```

## Usage

register the plugins in your dependency provider

i.E.: Pyz\Zed\Payment\PaymentDependencyProvider.php

```
/**
 * @return array<int, \Spryker\Zed\PaymentExtension\Dependency\Plugin\PaymentMethodFilterPluginInterface>|array<int, \Spryker\Zed\Payment\Dependency\Plugin\Payment\PaymentMethodFilterPluginInterface>
 */
protected function getPaymentMethodFilterPlugins(): array
{
    return [
        ...,
        new CountryRestrictionPaymentMethodFilterPlugin(),
        new IdenticalAddressRestrictionPaymentMethodFilterPlugin(),
    ];
}
```

add the following configuration to your config-file

```
$config[PaymentAddressRestrictionConstants::BLACKLISTED_PAYMENT_COUNTRY_COMBINATIONS] = [
    'payment-method-name' => ['DE', 'AT', 'CH'], // payment method only allowed for DE, AT, CH
];

$config[PaymentAddressRestrictionConstants::BLACKLISTED_PAYMENT_IDENTICAL_ADDRESS_REQUIRED] = [
    'payment-method-name' // shipping- and billing address must equal
];
```
