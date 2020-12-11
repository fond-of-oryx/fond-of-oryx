<?php

namespace FondOfOryx\Zed\ErpOrderApi;

use FondOfOryx\Zed\ErpOrderApi\Dependency\Facade\ErpOrderApiToErpOrderFacadeBridge;
use FondOfOryx\Zed\ErpOrderApi\Dependency\QueryContainer\ErpOrderApiToApiQueryBuilderQueryContainerBridge;
use FondOfOryx\Zed\ErpOrderApi\Dependency\QueryContainer\ErpOrderApiToApiQueryContainerBridge;
use Orm\Zed\ErpOrder\Persistence\FooErpOrderQuery;
use Spryker\Zed\Kernel\AbstractBundleDependencyProvider;
use Spryker\Zed\Kernel\Container;

class ErpOrderApiDependencyProvider extends AbstractBundleDependencyProvider
{
    public const FACADE_ERP_ORDER = 'FACADE_ERP_ORDER';
    public const QUERY_CONTAINER_API = 'QUERY_CONTAINER_API';
    public const QUERY_CONTAINER_API_QUERY_BUILDER = 'QUERY_CONTAINER_API_QUERY_BUILDER';
    public const PROPEL_QUERY_ERP_ORDER = 'PROPEL_QUERY_ERP_ORDER';

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    public function provideBusinessLayerDependencies(Container $container): Container
    {
        $container = parent::provideBusinessLayerDependencies($container);

        $container = $this->addErpOrderFacade($container);
        $container = $this->addApiQueryContainer($container);

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addErpOrderFacade(Container $container): Container
    {
        $container[static::FACADE_ERP_ORDER] = static function (Container $container) {
            return new ErpOrderApiToErpOrderFacadeBridge(
                $container->getLocator()->erpOrder()->facade()
            );
        };

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addApiQueryContainer(Container $container): Container
    {
        $container[static::QUERY_CONTAINER_API] = static function (Container $container) {
            return new ErpOrderApiToApiQueryContainerBridge(
                $container->getLocator()->api()->queryContainer()
            );
        };

        return $container;
    }

    /**
     * @codeCoverageIgnore
     *
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    public function providePersistenceLayerDependencies(Container $container): Container
    {
        $container = parent::providePersistenceLayerDependencies($container);

        $this->addErpOrderPropelQuery($container);
        $this->addApiQueryContainer($container);
        $this->addApiQueryBuilderQueryContainer($container);

        return $container;
    }

    /**
     * @codeCoverageIgnore
     *
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addErpOrderPropelQuery(Container $container): Container
    {
        $container[static::PROPEL_QUERY_ERP_ORDER] = static function () {
            return FooErpOrderQuery::create();
        };

        return $container;
    }

    /**
     * @codeCoverageIgnore
     *
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addApiQueryBuilderQueryContainer(Container $container): Container
    {
        $container[static::QUERY_CONTAINER_API_QUERY_BUILDER] = static function (Container $container) {
            return new ErpOrderApiToApiQueryBuilderQueryContainerBridge(
                $container->getLocator()->apiQueryBuilder()->queryContainer()
            );
        };

        return $container;
    }
}
