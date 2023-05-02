<?php

namespace FondOfOryx\Zed\CompanyBusinessUnitCartSearchRestApi;

use Orm\Zed\CompanyBusinessUnit\Persistence\Base\SpyCompanyBusinessUnitQuery;
use Orm\Zed\Permission\Persistence\Base\SpyPermissionQuery;
use Spryker\Zed\Kernel\AbstractBundleDependencyProvider;
use Spryker\Zed\Kernel\Container;

/**
 * @codeCoverageIgnore
 */
class CompanyBusinessUnitCartSearchRestApiDependencyProvider extends AbstractBundleDependencyProvider
{
    /**
     * @var string
     */
    public const PROPEL_QUERY_COMPANY_BUSINESS_UNIT = 'PROPEL_QUERY_COMPANY_BUSINESS_UNIT';

    /**
     * @var string
     */
    public const PROPEL_QUERY_PERMISSION = 'PROPEL_QUERY_PERMISSION';

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    public function providePersistenceLayerDependencies(Container $container): Container
    {
        $container = parent::providePersistenceLayerDependencies($container);

        $container = $this->addCompanyBusinessUnitQuery($container);

        return $this->addPermissionQuery($container);
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addCompanyBusinessUnitQuery(Container $container): Container
    {
        $container[static::PROPEL_QUERY_COMPANY_BUSINESS_UNIT] = static function () {
            return SpyCompanyBusinessUnitQuery::create();
        };

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addPermissionQuery(Container $container): Container
    {
        $container[static::PROPEL_QUERY_PERMISSION] = static function () {
            return SpyPermissionQuery::create();
        };

        return $container;
    }
}
