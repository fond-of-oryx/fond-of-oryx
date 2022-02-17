# ERPOrderPageSearch
[![license](https://img.shields.io/github/license/fond-of-oryx/erp-delivery-note-page-search.svg)](https://packagist.org/packages/fond-of-oryx/erp-delivery-note-page-search)

## Installation

```
composer require fond-of-oryx/erp-delivery-note-page-search
```

## Configuration
For searches like `GET {{glue_uri}}/erp-delivery-note-page-search?page[offset]=0&page[limit]=12&company-business-unit-uuid[]={{external_company_business_unit_reference}}&external-reference[]={{external_reference1}}&external-reference[]={{external_reference2}}`
Register `ErpDeliveryNotePageSearchOwnParamFilterQueryExpanderPlugin` as expander plugin
For searches with spryker filters like `GET {{glue_uri}}/erp-delivery-note-page-search?page[offset]=0&page[limit]=12&filter[company-business-unit.uuid]={{external_company_business_unit_reference}}&filter[erp-delivery-note.external-reference]={{external_reference}}`
Register `ErpDeliveryNotePageSearchExternalReferenceFilterQueryExpanderPlugin` as expander plugin
and `ErpDeliveryNotePageSearchCompanyBusinessUnitUuidFilterQueryExpanderPlugin` as expander plugin

Register `RawErpDeliveryNotePageSearchResultFormatterPlugin` as result formatter plugin

```
<?php
namespace Pyz\Client\ErpDeliveryNotePageSearch;

use FondOfOryx\Client\ErpDeliveryNotePageSearch\ErpDeliveryNotePageSearchDependencyProvider as FooErpDeliveryNotePageSearchDependencyProvider;
use FondOfOryx\Client\ErpDeliveryNotePageSearch\Plugin\SearchExtension\ErpDeliveryNotePageSearchOwnParamFilterQueryExpanderPlugin;
use FondOfOryx\Client\ErpDeliveryNotePageSearch\Plugin\SearchExtension\RawErpDeliveryNotePageSearchResultFormatterPlugin;

class ErpDeliveryNotePageSearchDependencyProvider extends FooErpDeliveryNotePageSearchDependencyProvider
{
    /**
     * @return \Spryker\Client\Search\Dependency\Plugin\QueryExpanderPluginInterface[]
     */
    protected function getQueryExpanderPlugins(): array
    {
        $queryExpanderPlugins = parent::getQueryExpanderPlugins();

        $queryExpanderPlugins[] = new ErpDeliveryNotePageSearchOwnParamFilterQueryExpanderPlugin();

        return $queryExpanderPlugins;
    }
    /**
     * @return \Spryker\Client\Search\Dependency\Plugin\ResultFormatterPluginInterface[]
     */
    protected function getResultFormatterPlugins(): array
    {
        $resultFormatterPlugins = parent::getResultFormatterPlugins();

        $resultFormatterPlugins[] = new RawErpDeliveryNotePageSearchResultFormatterPlugin();

        return $resultFormatterPlugins;
    }
}
```
