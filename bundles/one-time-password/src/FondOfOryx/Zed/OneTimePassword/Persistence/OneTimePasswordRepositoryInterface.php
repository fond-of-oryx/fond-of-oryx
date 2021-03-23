<?php

namespace FondOfOryx\Zed\OneTimePassword\Persistence;

use Orm\Zed\Customer\Persistence\SpyCustomerQuery;

interface OneTimePasswordRepositoryInterface
{
    /**
     * @param string $email
     *
     * @return \Orm\Zed\Customer\Persistence\SpyCustomerQuery
     */
    public function queryCustomerByEmail(string $email): SpyCustomerQuery;
}
