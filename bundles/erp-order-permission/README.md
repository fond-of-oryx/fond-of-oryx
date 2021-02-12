# ERP Order
[![Build Status](https://travis-ci.org/fond-of-oryx/erp-order-permission.svg?branch=master)](https://travis-ci.org/fond-of-oryx/erp-order-permission)
[![PHP from Travis config](https://img.shields.io/travis/php-v/symfony/symfony.svg)](https://php.net/)
[![license](https://img.shields.io/github/license/mashape/apistatus.svg)](https://packagist.org/packages/fond-of-oryx/erp-order-permission)

## Installation

```
composer require fond-of-oryx/erp-order-permission
```

## Configuration
Register `SeeErpOrdersPermissionPlugin` in `PermissionDependencyProvider`

```
<?php

namespace Pyz\Client\Permission;

use FondOfOryx\Client\ErpOrderPermission\Plugin\Permission\SeeErpOrdersPermissionPlugin;

class PermissionDependencyProvider extends SprykerPermissionDependencyProvider
{
   ...
   /**
     * @return \Spryker\Shared\PermissionExtension\Dependency\Plugin\PermissionPluginInterface[]
     */
    protected function getPermissionPlugins(): array
    {
        return [
            ...
            new SeeErpOrdersPermissionPlugin(),
        ];
    }
}
...
```

Append permission in ZED Backend!
