<?php

namespace FondOfOryx\Yves\CustomerTokenManager\Plugin\Security;

use FondOfOryx\Shared\CustomerTokenManager\CustomerTokenManagerConfig;
use Spryker\Service\Container\ContainerInterface;
use Spryker\Shared\SecurityExtension\Configuration\SecurityBuilderInterface;
use Spryker\Shared\SecurityExtension\Dependency\Plugin\SecurityPluginInterface;
use Spryker\Yves\Kernel\AbstractPlugin;

/**
 * @method \FondOfOryx\Yves\CustomerTokenManager\CustomerTokenManagerConfig getConfig()
 * @method \FondOfOryx\Yves\CustomerTokenManager\CustomerTokenManagerFactory getFactory()
 */
class CustomerTokenManagerSecurityPlugin extends AbstractPlugin implements SecurityPluginInterface
{
    /**
     * @var string
     */
    public const ROLE_USER = 'ROLE_USER';

    /**
     * @var string
     */
    protected const IS_AUTHENTICATED_ANONYMOUSLY = 'IS_AUTHENTICATED_ANONYMOUSLY';

    /**
     * @param \Spryker\Shared\SecurityExtension\Configuration\SecurityBuilderInterface $securityBuilder
     * @param \Spryker\Service\Container\ContainerInterface $container
     *
     * @return \Spryker\Shared\SecurityExtension\Configuration\SecurityBuilderInterface
     */
    public function extend(
        SecurityBuilderInterface $securityBuilder,
        ContainerInterface $container
    ): SecurityBuilderInterface {
        $securityBuilder = $this->addFirewalls($securityBuilder);
        $securityBuilder = $this->addAuthenticationSuccessHandler($securityBuilder);

        return $this->addAccessRules($securityBuilder);
    }

    /**
     * @param \Spryker\Shared\SecurityExtension\Configuration\SecurityBuilderInterface $securityBuilder
     *
     * @return \Spryker\Shared\SecurityExtension\Configuration\SecurityBuilderInterface
     */
    protected function addFirewalls(SecurityBuilderInterface $securityBuilder): SecurityBuilderInterface
    {
        $securityBuilder->addFirewall(CustomerTokenManagerConfig::SECURITY_FIREWALL_NAME, [
            'anonymous' => true,
            'pattern' => '^/',
            'users' => function () {
                return $this->getFactory()->createCustomerUserProvider();
            },
        ]);

        return $securityBuilder;
    }

    /**
     * @param \Spryker\Shared\SecurityExtension\Configuration\SecurityBuilderInterface $securityBuilder
     *
     * @return \Spryker\Shared\SecurityExtension\Configuration\SecurityBuilderInterface
     */
    protected function addAccessRules(SecurityBuilderInterface $securityBuilder): SecurityBuilderInterface
    {
        $customerSecuredPattern = $this->getFactory()
            ->getCustomerClient()
            ->getCustomerSecuredPattern();

        $securityBuilder->addAccessRules([
            [
                $customerSecuredPattern,
                static::ROLE_USER,
            ],
            [
                $this->getConfig()->getAnonymousPattern(),
                static::IS_AUTHENTICATED_ANONYMOUSLY,
            ],
        ]);

        return $securityBuilder;
    }

    /**
     * @param \Spryker\Shared\SecurityExtension\Configuration\SecurityBuilderInterface $securityBuilder
     *
     * @return \Spryker\Shared\SecurityExtension\Configuration\SecurityBuilderInterface
     */
    protected function addAuthenticationSuccessHandler(SecurityBuilderInterface $securityBuilder): SecurityBuilderInterface
    {
        $securityBuilder->addAuthenticationSuccessHandler(CustomerTokenManagerConfig::SECURITY_FIREWALL_NAME, function () {
            return $this->getFactory()->createCustomerAuthenticationSuccessHandler();
        });

        return $securityBuilder;
    }
}
