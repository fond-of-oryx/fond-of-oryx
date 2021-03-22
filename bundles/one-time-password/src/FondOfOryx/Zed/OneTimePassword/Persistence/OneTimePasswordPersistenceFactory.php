<?php

namespace FondOfOryx\Zed\OneTimePassword\Persistence;

use Orm\Zed\Customer\Persistence\SpyCustomerQuery;
use Spryker\Zed\Kernel\Persistence\AbstractPersistenceFactory;

/**
 * @method \FondOfOryx\Zed\OneTimePassword\Persistence\OneTimePasswordEntityManagerInterface getEntityManager()
 * @method \FondOfOryx\Zed\OneTimePassword\Persistence\OneTimePasswordQueryContainerInterface getQueryContainer()
 * @method \FondOfOryx\Zed\OneTimePassword\OneTimePasswordConfig getConfig()
 */
class OneTimePasswordPersistenceFactory extends AbstractPersistenceFactory
{
    /**
     * @return \Orm\Zed\Customer\Persistence\SpyCustomerQuery
     */
    public function createSpyCustomer(): SpyCustomerQuery
    {
        return SpyCustomerQuery::create();
    }
}
