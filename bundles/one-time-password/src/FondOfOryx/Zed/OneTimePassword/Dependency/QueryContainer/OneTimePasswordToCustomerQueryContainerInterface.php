<?php

namespace FondOfOryx\Zed\OneTimePassword\Dependency\QueryContainer;

use Orm\Zed\Customer\Persistence\SpyCustomerQuery;

interface OneTimePasswordToCustomerQueryContainerInterface
{
    /**
     * @param string $email
     *
     * @return \Orm\Zed\Customer\Persistence\SpyCustomerQuery
     */
    public function queryCustomerByEmail(string $email): SpyCustomerQuery;

    /**
     * @param string $customerReference
     *
     * @return \Orm\Zed\Customer\Persistence\SpyCustomerQuery
     */
    public function queryCustomerByReference(string $customerReference): SpyCustomerQuery;
}
