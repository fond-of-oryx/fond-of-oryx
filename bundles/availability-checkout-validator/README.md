# Availability Checkout Validator
[![license](https://img.shields.io/github/license/fond-of-oryx/availability-checkout-validator.svg)](https://packagist.org/packages/fond-of-oryx/availability-checkout-validator)

Provides plugin for checkout flow. The plugin checks the quote items for availability and if the items are sellable. If some item is not available or sellable the customer gets redirected to the cart page.

## Installation

```
composer require fond-of-oryx/availability-checkout-validator
```

## Configuration

Register plugin ``AvailabilityCheckoutPreCheckPlugin`` in ``CheckoutDependencyProvider``

```
/**
     * @return \Spryker\Client\CheckoutExtension\Dependency\Plugin\CheckoutPreCheckPluginInterface[]
     */
    protected function getCheckoutPreCheckPlugins(): array
    {
        return [
            ...
            new AvailabilityCheckoutPreCheckPlugin(),
        ];
    }
```
