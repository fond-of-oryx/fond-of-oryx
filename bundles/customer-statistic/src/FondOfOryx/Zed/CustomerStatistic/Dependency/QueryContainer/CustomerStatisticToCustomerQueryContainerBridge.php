<?php

namespace FondOfOryx\Zed\CustomerStatistic\Dependency\QueryContainer;

use Orm\Zed\Customer\Persistence\SpyCustomerQuery;
use Spryker\Zed\Customer\Persistence\CustomerQueryContainerInterface;

/**
 * @codeCoverageIgnore
 */
class CustomerStatisticToCustomerQueryContainerBridge implements CustomerStatisticToCustomerQueryContainerInterface
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
