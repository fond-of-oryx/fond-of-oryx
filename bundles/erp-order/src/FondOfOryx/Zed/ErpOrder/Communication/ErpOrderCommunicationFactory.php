<?php

namespace FondOfOryx\Zed\ErpOrder\Communication;

use FondOfOryx\Zed\ErpOrder\Dependency\Facade\ErpOrderToCustomerFacadeInterface;
use FondOfOryx\Zed\ErpOrder\ErpOrderDependencyProvider;
use Spryker\Zed\Kernel\Communication\AbstractCommunicationFactory;

class ErpOrderCommunicationFactory extends AbstractCommunicationFactory
{
    /**
     * @return \FondOfOryx\Zed\ErpOrder\Dependency\Facade\ErpOrderToCustomerFacadeInterface
     */
    public function getCustomerFacade(): ErpOrderToCustomerFacadeInterface
    {
        return $this->getProvidedDependency(ErpOrderDependencyProvider::FACADE_CUSTOMER);
    }
}
