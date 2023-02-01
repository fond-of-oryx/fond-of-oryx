<?php

namespace FondOfOryx\Zed\CustomerProductListApi;

use FondOfOryx\Zed\CustomerProductListApi\Dependency\Facade\CustomerProductListApiToApiFacadeBridge;
use FondOfOryx\Zed\CustomerProductListApi\Dependency\Facade\CustomerProductListApiToCustomerProductListConnectorFacadeBridge;
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
    public const FACADE_API = 'QUERY_CONTAINER_API';

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    public function provideBusinessLayerDependencies(Container $container): Container
    {
        $container = parent::provideBusinessLayerDependencies($container);

        $container = $this->addCustomerProductListConnectorFacade($container);

        return $this->addApiFacade($container);
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addCustomerProductListConnectorFacade(Container $container): Container
    {
        $container[static::FACADE_CUSTOMER_PRODUCT_LIST_CONNECTOR] = static function (Container $container) {
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
    protected function addApiFacade(Container $container): Container
    {
        $container[static::FACADE_API] = static function (Container $container) {
            return new CustomerProductListApiToApiFacadeBridge($container->getLocator()->api()->facade());
        };

        return $container;
    }
}
