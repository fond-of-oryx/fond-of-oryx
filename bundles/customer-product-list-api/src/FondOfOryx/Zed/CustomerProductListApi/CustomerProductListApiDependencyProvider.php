<?php

namespace FondOfOryx\Zed\CustomerProductListApi;

use FondOfOryx\Zed\CustomerProductListApi\Dependency\Facade\CustomerProductListApiToCustomerProductListConnectorFacadeBridge;
use FondOfOryx\Zed\CustomerProductListApi\Dependency\QueryContainer\CustomerProductListApiToApiQueryContainerBridge;
use Spryker\Zed\Kernel\AbstractBundleDependencyProvider;
use Spryker\Zed\Kernel\Container;

class CustomerProductListApiDependencyProvider extends AbstractBundleDependencyProvider
{
    /**
     * @var string
     */
    public const FACADE_CUSTOMER_PRODUCT_LIST_CONNECTOR = 'FACADE_CUSTOMER_PRODUCT_LIST_CONNECTOR';

    /**
     * @var string
     */
    public const QUERY_CONTAINER_API = 'QUERY_CONTAINER_API';

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    public function provideBusinessLayerDependencies(Container $container)
    {
        $container = parent::provideBusinessLayerDependencies($container);

        $container = $this->addCustomerProductListConnectorFacade($container);
        $container = $this->addApiQueryContainer($container);

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addCustomerProductListConnectorFacade(Container $container)
    {
        $container[static::FACADE_CUSTOMER_PRODUCT_LIST_CONNECTOR] = function (Container $container) {
            return new CustomerProductListApiToCustomerProductListConnectorFacadeBridge(
                $container->getLocator()->customerProductListConnector()->facade(),
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
        $container[static::QUERY_CONTAINER_API] = function (Container $container) {
            return new CustomerProductListApiToApiQueryContainerBridge($container->getLocator()->api()->queryContainer());
        };

        return $container;
    }
}
