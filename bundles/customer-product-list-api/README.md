# Customer Product List API Module
[![license](https://img.shields.io/github/license/mashape/apistatus.svg)](https://packagist.org/packages/fond-of-oryx/stock-product-api)

The CustomerProductListApi module provides a REST API for customer product list create/updates.

## Installation

```
composer require fond-of-oryx/customer-product-list-api
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
            new CustomerProductListApiResourcePlugin(),
        ];
    }

```

##### POST /api/rest/customer-product-lists

##### Example

```sh
curl -X POST "http://zed.yourdomain.com/api/rest/customer-product-lists/" \
     -H 'Content-Type: application/json' \
     -d $'{
          "data": {
            "fk_customer": "1",
            "product_list_ids": "[1]",
          }
     }'
```
