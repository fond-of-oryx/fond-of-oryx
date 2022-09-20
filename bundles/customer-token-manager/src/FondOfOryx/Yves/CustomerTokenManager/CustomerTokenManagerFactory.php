<?php

namespace FondOfOryx\Yves\CustomerTokenManager;

use FondOfOryx\Shared\CustomerTokenManager\CustomerTokenManagerConfig;
use FondOfOryx\Yves\CustomerTokenManager\Authenticator\CustomerAuthenticator;
use FondOfOryx\Yves\CustomerTokenManager\Authenticator\CustomerAuthenticatorInterface;
use FondOfOryx\Yves\CustomerTokenManager\Dependency\Client\CustomerTokenManagerToCustomerClientInterface;
use FondOfOryx\Yves\CustomerTokenManager\Plugin\Security\CustomerTokenManagerSecurityPlugin;
use FondOfOryx\Yves\CustomerTokenManager\Security\Customer;
use Generated\Shared\Transfer\CustomerTransfer;
use Spryker\Yves\Kernel\AbstractFactory;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @method \FondOfOryx\Yves\CustomerTokenManager\CustomerTokenManagerConfig getConfig()
 */
class CustomerTokenManagerFactory extends AbstractFactory
{
    /**
     * @return \FondOfOryx\Yves\CustomerTokenManager\Dependency\Client\CustomerTokenManagerToCustomerClientInterface
     */
    public function getCustomerClient(): CustomerTokenManagerToCustomerClientInterface
    {
        return $this->getProvidedDependency(CustomerTokenManagerDependencyProvider::CLIENT_CUSTOMER);
    }

    /**
     * @param \Generated\Shared\Transfer\CustomerTransfer $customerTransfer
     *
     * @return \Symfony\Component\Security\Core\Authentication\Token\TokenInterface
     */
    public function createUsernamePasswordToken(CustomerTransfer $customerTransfer): TokenInterface
    {
        return new UsernamePasswordToken(
            $this->createSecurityUser($customerTransfer),
            CustomerTokenManagerConfig::SECURITY_FIREWALL_NAME,
            [CustomerTokenManagerSecurityPlugin::ROLE_USER],
        );
    }

    /**
     * @param \Generated\Shared\Transfer\CustomerTransfer $customerTransfer
     *
     * @return \Symfony\Component\Security\Core\User\UserInterface
     */
    public function createSecurityUser(CustomerTransfer $customerTransfer): UserInterface
    {
        return new Customer(
            $customerTransfer,
            $customerTransfer->getEmail(),
            $customerTransfer->getPassword(),
            [CustomerTokenManagerSecurityPlugin::ROLE_USER],
        );
    }

    /**
     * @return \FondOfOryx\Yves\CustomerTokenManager\Authenticator\CustomerAuthenticatorInterface
     */
    public function createCustomerAuthenticator(): CustomerAuthenticatorInterface
    {
        return new CustomerAuthenticator(
            $this->getCustomerClient(),
            $this->getTokenStorage(),
        );
    }

    /**
     * @return \Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface
     */
    public function getTokenStorage(): TokenStorageInterface
    {
        return $this->getProvidedDependency(CustomerTokenManagerDependencyProvider::SERVICE_SECURITY_TOKEN_STORAGE);
    }

    /**
     * @return string
     */
    public function getRedirectUrlAfterLogin(): string
    {
        return $this->getConfig()->getRedirectUrlAfterLogin();
    }
}
