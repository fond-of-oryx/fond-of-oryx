<?php

namespace FondOfOryx\Zed\RepresentativeCompanyUserTradeFairRestApiPermission;

use Orm\Zed\CompanyRole\Persistence\SpyCompanyRoleToPermissionQuery;
use Spryker\Zed\Kernel\AbstractBundleDependencyProvider;
use Spryker\Zed\Kernel\Container;

class RepresentativeCompanyUserTradeFairRestApiPermissionDependencyProvider extends AbstractBundleDependencyProvider
{
    /**
     * @var string
     */
    public const QUERY_SPY_COMPANY_ROLE_PERMISSION = 'QUERY_SPY_COMPANY_ROLE_PERMISSION';

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    public function providePersistenceLayerDependencies(Container $container): Container
    {
        $container = parent::providePersistenceLayerDependencies($container);

        return $this->addSpyCompanyRoleToPermissionQuery($container);
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    public function addSpyCompanyRoleToPermissionQuery(Container $container): Container
    {
        $container[static::QUERY_SPY_COMPANY_ROLE_PERMISSION] = static function (Container $container) {
            return SpyCompanyRoleToPermissionQuery::create();
        };

        return $container;
    }
}
