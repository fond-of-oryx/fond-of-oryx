<?php

namespace FondOfOryx\Client\CustomerTokenManager;

use FondOfOryx\Client\CustomerTokenManager\Dependency\Client\CustomerTokenManagerToCustomerClientInterface;
use FondOfOryx\Client\CustomerTokenManager\Dependency\Client\CustomerTokenManagerToOAuthClientInterface;
use Spryker\Client\Kernel\AbstractFactory;

class CustomerTokenManagerFactory extends AbstractFactory
{
    /**
     * @return \FondOfOryx\Client\CustomerTokenManager\Dependency\Client\CustomerTokenManagerToOAuthClientInterface
     */
    public function getOAuthCLient(): CustomerTokenManagerToOAuthClientInterface
    {
        return $this->getProvidedDependency(CustomerTokenManagerDependencyProvider::CLIENT_OAUTH);
    }

    /**
     * @return \FondOfOryx\Client\CustomerTokenManager\Dependency\Client\CustomerTokenManagerToCustomerClientInterface
     */
    public function getCustomerClient(): CustomerTokenManagerToCustomerClientInterface
    {
        return $this->getProvidedDependency(CustomerTokenManagerDependencyProvider::CLIENT_CUSTOMER);
    }
}
