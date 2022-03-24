# payment product restriction
[![license](https://img.shields.io/github/license/fond-of-oryx/payment-product-restriction.svg)](https://packagist.org/packages/fond-of-oryx/payment-product-restriction)

## What it does

restriction on products for payment methods

## Installation

```
composer require fond-of-oryx/payment-product-restriction
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
        new PaymentProductRestrictionPaymentMethodFilterPlugin(),
    ];
}
```

add the following configuration to your config-file

```
$config[PaymentProductRestrictionConstants::BLACKLISTED_PRODUCT_SKU_PAYMENT_METHOD_COMBINATIONS] = [
    payment-method-name => [
        'SKU-ABC-001-002', // must only contain part of the sku
    ]
];
```
