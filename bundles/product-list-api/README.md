# Product List API Module
[![license](https://img.shields.io/github/license/mashape/apistatus.svg)](https://packagist.org/packages/fond-of-oryx/stock-product-api)

The ProductListApi module provides a REST API for product list updates.

Package ported from `fond-of-oryx/product-list-api`

## Installation

```
composer require fond-of-oryx/product-list-api
```

#### Register Plugins in `ApiDependencyProvider`

```
    /**
     * @return \Spryker\Zed\Api\Dependency\Plugin\ApiResourcePluginInterface[]
     */
    protected function getApiResourcePluginCollection(): array
    {
        return [
            ...
            new ProductListApiResourcePlugin(),
        ];
    }

```
