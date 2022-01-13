# Stock Product API Module
[![license](https://img.shields.io/github/license/mashape/apistatus.svg)](https://packagist.org/packages/fond-of-oryx/stock-product-api)

The StockProductApi module provides a REST API for simple product stock updates.

Package ported from `fond-of-spryker/stock-api`

## Installation

```
composer require fond-of-oryx/stock-product-api
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
            new StockProductApiResourcePlugin(),
        ];
    }

    /**
     * @return \Spryker\Zed\Api\Dependency\Plugin\ApiValidatorPluginInterface[]
     */
    protected function getApiValidatorPluginCollection(): array
    {
        return [
            ...
            new StockProductApiValidatorPlugin(),
        ];
    }
```

## API

### Update stock of a concrete product. `sku`, `stock_type`, and `quantity` are mandatory fields.

##### PATCH /api/rest/stock-products/{id_stock_product}

##### Example

```sh
curl -X PATCH "http://zed.yourdomain.com/api/rest/stock-products/{id_stock_product}" \
     -H 'Content-Type: application/json' \
     -d $'{
          "data": {
            "sku": "SKU",
            "stock_type": "EU",
            "quantity": 10,
            "is_never_out_of_stock": true
          }
     }'
```

### Create stock of a concrete product. `sku`, `stock_type`, and `quantity` are mandatory fields.

##### POST /api/rest/stock-products

##### Example

```sh
curl -X POST "http://zed.yourdomain.com/api/rest/stock-products" \
     -H 'Content-Type: application/json' \
     -d $'{
          "data": {
            "sku": "SKU",
            "stock_type": "EU",
            "quantity": 10,
            "is_never_out_of_stock": true
          }
     }'
```

### Find stock concrete product by `sku` and `stock_type` (name)

##### GET /api/rest/stock-products?filter={"condition":"AND","rules":[{"id":"name","field":"name","type":"string","input":"text","operator":"equal","value":"EU"},{"id":"sku","field":"sku","type":"string","input":"text","operator":"equal","value":"SKU"}]}

##### Example

```sh
curl -X GET "http://zed.yourdomain.com/api/rest/stock-products?filter=$'{"condition":"AND","rules":[{"id":"name","field":"name","type":"string","input":"text","operator":"equal","value":"EU"},{"id":"sku","field":"sku","type":"string","input":"text","operator":"equal","value":"SKU"}]}'" \
     -H 'Content-Type: application/json'
```

### Get stock product by idStockProduct

##### GET /api/rest/stock-products/{id_stock_product}

##### Example

```sh
curl -X GET "http://zed.yourdomain.com/api/rest/stock-products/{id_stock_product}" \
     -H 'Content-Type: application/json'
```
