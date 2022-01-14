<?php

namespace FondOfOryx\Zed\CustomerBrandProductListConnector;

use FondOfOryx\Zed\CustomerBrandProductListConnector\Dependecny\Facade\CustomerBrandProductListConnectorToBrandCustomerFacadeBridge;
use FondOfOryx\Zed\CustomerBrandProductListConnector\Dependecny\Facade\CustomerBrandProductListConnectorToBrandProductListConnectorFacadeBridge;
use Spryker\Zed\Kernel\AbstractBundleDependencyProvider;
use Spryker\Zed\Kernel\Container;

/**
 * @codeCoverageIgnore
 */
class CustomerBrandProductListConnectorDependencyProvider extends AbstractBundleDependencyProvider
{
    /**
     * @var string
     */
    public const FACADE_BRAND_CUSTOMER = 'FACADE_BRAND_CUSTOMER';

    /**
     * @var string
     */
    public const FACADE_BRAND_PRODUCT_LIST_CONNECTOR = 'FACADE_BRAND_PRODUCT_LIST_CONNECTOR';

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    public function provideBusinessLayerDependencies(Container $container): Container
    {
        $container = parent::provideBusinessLayerDependencies($container);

        $this->addBrandCustomerFacade($container);

        return $this->addBrandProductListConnector($container);
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addBrandCustomerFacade(Container $container): Container
    {
        $container[static::FACADE_BRAND_CUSTOMER] = static function (Container $container) {
            return new CustomerBrandProductListConnectorToBrandCustomerFacadeBridge(
                $container->getLocator()->brandCustomer()->facade(),
            );
        };

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addBrandProductListConnector(Container $container): Container
    {
        $container[static::FACADE_BRAND_PRODUCT_LIST_CONNECTOR] = static function (Container $container) {
            return new CustomerBrandProductListConnectorToBrandProductListConnectorFacadeBridge(
                $container->getLocator()->brandProductListConnector()->facade(),
            );
        };

        return $container;
    }
}
