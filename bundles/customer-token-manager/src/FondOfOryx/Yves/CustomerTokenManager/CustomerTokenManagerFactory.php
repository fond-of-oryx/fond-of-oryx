<?php

namespace FondOfOryx\Yves\CustomerTokenManager;

use FondOfOryx\Shared\CustomerTokenManager\CustomerTokenManagerConfig;
use FondOfOryx\Yves\CustomerTokenManager\Authenticator\CustomerAuthenticator;
use FondOfOryx\Yves\CustomerTokenManager\Authenticator\CustomerAuthenticatorInterface;
use FondOfOryx\Yves\CustomerTokenManager\Dependency\Client\CustomerTokenManagerToCustomerClientInterface;
use FondOfOryx\Yves\CustomerTokenManager\Plugin\Provider\CustomerAuthenticationSuccessHandler;
use FondOfOryx\Yves\CustomerTokenManager\Plugin\Provider\CustomerUserProvider;
use FondOfOryx\Yves\CustomerTokenManager\Plugin\Security\CustomerTokenManagerSecurityPlugin;
use FondOfOryx\Yves\CustomerTokenManager\Security\Customer;
use Generated\Shared\Transfer\CustomerTransfer;
use ReflectionClass;
use Spryker\Yves\Kernel\AbstractFactory;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;

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
        $user = $this->createSecurityUser($customerTransfer);

        if (count((new ReflectionClass(UsernamePasswordToken::class))->getConstructor()->getParameters()) === 4) {
            return new UsernamePasswordToken(
                $user,
                $user->getPassword(),
                CustomerTokenManagerConfig::SECURITY_FIREWALL_NAME,
                [CustomerTokenManagerSecurityPlugin::ROLE_USER],
            );
        }

        return new UsernamePasswordToken(
            $user,
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
     * @return \FondOfOryx\Yves\CustomerTokenManager\Plugin\Provider\CustomerAuthenticationSuccessHandler
     */
    public function createCustomerAuthenticationSuccessHandler(): CustomerAuthenticationSuccessHandler
    {
        return new CustomerAuthenticationSuccessHandler();
    }

    /**
     * @return \Symfony\Component\Security\Core\User\UserProviderInterface
     */
    public function createCustomerUserProvider(): UserProviderInterface
    {
        return new CustomerUserProvider();
    }

    /**
     * @param string $targetUrl
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function createRedirectResponse($targetUrl): RedirectResponse
    {
        return new RedirectResponse($targetUrl);
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
    public function getRedirectPathAfterLogin(): string
    {
        return $this->getConfig()->getRedirectPathAfterLogin();
    }

    /**
     * @return string
     */
    public function getRedirectPathAfterExpiredLogin(): string
    {
        return $this->getConfig()->getRedirectPathAfterExpiredLogin();
    }

    /**
     * @return bool
     */
    public function showErrorMessageOnExpiredLogin(): bool
    {
        return $this->getConfig()->showErrorMessageOnExpiredLogin();
    }

    /**
     * @return string
     */
    public function getYvesBaseUrl(): string
    {
        return $this->getConfig()->getYvesBaseUrl();
    }

    /**
     * @return string
     */
    public function getSignatureParameterName(): string
    {
        return $this->getConfig()->getSignatureParameterName();
    }
}
