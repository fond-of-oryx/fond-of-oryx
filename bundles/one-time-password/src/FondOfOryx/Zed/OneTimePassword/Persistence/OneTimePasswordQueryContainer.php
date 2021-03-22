<?php

namespace FondOfOryx\Zed\OneTimePassword\Persistence;

use Orm\Zed\Customer\Persistence\SpyCustomerQuery;
use Spryker\Zed\Kernel\Persistence\AbstractQueryContainer;

/**
 * @method \FondOfOryx\Zed\OneTimePassword\Persistence\OneTimePasswordPersistenceFactory getFactory()
 */
class OneTimePasswordQueryContainer extends AbstractQueryContainer implements OneTimePasswordQueryContainerInterface
{
    /**
     * @param string $email
     *
     * @return \Orm\Zed\Customer\Persistence\SpyCustomerQuery
     */
    public function queryCustomerByEmail(string $email): SpyCustomerQuery
    {
        return $this->getFactory()
            ->createSpyCustomer()
            ->filterByEmail($email);
    }
}
