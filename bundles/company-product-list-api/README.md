# Company Product List API Module
[![license](https://img.shields.io/github/license/mashape/apistatus.svg)](https://packagist.org/packages/fond-of-oryx/stock-product-api)

The CompanyProductListApi module provides a REST API for company product list create/updates.

## Installation

```
composer require fond-of-oryx/company-product-list-api
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
            new CompanyProductListApiResourcePlugin(),
        ];
    }

```

##### POST /api/rest/company-product-lists

##### Example

```sh
curl -X POST "http://zed.yourdomain.com/api/rest/company-product-lists/" \
     -H 'Content-Type: application/json' \
     -d $'{
          "data": {
            "fk_company": "1",
            "product_list_ids": "[1]",
          }
     }'
```
