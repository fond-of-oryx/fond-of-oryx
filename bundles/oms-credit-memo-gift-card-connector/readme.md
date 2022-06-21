# Oms Credit Memo Gift Card Connector
[![CI](https://github.com/fond-of-oryx/oms-credit-memo-gift-card-connector/actions/workflows/main.yml/badge.svg)](https://github.com/fond-of-oryx/oms-credit-memo-gift-card-connector/actions/workflows/main.yml)
[![license](https://img.shields.io/github/license/mashape/apistatus.svg)](https://packagist.org/packages/fond-of-oryx/oms-credit-memo-gift-card-connector)

## Install

```
composer require fond-of-oryx/oms-credit-memo-gift-card-connector
```

## Configuration

Register `PartialGiftCardRefundCommandPlugin` and `RefundHasGiftCardsConditionPlugin` in Pyz `OmsDependencyProvider`
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
            $conditionCollection->add(new RefundHasGiftCardsConditionPlugin(), 'GiftCardCreditMemo/hasGiftCards');

            return $conditionCollection;
        });

        $container->extend(self::COMMAND_PLUGINS, static function (CommandCollectionInterface $commandCollection) {
            ...
            $commandCollection->add(new PartialGiftCardRefundCommandPlugin(), 'GiftCard/Refund');

            return $commandCollection;
        });

        return $container;
    }
```

and use them in state machine configuration like for example

```
<?xml version="1.0"?>
<statemachine
    xmlns="spryker:oms-01"
    xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
    xsi:schemaLocation="spryker:oms-01 http://static.spryker.com/oms-01.xsd"
>

    <process name="GiftCardRefund01">
        <states>
            <state name="gift card refund available" display="oms.state.refund-has-gift-cards"/>
            <state name="gift cards refunded" display="oms.state.gift-cards-refunded"/>
        </states>

        <transitions>
            <transition condition="GiftCardCreditMemo/hasGiftCards">
                <source>payone payment refunded</source>
                <target>gift card refund available</target>
                <event>wait for export</event>
            </transition>

            <transition>
                <source>gift card refund available</source>
                <target>gift cards refunded</target>
                <event>refund gift cards</event>
            </transition>

            <transition>
                <source>gift cards refunded</source>
                <target>export refund to jelly</target>
            </transition>

        </transitions>

        <events>
            <event name="refund gift cards" onEnter="true" command="GiftCard/Refund"/>
            <event name="wait for export" onEnter="true"/>
        </events>
    </process>
</statemachine>
```
