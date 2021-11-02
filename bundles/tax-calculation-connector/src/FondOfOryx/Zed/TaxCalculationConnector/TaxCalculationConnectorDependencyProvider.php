<?php

namespace FondOfOryx\Zed\TaxCalculationConnector;

use FondOfOryx\Zed\TaxCalculationConnector\Dependency\Facade\TaxCalculationConnectorToTaxBridge;
use FondOfOryx\Zed\TaxCalculationConnector\Dependency\QueryContainer\TaxProductConnectorQueryContainerBridge;
use Spryker\Zed\Kernel\AbstractBundleDependencyProvider;
use Spryker\Zed\Kernel\Container;

class TaxCalculationConnectorDependencyProvider extends AbstractBundleDependencyProvider
{
    /**
     * @var string
     */
    public const FACADE_TAX = 'FACADE_TAX';

    /**
     * @var string
     */
    public const QUERY_CONTAINER_PRODUCT_TAX = 'QUERY_CONTAINER_PRODUCT_TAX';

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    public function provideBusinessLayerDependencies(Container $container): Container
    {
        $container = $this->addTaxFacade($container);

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    public function providePersistenceLayerDependencies(Container $container): Container
    {
        $container = $this->addProductTaxConnectorQueryConnector($container);

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addProductTaxConnectorQueryConnector(Container $container): Container
    {
        $container[static::QUERY_CONTAINER_PRODUCT_TAX] = function (Container $container) {
            return new TaxProductConnectorQueryContainerBridge(
                $container->getLocator()->taxProductConnector()->queryContainer(),
            );
        };

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addTaxFacade(Container $container): Container
    {
        $container[static::FACADE_TAX] = function (Container $container) {
            return new TaxCalculationConnectorToTaxBridge($container->getLocator()->tax()->facade());
        };

        return $container;
    }
}
