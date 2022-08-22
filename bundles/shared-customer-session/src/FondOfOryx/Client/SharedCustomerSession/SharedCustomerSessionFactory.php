<?php

namespace FondOfOryx\Client\SharedCustomerSession;

use FondOfOryx\Client\SharedCustomerSession\Dependency\Client\SharedCustomerSessionToCustomerClientInterface;
use FondOfOryx\Client\SharedCustomerSession\Dependency\Client\SharedCustomerSessionToOAuthClientInterface;
use Spryker\Client\Kernel\AbstractFactory;

class SharedCustomerSessionFactory extends AbstractFactory
{
    /**
     * @return \FondOfOryx\Client\SharedCustomerSession\Dependency\Client\SharedCustomerSessionToOAuthClientInterface
     */
    public function getOAuthCLient(): SharedCustomerSessionToOAuthClientInterface
    {
        return $this->getProvidedDependency(SharedCustomerSessionDependencyProvider::CLIENT_OAUTH);
    }

    /**
     * @return \FondOfOryx\Client\SharedCustomerSession\Dependency\Client\SharedCustomerSessionToCustomerClientInterface
     */
    public function getCustomerClient(): SharedCustomerSessionToCustomerClientInterface
    {
        return $this->getProvidedDependency(SharedCustomerSessionDependencyProvider::CLIENT_CUSTOMER);
    }
}
