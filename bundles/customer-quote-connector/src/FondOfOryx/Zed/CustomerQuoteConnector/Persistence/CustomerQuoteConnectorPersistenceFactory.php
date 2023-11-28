<?php

namespace FondOfOryx\Zed\CustomerQuoteConnector\Persistence;

use FondOfOryx\Zed\CustomerQuoteConnector\CustomerQuoteConnectorDependencyProvider;
use Orm\Zed\Customer\Persistence\Base\SpyCustomerQuery;
use Spryker\Zed\Kernel\Persistence\AbstractPersistenceFactory;

/**
 * @codeCoverageIgnore
 */
class CustomerQuoteConnectorPersistenceFactory extends AbstractPersistenceFactory
{
    /**
     * @return \Orm\Zed\Customer\Persistence\Base\SpyCustomerQuery
     */
    public function getCustomerQuery(): SpyCustomerQuery
    {
        return $this->getProvidedDependency(CustomerQuoteConnectorDependencyProvider::PROPEL_QUERY_CUSTOMER);
    }
}
