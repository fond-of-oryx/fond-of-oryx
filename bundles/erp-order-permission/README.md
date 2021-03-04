# ERP Order
[![license](https://img.shields.io/github/license/fond-of-oryx/erp-order-permission.svg)](https://packagist.org/packages/fond-of-oryx/erp-order-permission)

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
