<?php

namespace FondOfOryx\Zed\ErpInvoicePageSearch\Communication\Plugin\Event;

use FondOfOryx\Shared\ErpInvoicePageSearch\ErpInvoicePageSearchConstants;
use FondOfOryx\Zed\ErpInvoice\Dependency\ErpInvoiceEvents;
use Orm\Zed\ErpInvoice\Persistence\Map\FooErpInvoiceTableMap;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Spryker\Zed\EventBehavior\Dependency\Plugin\EventResourceQueryContainerPluginInterface;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;

/**
 * @method \FondOfOryx\Zed\ErpInvoicePageSearch\Persistence\ErpInvoicePageSearchQueryContainerInterface getQueryContainer()
 * @method \FondOfOryx\Zed\ErpInvoicePageSearch\ErpInvoicePageSearchConfig getConfig()
 * @method \FondOfOryx\Zed\ErpInvoicePageSearch\Communication\ErpInvoicePageSearchCommunicationFactory getFactory()
 * @method \FondOfOryx\Zed\ErpInvoicePageSearch\Business\ErpInvoicePageSearchFacadeInterface getFacade()
 */
class ErpInvoiceEventResourceQueryContainerPlugin extends AbstractPlugin implements EventResourceQueryContainerPluginInterface
{
    /**
     * @return string
     */
    public function getResourceName(): string
    {
        return ErpInvoicePageSearchConstants::ERP_INVOICE_RESOURCE_NAME;
    }

    /**
     * @return string
     */
    public function getEventName(): string
    {
        return ErpInvoiceEvents::ERP_INVOICE_PUBLISH;
    }

    /**
     * @return string|null
     */
    public function getIdColumnName(): ?string
    {
        return FooErpInvoiceTableMap::COL_ID_ERP_INVOICE;
    }

    /**
     * @param array<int> $ids
     *
     * @return \Propel\Runtime\ActiveQuery\ModelCriteria|null
     */
    public function queryData(array $ids = []): ?ModelCriteria
    {
        return $this->getQueryContainer()->queryErpInvoicesByErpInvoiceIds($ids);
    }
}
