<?php

namespace FondOfOryx\Zed\CustomerQuoteConnector\Communication;

use FondOfOryx\Zed\CustomerQuoteConnector\CustomerQuoteConnectorDependencyProvider;
use FondOfOryx\Zed\CustomerQuoteConnector\Dependency\Facade\CustomerQuoteConnectorToCustomerFacadeInterface;
use Spryker\Zed\Kernel\Communication\AbstractCommunicationFactory;

/**
 * @codeCoverageIgnore
 */
class CustomerQuoteConnectorCommunicationFactory extends AbstractCommunicationFactory
{
    /**
     * @return \FondOfOryx\Zed\CustomerQuoteConnector\Dependency\Facade\CustomerQuoteConnectorToCustomerFacadeInterface
     */
    public function getCustomerFacade(): CustomerQuoteConnectorToCustomerFacadeInterface
    {
        return $this->getProvidedDependency(CustomerQuoteConnectorDependencyProvider::FACADE_CUSTOMER);
    }
}
