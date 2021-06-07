<?php

namespace FondOfOryx\Zed\ReturnLabelsRestApiCustomerConnector;

use FondOfOryx\Zed\ReturnLabelsRestApiCustomerConnector\Dependency\Facade\ReturnLabelsRestApiCustomerConnectorToCustomerFacadeBridge;
use Spryker\Zed\Kernel\AbstractBundleDependencyProvider;
use Spryker\Zed\Kernel\Container;

class ReturnLabelsRestApiCustomerConnectorDependencyProvider extends AbstractBundleDependencyProvider
{
    public const FACADE_CUSTOMER = 'FACADE_CUSTOMER';

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    public function provideBusinessLayerDependencies(Container $container): Container
    {
        $container = parent::provideBusinessLayerDependencies($container);
        $container = $this->addCustomerFacade($container);

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addCustomerFacade(Container $container): Container
    {
        $container[static::FACADE_CUSTOMER] = static function (Container $container) {
            return new ReturnLabelsRestApiCustomerConnectorToCustomerFacadeBridge(
                $container->getLocator()->customer()->facade()
            );
        };

        return $container;
    }
}
