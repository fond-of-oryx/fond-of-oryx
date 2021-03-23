<?php

namespace FondOfOryx\Zed\OneTimePassword\Persistence;

use Orm\Zed\Customer\Persistence\SpyCustomerQuery;
use Spryker\Zed\Kernel\Persistence\AbstractRepository;

/**
 * @method \FondOfOryx\Zed\OneTimePassword\Persistence\OneTimePasswordPersistenceFactory getFactory()
 */
class OneTimePasswordRepository extends AbstractRepository implements OneTimePasswordRepositoryInterface
{
    /**
     * @param string $email
     *
     * @return \Orm\Zed\Customer\Persistence\SpyCustomerQuery
     */
    public function queryCustomerByEmail(string $email): SpyCustomerQuery
    {
        return $this->getFactory()
            ->getSpyCustomerQuery()
            ->filterByEmail($email);
    }
}
