<?php

namespace FondOfOryx\Glue\RepresentativeCompanyUserRestApi;

use FondOfOryx\Glue\RepresentativeCompanyUserRestApi\Dependency\Client\RepresentativeCompanyUserRestApiToRepresentativeCompanyUserRestApiPermissionBridge;
use Spryker\Glue\Kernel\AbstractBundleDependencyProvider;
use Spryker\Glue\Kernel\Container;

/**
 * @method \FondOfOryx\Client\RepresentativeCompanyUserRestApi\RepresentativeCompanyUserRestApiClient getClient()
 * @method \FondOfOryx\Glue\RepresentativeCompanyUserRestApi\RepresentativeCompanyUserRestApiConfig getConfig()
 */
class RepresentativeCompanyUserRestApiDependencyProvider extends AbstractBundleDependencyProvider
{
    /**
     * @var string
     */
    public const CLIENT_REPRESENTATIVE_COMPANY_USER_PERMISSION = 'CLIENT_REPRESENTATIVE_COMPANY_USER_PERMISSION';

    /**
     * @param \Spryker\Glue\Kernel\Container $container
     *
     * @return \Spryker\Glue\Kernel\Container
     */
    public function provideDependencies(Container $container): Container
    {
        $container = parent::provideDependencies($container);

        return $this->addRepresentativeCompanyUserRestApiPermissionClient($container);
    }

    /**
     * @param \Spryker\Glue\Kernel\Container $container
     *
     * @return \Spryker\Glue\Kernel\Container
     */
    protected function addRepresentativeCompanyUserRestApiPermissionClient(Container $container): Container
    {
        $container[static::CLIENT_REPRESENTATIVE_COMPANY_USER_PERMISSION] = static function (Container $container) {
            return new RepresentativeCompanyUserRestApiToRepresentativeCompanyUserRestApiPermissionBridge(
                $container->getLocator()->representativeCompanyUserRestApiPermission()->client(),
            );
        };

        return $container;
    }
}
