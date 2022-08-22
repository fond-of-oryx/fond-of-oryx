<?php

namespace FondOfOryx\Yves\SharedCustomerSession;

use FondOfOryx\Shared\SharedCustomerSession\SharedCustomerSessionConfig;
use FondOfOryx\Yves\SharedCustomerSession\Authenticator\CustomerAuthenticator;
use FondOfOryx\Yves\SharedCustomerSession\Authenticator\CustomerAuthenticatorInterface;
use FondOfOryx\Yves\SharedCustomerSession\Dependency\Client\SharedCustomerSessionToCustomerClientInterface;
use FondOfOryx\Yves\SharedCustomerSession\Plugin\Security\SharedCustomerSessionSecurityPlugin;
use FondOfOryx\Yves\SharedCustomerSession\Security\Customer;
use Generated\Shared\Transfer\CustomerTransfer;
use Spryker\Yves\Kernel\AbstractFactory;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;
use Symfony\Component\Security\Core\User\UserInterface;

class SharedCustomerSessionFactory extends AbstractFactory
{
    /**
     * @return \FondOfOryx\Yves\SharedCustomerSession\Dependency\Client\SharedCustomerSessionToCustomerClientInterface
     */
    public function getCustomerClient(): SharedCustomerSessionToCustomerClientInterface
    {
        return $this->getProvidedDependency(SharedCustomerSessionDependencyProvider::CLIENT_CUSTOMER);
    }

    /**
     * @param \Generated\Shared\Transfer\CustomerTransfer $customerTransfer
     *
     * @return \Symfony\Component\Security\Core\Authentication\Token\TokenInterface
     */
    public function createUsernamePasswordToken(CustomerTransfer $customerTransfer)
    {
        $user = $this->createSecurityUser($customerTransfer);

        return new UsernamePasswordToken(
            $user,
            $user->getPassword(),
            SharedCustomerSessionConfig::SECURITY_FIREWALL_NAME,
            [SharedCustomerSessionSecurityPlugin::ROLE_USER],
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
            [SharedCustomerSessionSecurityPlugin::ROLE_USER],
        );
    }

    /**
     * @return \FondOfOryx\Yves\SharedCustomerSession\Authenticator\CustomerAuthenticatorInterface
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
        $application = $this->getApplication();

        return $application['security.token_storage'];
    }

    /**
     * @return \Spryker\Shared\Kernel\Communication\Application
     */
    public function getApplication()
    {
        return $this->getProvidedDependency(SharedCustomerSessionDependencyProvider::PLUGIN_APPLICATION);
    }
}
