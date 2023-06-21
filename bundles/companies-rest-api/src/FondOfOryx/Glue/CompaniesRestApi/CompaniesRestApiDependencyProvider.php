<?php

namespace FondOfOryx\Glue\CompaniesRestApi;

use FondOfOryx\Glue\CompaniesRestApi\Dependency\Client\CompaniesRestApiToCompaniesRestApiPermissionBridge;
use Spryker\Glue\Kernel\AbstractBundleDependencyProvider;
use Spryker\Glue\Kernel\Container;

/**
 * @method \FondOfOryx\Client\CompaniesRestApi\CompaniesRestApiClient getClient()
 * @method \FondOfOryx\Glue\CompaniesRestApi\CompaniesRestApiConfig getConfig()
 */
class CompaniesRestApiDependencyProvider extends AbstractBundleDependencyProvider
{
    /**
     * @var string
     */
    public const CLIENT_COMPANIES_REST_API_PERMISSION = 'CLIENT_COMPANIES_REST_API_PERMISSION';

    /**
     * @param \Spryker\Glue\Kernel\Container $container
     *
     * @return \Spryker\Glue\Kernel\Container
     */
    public function provideDependencies(Container $container): Container
    {
        $container = parent::provideDependencies($container);

        return $this->addCompaniesRestApiPermissionClient($container);
    }

    /**
     * @param \Spryker\Glue\Kernel\Container $container
     *
     * @return \Spryker\Glue\Kernel\Container
     */
    protected function addCompaniesRestApiPermissionClient(Container $container): Container
    {
        $container[static::CLIENT_COMPANIES_REST_API_PERMISSION] = static function (Container $container) {
            return new CompaniesRestApiToCompaniesRestApiPermissionBridge(
                $container->getLocator()->companiesRestApiPermission()->client(),
            );
        };

        return $container;
    }
}
