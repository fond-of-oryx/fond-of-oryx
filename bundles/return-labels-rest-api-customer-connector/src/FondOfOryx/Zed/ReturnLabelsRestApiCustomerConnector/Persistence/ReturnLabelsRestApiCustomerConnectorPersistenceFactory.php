<?php

namespace FondOfOryx\Zed\ReturnLabelsRestApiCustomerConnector\Persistence;

use FondOfOryx\Zed\ReturnLabelsRestApiCustomerConnector\Persistence\Propel\Mapper\CustomerMapper;
use FondOfOryx\Zed\ReturnLabelsRestApiCustomerConnector\Persistence\Propel\Mapper\CustomerMapperInterface;
use Orm\Zed\Customer\Persistence\SpyCustomerQuery;
use Spryker\Zed\Kernel\Persistence\AbstractPersistenceFactory;
use FondOfOryx\Zed\ReturnLabelsRestApiCustomerConnector\ReturnLabelsRestApiCustomerConnectorDependencyProvider;

class ReturnLabelsRestApiCustomerConnectorPersistenceFactory extends AbstractPersistenceFactory
{
    /**
     * @return \Orm\Zed\Customer\Persistence\SpyCustomerQuery
     */
    public function getCustomerQuery(): SpyCustomerQuery
    {
        return $this->get(ReturnLabelsRestApiCustomerConnectorDependencyProvider::PROPEL_QUERY_CUSTOMER_QUERY);
    }

    /**
     * @return \FondOfOryx\Zed\ReturnLabelsRestApiCustomerConnector\Persistence\Propel\Mapper\CustomerMapperInterface
     */
    public function createCustomerTransferMapper(): CustomerMapperInterface
    {
        return new CustomerMapper();
    }
}
