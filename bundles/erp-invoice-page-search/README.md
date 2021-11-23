# ERPOrderPageSearch
[![license](https://img.shields.io/github/license/fond-of-oryx/erp-invoice-page-search.svg)](https://packagist.org/packages/fond-of-oryx/erp-invoice-page-search)

## Installation

```
composer require fond-of-oryx/erp-invoice-page-search
```

## Configuration
For searches like `GET {{glue_uri}}/erp-invoice-page-search?page[offset]=0&page[limit]=12&company-business-unit-uuid[]={{external_company_business_unit_reference}}&external-reference[]={{external_reference1}}&external-reference[]={{external_reference2}}`
Register `ErpInvoicePageSearchOwnParamFilterQueryExpanderPlugin` as expander plugin
For searches with spryker filters like `GET {{glue_uri}}/erp-invoice-page-search?page[offset]=0&page[limit]=12&filter[company-business-unit.uuid]={{external_company_business_unit_reference}}&filter[erp-invoice.external-reference]={{external_reference}}`
Register `ErpInvoicePageSearchExternalReferenceFilterQueryExpanderPlugin` as expander plugin
and `ErpInvoicePageSearchCompanyBusinessUnitUuidFilterQueryExpanderPlugin` as expander plugin

Register `RawErpInvoicePageSearchResultFormatterPlugin` as result formatter plugin

```
<?php
namespace Pyz\Client\ErpInvoicePageSearch;

use FondOfOryx\Client\ErpInvoicePageSearch\ErpInvoicePageSearchDependencyProvider as FooErpInvoicePageSearchDependencyProvider;
use FondOfOryx\Client\ErpInvoicePageSearch\Plugin\SearchExtension\ErpInvoicePageSearchOwnParamFilterQueryExpanderPlugin;
use FondOfOryx\Client\ErpInvoicePageSearch\Plugin\SearchExtension\RawErpInvoicePageSearchResultFormatterPlugin;

class ErpInvoicePageSearchDependencyProvider extends FooErpInvoicePageSearchDependencyProvider
{
    /**
     * @return \Spryker\Client\Search\Dependency\Plugin\QueryExpanderPluginInterface[]
     */
    protected function getQueryExpanderPlugins(): array
    {
        $queryExpanderPlugins = parent::getQueryExpanderPlugins();

        $queryExpanderPlugins[] = new ErpInvoicePageSearchOwnParamFilterQueryExpanderPlugin();

        return $queryExpanderPlugins;
    }
    /**
     * @return \Spryker\Client\Search\Dependency\Plugin\ResultFormatterPluginInterface[]
     */
    protected function getResultFormatterPlugins(): array
    {
        $resultFormatterPlugins = parent::getResultFormatterPlugins();

        $resultFormatterPlugins[] = new RawErpInvoicePageSearchResultFormatterPlugin();

        return $resultFormatterPlugins;
    }
}
```
