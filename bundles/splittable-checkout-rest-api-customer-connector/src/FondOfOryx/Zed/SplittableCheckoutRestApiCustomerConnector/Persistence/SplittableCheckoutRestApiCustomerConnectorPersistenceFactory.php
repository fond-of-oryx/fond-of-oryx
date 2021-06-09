<?php

namespace FondOfOryx\Zed\SplittableCheckoutRestApiCustomerConnector\Persistence;

use FondOfOryx\Zed\SplittableCheckoutRestApiCustomerConnector\Dependency\QueryContainer\SplittableCheckoutRestApiCustomerConnectorToCustomerQueryContainerInterface;
use FondOfOryx\Zed\SplittableCheckoutRestApiCustomerConnector\SplittableCheckoutRestApiCustomerConnectorDependencyProvider;
use Spryker\Zed\Kernel\Persistence\AbstractPersistenceFactory;

/**
 * @method \FondOfOryx\Zed\SplittableCheckoutRestApiCustomerConnector\Persistence\SplittableCheckoutRestApiCustomerConnectorRepositoryInterface getRepository()
 */
class SplittableCheckoutRestApiCustomerConnectorPersistenceFactory extends AbstractPersistenceFactory
{
    /**
     * @return \FondOfOryx\Zed\SplittableCheckoutRestApiCustomerConnector\Dependency\QueryContainer\SplittableCheckoutRestApiCustomerConnectorToCustomerQueryContainerInterface
     */
    public function getCustomerQueryContainer(): SplittableCheckoutRestApiCustomerConnectorToCustomerQueryContainerInterface
    {
        return $this->getProvidedDependency(
            SplittableCheckoutRestApiCustomerConnectorDependencyProvider::QUERY_CONTAINER_CUSTOMER
        );
    }
}
