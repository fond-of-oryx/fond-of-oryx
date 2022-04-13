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

first, configure the product attribute where the blacklisted payment methods are stored

```
$config[PaymentProductRestrictionConstants::BLACKLISTED_PAYMENT_METHODS_PRODUCT_ATTRIBUTE] = 'blacklisted_payment_methods';
```

Next, you need a mapping from the product-attribute to the concrete payment-method in your store

```

$config[PaymentProductRestrictionConstants::MAPPING_BLACKLISTED_PAYMENT_METHODS] = [
    'invoice' => 'payoneSecurityInvoice'
];
```

Array key invoice is the attribute from your product, array value the concrete payment-method
