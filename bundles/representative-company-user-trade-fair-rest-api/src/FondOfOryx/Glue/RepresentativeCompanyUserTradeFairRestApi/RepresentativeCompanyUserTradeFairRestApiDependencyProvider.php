<?php

namespace FondOfOryx\Glue\RepresentativeCompanyUserTradeFairRestApi;

use FondOfOryx\Glue\RepresentativeCompanyUserTradeFairRestApi\Dependency\Client\RepresentativeCompanyUserTradeFairRestApiToRepresentativeCompanyUserTradeFairRestApiPermissionBridge;
use Spryker\Glue\Kernel\AbstractBundleDependencyProvider;
use Spryker\Glue\Kernel\Container;

/**
 * @method \FondOfOryx\Client\RepresentativeCompanyUserTradeFairRestApi\RepresentativeCompanyUserTradeFairRestApiClient getClient()
 * @method \FondOfOryx\Glue\RepresentativeCompanyUserTradeFairRestApi\RepresentativeCompanyUserTradeFairRestApiConfig getConfig()
 */
class RepresentativeCompanyUserTradeFairRestApiDependencyProvider extends AbstractBundleDependencyProvider
{
    /**
     * @var string
     */
    public const CLIENT_REPRESENTATIVE_COMPANY_USER_TRADE_FAIR_PERMISSION = 'CLIENT_REPRESENTATIVE_COMPANY_USER_TRADE_FAIR_PERMISSION';

    /**
     * @param \Spryker\Glue\Kernel\Container $container
     *
     * @return \Spryker\Glue\Kernel\Container
     */
    public function provideDependencies(Container $container): Container
    {
        $container = parent::provideDependencies($container);

        return $this->addRepresentativeCompanyUserTradeFairRestApiPermissionClient($container);
    }

    /**
     * @param \Spryker\Glue\Kernel\Container $container
     *
     * @return \Spryker\Glue\Kernel\Container
     */
    protected function addRepresentativeCompanyUserTradeFairRestApiPermissionClient(Container $container): Container
    {
        $container[static::CLIENT_REPRESENTATIVE_COMPANY_USER_TRADE_FAIR_PERMISSION] = static function (Container $container) {
            return new RepresentativeCompanyUserTradeFairRestApiToRepresentativeCompanyUserTradeFairRestApiPermissionBridge(
                $container->getLocator()->representativeCompanyUserTradeFairRestApiPermission()->client(),
            );
        };

        return $container;
    }
}
