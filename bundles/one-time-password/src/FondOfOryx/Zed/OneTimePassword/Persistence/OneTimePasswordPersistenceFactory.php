<?php

namespace FondOfOryx\Zed\OneTimePassword\Persistence;

use FondOfOryx\Zed\OneTimePassword\Dependency\QueryContainer\OneTimePasswordToCustomerQueryContainerInterface;
use FondOfOryx\Zed\OneTimePassword\OneTimePasswordDependencyProvider;
use Spryker\Zed\Kernel\Persistence\AbstractPersistenceFactory;

/**
 * @method \FondOfOryx\Zed\OneTimePassword\Persistence\OneTimePasswordEntityManagerInterface getEntityManager()
 * @method \FondOfOryx\Zed\OneTimePassword\OneTimePasswordConfig getConfig()
 */
class OneTimePasswordPersistenceFactory extends AbstractPersistenceFactory
{
    /**
     * @return \FondOfOryx\Zed\OneTimePassword\Dependency\QueryContainer\OneTimePasswordToCustomerQueryContainerInterface
     */
    public function getCustomerQueryContainer(): OneTimePasswordToCustomerQueryContainerInterface
    {
        return $this->getProvidedDependency(OneTimePasswordDependencyProvider::QUERY_CONTAINER_CUSTOMER);
    }
}
