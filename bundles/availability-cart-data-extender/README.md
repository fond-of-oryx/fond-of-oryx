# Availability Cart Data Extender
[![license](https://img.shields.io/github/license/fond-of-oryx/availability-cart-data-extender.svg)](https://packagist.org/packages/fond-of-oryx/availability-cart-data-extender)

This package provides
- a plugin to add the availability and the isSellable state to the items in quote
- a plugin for adding the product name to the error message if one or more items are not sellable or available anymore.

It also provides a new

## Installation

```
composer require fond-of-oryx/availability-cart-data-extender
```

## Configuration

Register plugin ``AddAvailabilityDataToQuoteItemQuoteChangeObserverPlugin`` in zed  ``CartDependencyProvider``

```
/**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\CartExtension\Dependency\Plugin\QuoteChangeObserverPluginInterface[]
     */
    protected function getQuoteChangeObserverPlugins(Container $container): array
    {
        return [
            ...
            new AddAvailabilityDataToQuoteItemQuoteChangeObserverPlugin(),
        ];
    }
```

If you want the product name in error message too, replace the spryker ``CheckAvailabilityPlugin`` with the delivered plugin with same name in ``src/Pyz/Client/Checkout/CheckoutDependencyProvider.php``

from
``use Spryker\Zed\AvailabilityCartConnector\Communication\Plugin\CheckAvailabilityPlugin;``
to
``use FondOfOryx\Zed\AvailabilityCartDataExtender\Communication\Plugin\CheckAvailabilityPlugin;``

```
    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Cart\Dependency\CartPreCheckPluginInterface[]
     */
    protected function getCartPreCheckPlugins(Container $container)
    {
        return [
            ...
            new CheckAvailabilityPlugin(),
            ...
        ];
    }
```
