# Gift Card Payment Connector
[![PHP from Travis config](https://img.shields.io/travis/php-v/symfony/symfony.svg)](https://php.net/)
[![license](https://img.shields.io/github/license/mashape/apistatus.svg)](https://packagist.org/packages/fond-of-oryx/gift-card-payment-connector)

## Description

Module provides a configuration for payment methods that are NOT available within gift-cart as payment-method.

## Installation
```
composer require fond-of-oryx/gift-card-payment-connector
```

## Configuration

Register GiftCardPaymentConnectorPaymentMethodFilterPlugin in your PaymentDependencyProvider at getPaymentMethodFilterPlugins()

```
/**
 * @return \Spryker\Zed\PaymentExtension\Dependency\Plugin\PaymentMethodFilterPluginInterface[]
 */
protected function getPaymentMethodFilterPlugins(): array
{
    return [
        new GiftCardPaymentConnectorPaymentMethodFilterPlugin(),
    ];
}
```

After that you need to configure which payment-method you want to block while using gift-card as payment-method i.e.

```
$config[GiftCardPaymentConnectorConstants::NOT_ALLOWED_PAYMENT_METHODS] = [
    'prepaymentPrepayment',
];
```


