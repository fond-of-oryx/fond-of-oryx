<?php

namespace FondOfOryx\Yves\CustomerSessionController;

use FondOfOryx\Shared\CustomerSessionController\CustomerSessionControllerConfig;
use FondOfOryx\Yves\CustomerSessionController\Authenticator\CustomerAuthenticator;
use FondOfOryx\Yves\CustomerSessionController\Authenticator\CustomerAuthenticatorInterface;
use FondOfOryx\Yves\CustomerSessionController\Dependency\Client\CustomerSessionControllerToCustomerClientInterface;
use FondOfOryx\Yves\CustomerSessionController\Plugin\Security\CustomerSessionControllerSecurityPlugin;
use FondOfOryx\Yves\CustomerSessionController\Security\Customer;
use Generated\Shared\Transfer\CustomerTransfer;
use Spryker\Yves\Kernel\AbstractFactory;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;
use Symfony\Component\Security\Core\User\UserInterface;

class CustomerSessionControllerFactory extends AbstractFactory
{
    /**
     * @return \FondOfOryx\Yves\CustomerSessionController\Dependency\Client\CustomerSessionControllerToCustomerClientInterface
     */
    public function getCustomerClient(): CustomerSessionControllerToCustomerClientInterface
    {
        return $this->getProvidedDependency(CustomerSessionControllerDependencyProvider::CLIENT_CUSTOMER);
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
            CustomerSessionControllerConfig::SECURITY_FIREWALL_NAME,
            [CustomerSessionControllerSecurityPlugin::ROLE_USER],
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
            [CustomerSessionControllerSecurityPlugin::ROLE_USER],
        );
    }

    /**
     * @return \FondOfOryx\Yves\CustomerSessionController\Authenticator\CustomerAuthenticatorInterface
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
        return $this->getProvidedDependency(CustomerSessionControllerDependencyProvider::PLUGIN_APPLICATION);
    }
}
