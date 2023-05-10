<?php

namespace FondOfOryx\Zed\OrderBudgetSearchRestApi;

use FondOfOryx\Zed\OrderBudgetSearchRestApi\Dependency\Facade\OrderBudgetSearchRestApiToOrderBudgetFacadeBridge;
use Orm\Zed\OrderBudget\Persistence\Base\FooOrderBudgetQuery;
use Spryker\Zed\Kernel\AbstractBundleDependencyProvider;
use Spryker\Zed\Kernel\Container;

/**
 * @codeCoverageIgnore
 */
class OrderBudgetSearchRestApiDependencyProvider extends AbstractBundleDependencyProvider
{
    /**
     * @var string
     */
    public const PROPEL_QUERY_ORDER_BUDGET = 'PROPEL_ORDER_BUDGET';

    /**
     * @var string
     */
    public const PLUGINS_SEARCH_ORDER_BUDGET_QUERY_EXPANDER = 'PLUGINS_SEARCH_ORDER_BUDGET_QUERY_EXPANDER';

    /**
     * @var string
     */
    public const FACADE_ORDER_BUDGET = 'FACADE_ORDER_BUDGET';

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    public function provideBusinessLayerDependencies(Container $container): Container
    {
        $container = parent::provideBusinessLayerDependencies($container);

        $container = $this->addOrderBudgetFacade($container);

        return $this->addSearchOrderBudgetQueryExpanderPlugins($container);
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addOrderBudgetFacade(Container $container): Container
    {
        $container[static::FACADE_ORDER_BUDGET] = static fn (
            Container $container
        ) => new OrderBudgetSearchRestApiToOrderBudgetFacadeBridge(
            $container->getLocator()->orderBudget()->facade(),
        );

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addSearchOrderBudgetQueryExpanderPlugins(Container $container): Container
    {
        $container[static::PLUGINS_SEARCH_ORDER_BUDGET_QUERY_EXPANDER] = fn () => $this->getSearchOrderBudgetQueryExpanderPlugins();

        return $container;
    }

    /**
     * @return array<\FondOfOryx\Zed\OrderBudgetSearchRestApiExtension\Dependency\Plugin\SearchOrderBudgetQueryExpanderPluginInterface>
     */
    protected function getSearchOrderBudgetQueryExpanderPlugins(): array
    {
        return [];
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    public function providePersistenceLayerDependencies(Container $container): Container
    {
        $container = parent::providePersistenceLayerDependencies($container);

        return $this->addOrderBudgetQuery($container);
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addOrderBudgetQuery(Container $container): Container
    {
        $container[static::PROPEL_QUERY_ORDER_BUDGET] = static fn () => FooOrderBudgetQuery::create();

        return $container;
    }
}
