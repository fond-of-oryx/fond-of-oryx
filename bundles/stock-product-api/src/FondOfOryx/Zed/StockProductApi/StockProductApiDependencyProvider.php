<?php

namespace FondOfOryx\Zed\StockProductApi;

use FondOfOryx\Zed\StockProductApi\Dependency\Facade\StockProductApiToApiFacadeBridge;
use FondOfOryx\Zed\StockProductApi\Dependency\Facade\StockProductApiToStockBridge;
use FondOfOryx\Zed\StockProductApi\Dependency\QueryContainer\StockProductApiToApiQueryBuilderQueryContainerBridge;
use Orm\Zed\Stock\Persistence\SpyStockProductQuery;
use Spryker\Zed\Kernel\AbstractBundleDependencyProvider;
use Spryker\Zed\Kernel\Container;

class StockProductApiDependencyProvider extends AbstractBundleDependencyProvider
{
    /**
     * @var string
     */
    public const FACADE_API = 'QUERY_CONTAINER_API';

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
    public const PROPEL_QUERY_STOCK_PRODUCT = 'PROPEL_QUERY_STOCK_PRODUCT';

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

        return $this->addPropelStockProductQuery($container);
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function provideApiFacade(Container $container): Container
    {
        $container[static::FACADE_API] = static function (Container $container) {
            return new StockProductApiToApiFacadeBridge($container->getLocator()->api()->facade());
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
            return new StockProductApiToApiQueryBuilderQueryContainerBridge(
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
    protected function provideStockFacade(Container $container)
    {
        $container[static::FACADE_STOCK] = static function (Container $container) {
            return new StockProductApiToStockBridge($container->getLocator()->stock()->facade());
        };

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addPropelStockProductQuery(Container $container): Container
    {
        $container[static::PROPEL_QUERY_STOCK_PRODUCT] = static function () {
            return SpyStockProductQuery::create();
        };

        return $container;
    }
}
