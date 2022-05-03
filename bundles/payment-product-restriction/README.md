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
$config[PaymentProductRestrictionConstants::BLACKLISTED_PAYMENT_METHODS_PRODUCT_ATTRIBUTE] = 'blacklisted_payment_methods';
```

The attribute where the blacklisted payment methods are stored is expected to be an array. The array should contain the specific payment methods from the shop that are not permitted for the product.

####Example
```
$product = [
    'abstract_attributes' => [
        '_' => [
            'blacklisted_payment_methods' => ['invoice']
        ]
    ]
]
```
