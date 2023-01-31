<?php

namespace FondOfOryx\Zed\StockApi;

use FondOfOryx\Zed\StockApi\Dependency\Facade\StockApiToApiFacadeBridge;
use FondOfOryx\Zed\StockApi\Dependency\Facade\StockApiToStockBridge;
use FondOfOryx\Zed\StockApi\Dependency\QueryContainer\StockApiToApiQueryBuilderQueryContainerBridge;
use Orm\Zed\Stock\Persistence\SpyStockQuery;
use Spryker\Zed\Kernel\AbstractBundleDependencyProvider;
use Spryker\Zed\Kernel\Container;

class StockApiDependencyProvider extends AbstractBundleDependencyProvider
{
    /**
     * @var string
     */
    public const FACADE_API = 'FACADE_API';

    /**
     * @var string
     */
    public const QUERY_CONTAINER_API_QUERY_BUILDER = 'QUERY_CONTAINER_API_QUERY_BUILDER';

    /**
     * @var string
     */
    public const FACADE_STOCK = 'FACADE_STOCK';

    /**
     * @var string
     */
    public const PROPEL_QUERY_STOCK = 'PROPEL_QUERY_STOCK';

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    public function provideBusinessLayerDependencies(Container $container): Container
    {
        $container = parent::provideBusinessLayerDependencies($container);

        $container = $this->provideApiFacade($container);
        $container = $this->provideApiQueryBuilderQueryContainer($container);

        return $this->provideStockFacade($container);
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    public function providePersistenceLayerDependencies(Container $container): Container
    {
        $container = parent::providePersistenceLayerDependencies($container);

        return $this->addPropelStockQuery($container);
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function provideApiFacade(Container $container): Container
    {
        $container[static::FACADE_API] = static function (Container $container) {
            return new StockApiToApiFacadeBridge($container->getLocator()->api()->facade());
        };

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function provideApiQueryBuilderQueryContainer(Container $container): Container
    {
        $container[static::QUERY_CONTAINER_API_QUERY_BUILDER] = static function (Container $container) {
            return new StockApiToApiQueryBuilderQueryContainerBridge(
                $container->getLocator()->apiQueryBuilder()->queryContainer(),
            );
        };

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function provideStockFacade(Container $container): Container
    {
        $container[static::FACADE_STOCK] = static function (Container $container) {
            return new StockApiToStockBridge($container->getLocator()->stock()->facade());
        };

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addPropelStockQuery(Container $container): Container
    {
        $container[static::PROPEL_QUERY_STOCK] = static function () {
            return SpyStockQuery::create();
        };

        return $container;
    }
}
