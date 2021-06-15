<?php

namespace FondOfOryx\Zed\SplittableCheckoutRestApiCustomerConnector\Dependency\QueryContainer;

use Orm\Zed\Customer\Persistence\SpyCustomerQuery;
use Spryker\Zed\Customer\Persistence\CustomerQueryContainerInterface;

class SplittableCheckoutRestApiCustomerConnectorToCustomerQueryContainerBridge implements
    SplittableCheckoutRestApiCustomerConnectorToCustomerQueryContainerInterface
{
    /**
     * @var \Spryker\Zed\Customer\Persistence\CustomerQueryContainerInterface
     */
    protected $customerQueryContainer;

    /**
     * @param \Spryker\Zed\Customer\Persistence\CustomerQueryContainerInterface $customerQueryContainer
     */
    public function __construct(CustomerQueryContainerInterface $customerQueryContainer)
    {
        $this->customerQueryContainer = $customerQueryContainer;
    }

    /**
     * @param string $customerReference
     *
     * @return \Orm\Zed\Customer\Persistence\SpyCustomerQuery
     */
    public function queryCustomerByReference(string $customerReference): SpyCustomerQuery
    {
        return $this->customerQueryContainer->queryCustomerByReference($customerReference);
    }
}
