# ERP Order
[![license](https://img.shields.io/github/license/fond-of-oryx/erp-invoice-permission.svg)](https://packagist.org/packages/fond-of-oryx/erp-invoice-permission)

## Installation

```
composer require fond-of-oryx/erp-invoice-permission
```

## Configuration
Register `SeeErpInvoicesPermissionPlugin` in `PermissionDependencyProvider`

```
<?php

namespace Pyz\Client\Permission;

use FondOfOryx\Client\ErpInvoicePermission\Plugin\Permission\SeeErpInvoicesPermissionPlugin;

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
            new SeeErpInvoicesPermissionPlugin(),
        ];
    }
}
...
```

Append permission in ZED Backend!
