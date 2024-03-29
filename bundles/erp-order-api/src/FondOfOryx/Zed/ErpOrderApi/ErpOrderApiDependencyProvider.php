<?php

namespace FondOfOryx\Zed\ErpOrderApi;

use FondOfOryx\Zed\ErpOrderApi\Dependency\Facade\ErpOrderApiToApiFacadeBridge;
use FondOfOryx\Zed\ErpOrderApi\Dependency\Facade\ErpOrderApiToErpOrderFacadeBridge;
use FondOfOryx\Zed\ErpOrderApi\Dependency\QueryContainer\ErpOrderApiToApiQueryBuilderQueryContainerBridge;
use Orm\Zed\ErpOrder\Persistence\ErpOrderQuery;
use Spryker\Zed\Kernel\AbstractBundleDependencyProvider;
use Spryker\Zed\Kernel\Container;

class ErpOrderApiDependencyProvider extends AbstractBundleDependencyProvider
{
    /**
     * @var string
     */
    public const FACADE_ERP_ORDER = 'FACADE_ERP_ORDER';

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

        return $this->addApiFacade($container);
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
                $container->getLocator()->erpOrder()->facade(),
            );
        };

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addApiFacade(Container $container): Container
    {
        $container[static::FACADE_API] = static function (Container $container) {
            return new ErpOrderApiToApiFacadeBridge(
                $container->getLocator()->api()->facade(),
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
        $this->addApiFacade($container);

        return $this->addApiQueryBuilderQueryContainer($container);
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
            return ErpOrderQuery::create();
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
                $container->getLocator()->apiQueryBuilder()->queryContainer(),
            );
        };

        return $container;
    }
}
