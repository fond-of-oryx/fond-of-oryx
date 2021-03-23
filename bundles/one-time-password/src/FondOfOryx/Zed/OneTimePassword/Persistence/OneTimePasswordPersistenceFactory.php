<?php

namespace FondOfOryx\Zed\OneTimePassword\Persistence;

use FondOfOryx\Zed\OneTimePassword\OneTimePasswordDependencyProvider;
use Orm\Zed\Customer\Persistence\SpyCustomerQuery;
use Spryker\Zed\Kernel\Persistence\AbstractPersistenceFactory;

/**
 * @method \FondOfOryx\Zed\OneTimePassword\Persistence\OneTimePasswordEntityManagerInterface getEntityManager()
 * @method \FondOfOryx\Zed\OneTimePassword\Persistence\OneTimePasswordRepositoryInterface getRepository()
 * @method \FondOfOryx\Zed\OneTimePassword\OneTimePasswordConfig getConfig()
 */
class OneTimePasswordPersistenceFactory extends AbstractPersistenceFactory
{
    /**
     * @return \Orm\Zed\Customer\Persistence\SpyCustomerQuery
     */
    public function getSpyCustomerQuery(): SpyCustomerQuery
    {
        return $this->getProvidedDependency(OneTimePasswordDependencyProvider::QUERY_SPY_CUSTOMER);
    }
}
