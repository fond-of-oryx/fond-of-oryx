<?php

namespace FondOfOryx\Yves\SharedCustomerSession\Plugin\Security;

use Spryker\Service\Container\ContainerInterface;
use Spryker\Shared\SecurityExtension\Configuration\SecurityBuilderInterface;
use Spryker\Shared\SecurityExtension\Dependency\Plugin\SecurityPluginInterface;
use Spryker\Yves\Kernel\AbstractPlugin;

class SharedCustomerSessionSecurityPlugin extends AbstractPlugin implements SecurityPluginInterface
{
    /**
     * @var string
     */
    public const ROLE_USER = 'ROLE_USER';

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
        return $securityBuilder;
    }
}
