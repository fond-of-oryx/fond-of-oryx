<?php

namespace FondOfOryx\Zed\ErpInvoicePageSearch\Communication;

use FondOfOryx\Zed\ErpInvoicePageSearch\Dependency\Facade\ErpInvoicePageSearchToEventBehaviorFacadeInterface;
use FondOfOryx\Zed\ErpInvoicePageSearch\ErpInvoicePageSearchDependencyProvider;
use Spryker\Zed\Kernel\Communication\AbstractCommunicationFactory;

/**
 * @method \FondOfOryx\Zed\ErpInvoicePageSearch\Persistence\ErpInvoicePageSearchQueryContainerInterface getQueryContainer()
 * @method \FondOfOryx\Zed\ErpInvoicePageSearch\ErpInvoicePageSearchConfig getConfig()
 * @method \FondOfOryx\Zed\ErpInvoicePageSearch\Business\ErpInvoicePageSearchFacadeInterface getFacade()
 * @method \FondOfOryx\Zed\ErpInvoicePageSearch\Persistence\ErpInvoicePageSearchEntityManagerInterface getEntityManager()
 * @method \FondOfOryx\Zed\ErpInvoicePageSearch\Persistence\ErpInvoicePageSearchRepositoryInterface getRepository()
 */
class ErpInvoicePageSearchCommunicationFactory extends AbstractCommunicationFactory
{
    /**
     * @return \FondOfOryx\Zed\ErpInvoicePageSearch\Dependency\Facade\ErpInvoicePageSearchToEventBehaviorFacadeInterface
     */
    public function getEventBehaviorFacade(): ErpInvoicePageSearchToEventBehaviorFacadeInterface
    {
        return $this->getProvidedDependency(ErpInvoicePageSearchDependencyProvider::FACADE_EVENT_BEHAVIOR);
    }
}
