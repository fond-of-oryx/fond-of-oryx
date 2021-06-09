<?php

namespace FondOfOryx\Zed\SplittableCheckoutRestApiCustomerConnector\Dependency\QueryContainer;

use Orm\Zed\Customer\Persistence\SpyCustomerQuery;

interface SplittableCheckoutRestApiCustomerConnectorToCustomerQueryContainerInterface
{
    /**
     * @param string $customerReference
     *
     * @return \Orm\Zed\Customer\Persistence\SpyCustomerQuery
     */
    public function queryCustomerByReference(string $customerReference): SpyCustomerQuery;
}
