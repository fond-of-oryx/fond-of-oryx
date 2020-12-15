<?php

namespace FondOfOryx\Zed\CustomerStatistic\Dependency\QueryContainer;

use Orm\Zed\Customer\Persistence\SpyCustomerQuery;

interface CustomerStatisticToCustomerQueryContainerInterface
{
    /**
     * @param string $customerReference
     *
     * @return \Orm\Zed\Customer\Persistence\SpyCustomerQuery
     */
    public function queryCustomerByReference(string $customerReference): SpyCustomerQuery;
}
