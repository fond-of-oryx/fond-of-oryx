# Gift Card Proportional Value Payone Connector Module
[![CI](https://github.com/fond-of-oryx/gift-card-proportional-value-payone-connector/actions/workflows/main.yml/badge.svg)](https://github.com/fond-of-oryx/gift-card-proportional-value-payone-connector/actions/workflows/main.yml)
[![license](https://img.shields.io/github/license/fond-of-oryx/gift-card-proportional-value-payone-connector.svg)](https://packagist.org/packages/fond-of-oryx/gift-card-proportional-value-payone-connector)

In our case, we need the proportional gift card values for every item in order, if a gift card was redeemed. For orders paid with payone and redeemed gift card, the `spryker-eco/payone` split the gift card amount proportional to the item amounts.
For example you made an order with three items, each item has a total price of 39,90 Euro and you use a 20 Euro gift card. The amount of 20 Euro will be split by 33,3333333%. One proportional amount will be 6,66 Euro and two times 6,67 Euro.
Another example you buy two items, one item 10 Euro and one item 30 Euro and you use a 20 Euro gift card. The proportional amount for this would be 5 Euro for the 10 Euro item and 15 Euro for the 30 Euro item.

For this, we use the calculation from the spryker-eco/payone package but had to create a fork (https://github.com/fond-of/payone/tree/feature/add-service) and make the calculation accessible from outside. A PR is also open (https://github.com/spryker-eco/payone/pull/81) and we hope they will accept it soon.
At the moment, this package requires the fork!

This package provides a calculation plugin for the `fond-of-oryx/gift-card-proportional-value`.

## Installation

```
...
"repositories": [
    {
      "type": "vcs",
      "url": "https://github.com/fond-of/payone"
    }
  ],
  "require": {
    ...
    "spryker-eco/payone": "dev-master-fondof as 4.4.2",
    ...
   },
   ...
...


composer require fond-of-oryx/gift-card-proportional-value-payone-connector
```

## Configuration

```
<?php

namespace Pyz\Zed\GiftCardProportionalValue;

use FondOfOryx\Zed\GiftCardProportionalValue\GiftCardProportionalValueDependencyProvider as FooGiftCardProportionalValueDependencyProvider;
use FondOfOryx\Zed\GiftCardProportionalValuePayoneConnector\Communication\Plugin\GiftCardProportionalValue\PayoneProportionalValueCalculationPlugin;

class GiftCardProportionalValueDependencyProvider extends FooGiftCardProportionalValueDependencyProvider
{
    /**
     * @return array|\FondOfOryx\Zed\GiftCardProportionalValueExtension\Dependency\Plugin\ProportionalValueCalculationPluginInterface[]
     */
    protected function getProportionalValueCalulationPlugins(): array
    {
        $plugins = [
            new PayoneProportionalValueCalculationPlugin(),
        ];

        return array_merge(parent::getProportionalValueCalulationPlugins(), $plugins);
    }

}
```
