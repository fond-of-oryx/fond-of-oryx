# Stock API Module
[![license](https://img.shields.io/github/license/mashape/apistatus.svg)](https://packagist.org/packages/fond-of-oryx/stock-api)

The StockApi module provides a REST API for simple stock operations.

Package is ported and splitted from `fond-of-spryker/stock-api`

For creating and updating product stocks, please use `fond-of-oryx/stock-product-api`

## Installation

```
composer require fond-of-oryx/stock-api
```

## API

### Get stock data by id

##### GET /stocks/{id_stock}

##### Example

```sh
curl -X GET "http://zed.yourdomain.com/api/rest/stocks/{id_stock}" \
     -H 'Content-Type: application/json'
```

### find stock data

##### GET /stocks?filter={"condition":"AND","rules":[{"id":"name","field":"name","type":"string","input":"text","operator":"equal","value":"EU"},{"id":"is_active","field":"is_active","type":"bool","input":"bool","operator":"equal","value":true}]}

##### Example

```sh
curl -X GET "http://zed.yourdomain.com/api/rest/stocks?filter={"condition":"AND","rules":[{"id":"name","field":"name","type":"string","input":"text","operator":"equal","value":"EU"},{"id":"is_active","field":"is_active","type":"bool","input":"bool","operator":"equal","value":true}]}" \
     -H 'Content-Type: application/json'
```
