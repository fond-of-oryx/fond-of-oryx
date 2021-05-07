<?php


namespace FondOfOryx\Zed\ReturnLabelsRestApiCompanyBusinessUnitConnector;


use Orm\Zed\CompanyBusinessUnit\Persistence\SpyCompanyBusinessUnitQuery;
use Spryker\Zed\Kernel\AbstractBundleDependencyProvider;
use Spryker\Zed\Kernel\Container;

class ReturnLabelsRestApiCompanyBusinessUnitDependencyProvider extends AbstractBundleDependencyProvider
{
    public const PROPEL_QUERY_COMPANY_BUSINESS_UNIT_QUERY = 'PROPEL_QUERY_COMPANY_BUSINESS_UNIT_QUERY';

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    public function providePersistenceLayerDependencies(Container $container): Container
    {
        $container = parent::providePersistenceLayerDependencies($container);
        $container = $this->addCompanyBusinessUnitPropelQuery($container);

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addCompanyBusinessUnitPropelQuery(Container $container): Container
    {
        $container[static::PROPEL_QUERY_COMPANY_BUSINESS_UNIT_QUERY] = static function () {
            return SpyCompanyBusinessUnitQuery::create();
        };

        return $container;
    }
}
