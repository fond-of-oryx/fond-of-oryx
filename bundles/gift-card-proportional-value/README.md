# Gift Card Proportional Value Module
[![CI](https://github.com/fond-of-oryx/gift-card-proportional-value/actions/workflows/main.yml/badge.svg)](https://github.com/fond-of-oryx/gift-card-proportional-value/actions/workflows/main.yml)
[![license](https://img.shields.io/github/license/fond-of-oryx/gift-card-proportional-value.svg)](https://packagist.org/packages/fond-of-oryx/gift-card-proportional-value)

This package will install a new table foo_proportional_gift_card_value. By default this module only provides table and functionality to execute plugins and do nothing without plugins.

Possible plugins will be provided in
- "fond-of-oryx/gift-card-proportional-value-no-payment-connector"
- "fond-of-oryx/gift-card-proportional-value-payone-connector"

and could be used like this

```
<?php

namespace Pyz\Zed\GiftCardProportionalValue;

use FondOfOryx\Zed\GiftCardProportionalValue\GiftCardProportionalValueDependencyProvider as FooGiftCardProportionalValueDependencyProvider;
use FondOfOryx\Zed\GiftCardProportionalValueNoPaymentConnector\Communication\Plugin\GiftCardProportionalValue\NoPaymentProportionalValueCalculationPlugin;
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
            new NoPaymentProportionalValueCalculationPlugin(),
        ];

        return array_merge(parent::getProportionalValueCalulationPlugins(), $plugins);
    }

}
```

## Installation

```
composer require fond-of-oryx/gift-card-proportional-value
```

## Configuration

Inject GiftCardProportionalValue command and condition into OMS. Add in config_default.php

```
$config[KernelConstants::DEPENDENCY_INJECTOR_ZED] = [
    'Payment' => [
        ...
    ],
    'Oms' => [
        ...
        'GiftCardProportionalValue',
    ],
];
```

Another way is to add them manually in pyz OmsDependencyProvider

```
    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    public function provideBusinessLayerDependencies(Container $container)
    {
        $container = parent::provideBusinessLayerDependencies($container);

        $container->extend(static::CONDITION_PLUGINS, static function (ConditionCollectionInterface $conditionCollection) {
            ...
            $conditionCollection->add(new HasRedeemedGiftCardsConditionPlugin(), 'GiftCardProportionalValue/HasRedeemedGiftCards');

            return $conditionCollection;
        });

        $container->extend(self::COMMAND_PLUGINS, static function (CommandCollectionInterface $commandCollection) {
            ...
            $commandCollection->add(new GiftCardProportionalValueCalculatorCommandPlugin(), 'GiftCardProportionalValue/CalculateProportionalValues');

            return $commandCollection;
        });

        return $container;
    }
```

### Update the oms workflow

with something like this.

GiftCardProportionalValue01.xml in config\zed\oms
```
<?xml version="1.0"?>
<statemachine
    xmlns="spryker:oms-01"
    xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
    xsi:schemaLocation="spryker:oms-01 http://static.spryker.com/oms-01.xsd"
>

    <process name="GiftCardProportionalValue01">
        <states>
            <state name="calculate proportional gift card values" display="oms.state.calculate-gift-card-proportional-values"/>
            <state name="gift card proportional values calculated" display="oms.state.gift-card-proportional-values-calculated"/>
        </states>

        <transitions>
            <transition condition="GiftCardProportionalValue/HasRedeemedGiftCards">
                <source>order confirmation sent</source>
                <target>calculate proportional gift card values</target>
                <event>wait for export</event>
            </transition>

            <transition>
                <source>calculate proportional gift card values</source>
                <target>gift card proportional values calculated</target>
                <event>calculate gift card proportional values</event>
            </transition>

            <transition>
                <source>gift card proportional values calculated</source>
                <target>export pending</target>
                <event>wait for export</event>
            </transition>

        </transitions>

        <events>
            <event name="calculate gift card proportional values" onEnter="true" command="GiftCardProportionalValue/CalculateProportionalValues"/>
            <event name="wait for export" onEnter="true"/>
        </events>
    </process>
</statemachine>

```

but keep in mind that this should be edited with you states and events!
