<?php

namespace FondOfOryx\Zed\CustomerRegistration\Dependency\QueryContainer;

use Orm\Zed\Customer\Persistence\SpyCustomerQuery;

interface CustomerRegistrationToCustomerQueryContainerInterface
{
    /**
     * @param int $idCustomer
     *
     * @return \Orm\Zed\Customer\Persistence\SpyCustomerQuery
     */
    public function queryCustomerById(int $idCustomer): SpyCustomerQuery;

    /**
     * @param string $email
     *
     * @return \Orm\Zed\Customer\Persistence\SpyCustomerQuery
     */
    public function queryCustomerByEmail(string $email): SpyCustomerQuery;

    /**
     * @return \Orm\Zed\Customer\Persistence\SpyCustomerQuery
     */
    public function queryCustomers(): SpyCustomerQuery;
}
