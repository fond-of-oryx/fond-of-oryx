<?php

namespace FondOfOryx\Zed\CompanyUnitAddressSalesConnector;

use Orm\Zed\Sales\Persistence\Base\SpySalesOrderAddressQuery;
use Spryker\Zed\Kernel\AbstractBundleDependencyProvider;
use Spryker\Zed\Kernel\Container;

/**
 * @codeCoverageIgnore
 */
class CompanyUnitAddressSalesConnectorDependencyProvider extends AbstractBundleDependencyProvider
{
    /**
     * @var string
     */
    public const PROPEL_QUERY_SALES_ORDER_ADDRESS = 'PROPEL_QUERY_SALES_ORDER_ADDRESS';

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    public function providePersistenceLayerDependencies(Container $container): Container
    {
        $container = parent::providePersistenceLayerDependencies($container);

        return $this->addSalesOrderAddressQuery($container);
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addSalesOrderAddressQuery(Container $container): Container
    {
        $container[static::PROPEL_QUERY_SALES_ORDER_ADDRESS] = static function () {
            return SpySalesOrderAddressQuery::create();
        };

        return $container;
    }
}
