# fond-of-oryx/payone-credit-memo
[![license](https://img.shields.io/github/license/mashape/apistatus.svg)](https://packagist.org/packages/fond-of-oryx/payone-credit-memo)

## Install

```
composer require fond-of-oryx/payone-credit-memo
```

## Configuration

Add PartialRefundCommandPlugin to OmsDependencyProvider

```
    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    public function provideBusinessLayerDependencies(Container $container)
    {
        ...

        $container->extend(self::COMMAND_PLUGINS, static function (CommandCollectionInterface $commandCollection) {
            ...
            $commandCollection->add(new PartialRefundCommandPlugin(), 'Payone/Refund');
            ...

            return $commandCollection;
        });

        return $container;
    }
```
