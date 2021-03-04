# ERPOrderPageSearch
[![license](https://img.shields.io/github/license/fond-of-oryx/erp-order-page-search.svg)](https://packagist.org/packages/fond-of-oryx/erp-order-page-search)

## Installation

```
composer require fond-of-oryx/erp-order-page-search
```

## Configuration
For searches like `GET {{glue_uri}}/erp-order-page-search?page[offset]=0&page[limit]=12&company-business-unit-uuid[]={{external_company_business_unit_reference}}&external-reference[]={{external_reference1}}&external-reference[]={{external_reference2}}`
Register `ErpOrderPageSearchOwnParamFilterQueryExpanderPlugin` as expander plugin
For searches with spryker filters like `GET {{glue_uri}}/erp-order-page-search?page[offset]=0&page[limit]=12&filter[company-business-unit.uuid]={{external_company_business_unit_reference}}&filter[erp-order.external-reference]={{external_reference}}`
Register `ErpOrderPageSearchExternalReferenceFilterQueryExpanderPlugin` as expander plugin
and `ErpOrderPageSearchCompanyBusinessUnitUuidFilterQueryExpanderPlugin` as expander plugin

Register `RawErpOrderPageSearchResultFormatterPlugin` as result formatter plugin

```
<?php
namespace Pyz\Client\ErpOrderPageSearch;

use FondOfOryx\Client\ErpOrderPageSearch\ErpOrderPageSearchDependencyProvider as FooErpOrderPageSearchDependencyProvider;
use FondOfOryx\Client\ErpOrderPageSearch\Plugin\SearchExtension\ErpOrderPageSearchOwnParamFilterQueryExpanderPlugin;
use FondOfOryx\Client\ErpOrderPageSearch\Plugin\SearchExtension\RawErpOrderPageSearchResultFormatterPlugin;

class ErpOrderPageSearchDependencyProvider extends FooErpOrderPageSearchDependencyProvider
{
    /**
     * @return \Spryker\Client\Search\Dependency\Plugin\QueryExpanderPluginInterface[]
     */
    protected function getQueryExpanderPlugins(): array
    {
        $queryExpanderPlugins = parent::getQueryExpanderPlugins();

        $queryExpanderPlugins[] = new ErpOrderPageSearchOwnParamFilterQueryExpanderPlugin();

        return $queryExpanderPlugins;
    }
    /**
     * @return \Spryker\Client\Search\Dependency\Plugin\ResultFormatterPluginInterface[]
     */
    protected function getResultFormatterPlugins(): array
    {
        $resultFormatterPlugins = parent::getResultFormatterPlugins();

        $resultFormatterPlugins[] = new RawErpOrderPageSearchResultFormatterPlugin();

        return $resultFormatterPlugins;
    }
}
```
