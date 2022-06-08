# Product Payment Restriction
[![license](https://img.shields.io/github/license/fond-of-oryx/product-payment-restriction.svg)](https://packagist.org/packages/fond-of-oryx/product-payment-restriction)

## What it does

restriction on products for payment methods

## Installation

```
composer require fond-of-oryx/product-payment-restriction
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
        new ProductPaymentRestrictionPaymentMethodFilterPlugin(),
    ];
}
```

add the following configuration to your config-file

```
$config[ProductPaymentRestrictionConstants::BLACKLISTED_PAYMENT_METHODS_PRODUCT_ATTRIBUTE] = 'blacklisted_payment_methods';
```

The attribute where the blacklisted payment methods are stored is expected a comma separated list. The list should contain the specific payment methods from the shop that are not permitted for the product.

####Example
```
$product = [
    'abstract_attributes' => [
        '_' => [
            'blacklisted_payment_methods' => 'invoice',
        ]
    ]
]
```
