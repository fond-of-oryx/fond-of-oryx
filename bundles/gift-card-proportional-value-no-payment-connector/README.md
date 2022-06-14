# Gift Card Proportional Value No Payment Connector Module
[![CI](https://github.com/fond-of-oryx/gift-card-proportional-value-no-payment-connector/actions/workflows/main.yml/badge.svg)](https://github.com/fond-of-oryx/gift-card-proportional-value-no-payment-connector/actions/workflows/main.yml)
[![license](https://img.shields.io/github/license/fond-of-oryx/gift-card-proportional-value-no-payment-connector.svg)](https://packagist.org/packages/fond-of-oryx/gift-card-proportional-value-no-payment-connector)

In our case, we need the proportional gift card values for every item in order, if a gift card was redeemed. Completely paid orders with gift cards will be handled in our case as paid orders and uses the no payment workflow.

This package provides a calculation plugin for the `fond-of-oryx/gift-card-proportional-value` package and sets the item amount as proportional value for orders with payment method paid.

## Installation

```
composer require fond-of-oryx/gift-card-proportional-value-no-payment-connector
```

## Configuration

```
<?php

namespace Pyz\Zed\GiftCardProportionalValue;

use FondOfOryx\Zed\GiftCardProportionalValue\GiftCardProportionalValueDependencyProvider as FooGiftCardProportionalValueDependencyProvider;
use FondOfOryx\Zed\GiftCardProportionalValueNoPaymentConnector\Communication\Plugin\GiftCardProportionalValue\NoPaymentProportionalValueCalculationPlugin;

class GiftCardProportionalValueDependencyProvider extends FooGiftCardProportionalValueDependencyProvider
{
    /**
     * @return array|\FondOfOryx\Zed\GiftCardProportionalValueExtension\Dependency\Plugin\ProportionalValueCalculationPluginInterface[]
     */
    protected function getProportionalValueCalulationPlugins(): array
    {
        $plugins = [
            ...
            new NoPaymentProportionalValueCalculationPlugin(),
        ];

        return array_merge(parent::getProportionalValueCalulationPlugins(), $plugins);
    }

}
```
