<?php

namespace FondOfOryx\Zed\OrderBudgetCompanyBusinessUnitConnector;

use FondOfOryx\Zed\OrderBudgetCompanyBusinessUnitConnector\Dependency\Facade\OrderBudgetCompanyBusinessUnitConnectorToOrderBudgetFacadeBridge;
use Orm\Zed\CompanyBusinessUnit\Persistence\Base\SpyCompanyBusinessUnitQuery;
use Spryker\Zed\Kernel\AbstractBundleDependencyProvider;
use Spryker\Zed\Kernel\Container;

class OrderBudgetCompanyBusinessUnitConnectorDependencyProvider extends AbstractBundleDependencyProvider
{
    public const QUERY_COMPANY_BUSINESS_UNIT = 'QUERY_COMPANY_BUSINESS_UNIT';
    public const FACADE_ORDER_BUDGET = 'FACADE_ORDER_BUDGET';

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    public function provideBusinessLayerDependencies(Container $container): Container
    {
        $container = parent::provideBusinessLayerDependencies($container);

        return $this->addOrderBudgetFacade($container);
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addOrderBudgetFacade(Container $container): Container
    {
        $container[static::FACADE_ORDER_BUDGET] = static function (Container $container) {
            return new OrderBudgetCompanyBusinessUnitConnectorToOrderBudgetFacadeBridge(
                $container->getLocator()->orderBudget()->facade()
            );
        };

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    public function providePersistenceLayerDependencies(Container $container): Container
    {
        $container = parent::providePersistenceLayerDependencies($container);

        return $this->addSpyCompanyBusinessUnitQuery($container);
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addSpyCompanyBusinessUnitQuery(Container $container): Container
    {
        $container[static::QUERY_COMPANY_BUSINESS_UNIT] = static function () {
            return SpyCompanyBusinessUnitQuery::create();
        };

        return $container;
    }
}
