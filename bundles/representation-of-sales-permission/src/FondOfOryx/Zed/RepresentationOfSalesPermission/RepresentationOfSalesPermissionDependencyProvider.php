<?php

namespace FondOfOryx\Zed\RepresentationOfSalesPermission;

use Orm\Zed\CompanyRole\Persistence\SpyCompanyRoleToPermissionQuery;
use Spryker\Zed\Kernel\AbstractBundleDependencyProvider;
use Spryker\Zed\Kernel\Container;

class RepresentationOfSalesPermissionDependencyProvider extends AbstractBundleDependencyProvider
{
    /** @var string */
    public const QUERY_SPY_COMPANY_ROLE_PERMISSION = 'QUERY_SPY_COMPANY_ROLE_PERMISSION';

    public function providePersistenceLayerDependencies(Container $container)
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