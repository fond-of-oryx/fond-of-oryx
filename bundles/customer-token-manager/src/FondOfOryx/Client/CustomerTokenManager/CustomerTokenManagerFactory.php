<?php

namespace FondOfOryx\Client\CustomerTokenManager;

use FondOfOryx\Client\CustomerTokenManager\Dependency\Client\CustomerTokenManagerToCustomerClientInterface;
use FondOfOryx\Client\CustomerTokenManager\Dependency\Client\CustomerTokenManagerToOauthClientInterface;
use FondOfOryx\Client\CustomerTokenManager\Dependency\Client\CustomerTokenManagerToOauthServiceBridgeInterface;
use Spryker\Client\Kernel\AbstractFactory;

class CustomerTokenManagerFactory extends AbstractFactory
{
    /**
     * @return \FondOfOryx\Client\CustomerTokenManager\Dependency\Client\CustomerTokenManagerToOauthClientInterface
     */
    public function getOauthCLient(): CustomerTokenManagerToOauthClientInterface
    {
        return $this->getProvidedDependency(CustomerTokenManagerDependencyProvider::CLIENT_OAUTH);
    }

    /**
     * @return \FondOfOryx\Client\CustomerTokenManager\Dependency\Client\CustomerTokenManagerToOauthServiceBridgeInterface
     */
    public function getOauthService(): CustomerTokenManagerToOauthServiceBridgeInterface
    {
        return $this->getProvidedDependency(CustomerTokenManagerDependencyProvider::SERVICE_OAUTH);
    }

    /**
     * @return \FondOfOryx\Client\CustomerTokenManager\Dependency\Client\CustomerTokenManagerToCustomerClientInterface
     */
    public function getCustomerClient(): CustomerTokenManagerToCustomerClientInterface
    {
        return $this->getProvidedDependency(CustomerTokenManagerDependencyProvider::CLIENT_CUSTOMER);
    }
}
