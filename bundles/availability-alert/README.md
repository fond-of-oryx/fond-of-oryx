# Availability Module
[![PHP from Travis config](https://img.shields.io/travis/php-v/symfony/symfony.svg)](https://php.net/)
[![license](https://img.shields.io/github/license/mashape/apistatus.svg)](https://packagist.org/packages/fond-of-oryx/availability-alert)

## Installation

```
composer require fond-of-oryx/availability-alert
```

## Configuration

Register

* in src/Pyz/Yves/ShopApplication/ShopApplicationDependencyProvider.php => AvailabilityAlertFormWidget::class

```
    /**
     * @return string[]
     */
    protected function getGlobalWidgets(): array
    {
        return [
            ...
            AvailabilityAlertFormWidget::class,
        ];
    }
```

* in src/Pyz/Yves/Router/RouterDependencyProvider.php => AvailabilityAlertControllerProviderPlugin

```
    /**
     * @return \Spryker\Yves\RouterExtension\Dependency\Plugin\RouteProviderPluginInterface[]
     */
    protected function getRouteProvider(): array
    {
        return [
            ...
            new AvailabilityAlertControllerProviderPlugin(),
        ];
    }
```

## Usage

Use widget in template

```
{% widget 'AvailabilityAlertFormWidget' args [data.product.idProductAbstract] %}{% endwidget %}
```
