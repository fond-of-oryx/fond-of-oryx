<?php

namespace FondOfOryx\Zed\CustomerProductListConnectorGui;

use FondOfOryx\Zed\CustomerProductListConnectorGui\Dependency\Facade\CustomerProductListConnectorGuiToCustomerFacadeBridge;
use FondOfOryx\Zed\CustomerProductListConnectorGui\Dependency\Facade\CustomerProductListConnectorGuiToCustomerProductListConnectorFacadeBridge;
use FondOfOryx\Zed\CustomerProductListConnectorGui\Dependency\Service\CustomerProductListConnectorGuiToUtilEncodingServiceBridge;
use FondOfOryx\Zed\CustomerProductListConnectorGui\Dependency\Service\CustomerProductListConnectorGuiToUtilSanitizeServiceBridge;
use Spryker\Zed\Kernel\AbstractBundleDependencyProvider;
use Spryker\Zed\Kernel\Container;

class CustomerProductListConnectorGuiDependencyProvider extends AbstractBundleDependencyProvider
{
    /**
     * @var string
     */
    public const FACADE_CUSTOMER = 'FACADE_CUSTOMER';

    /**
     * @var string
     */
    public const FACADE_CUSTOMER_PRODUCT_LIST_CONNECTOR = 'FACADE_CUSTOMER_PRODUCT_LIST_CONNECTOR';

    /**
     * @var string
     */
    public const SERVICE_UTIL_SANITIZE = 'SERVICE_UTIL_SANITIZE';

    /**
     * @var string
     */
    public const SERVICE_UTIL_ENCODING = 'SERVICE_UTIL_ENCODING';

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    public function provideCommunicationLayerDependencies(Container $container): Container
    {
        $container = parent::provideCommunicationLayerDependencies($container);

        $container = $this->addCustomerFacade($container);
        $container = $this->addCustomerProductListConnectorFacade($container);
        $container = $this->addUtilSanitizeService($container);

        return $this->addUtilEncodingService($container);
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addCustomerFacade(Container $container): Container
    {
        $container[static::FACADE_CUSTOMER] = static function (Container $container) {
            return new CustomerProductListConnectorGuiToCustomerFacadeBridge(
                $container->getLocator()->customer()->facade(),
            );
        };

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addCustomerProductListConnectorFacade(Container $container): Container
    {
        $container[static::FACADE_CUSTOMER_PRODUCT_LIST_CONNECTOR] = static function (Container $container) {
            return new CustomerProductListConnectorGuiToCustomerProductListConnectorFacadeBridge(
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
    protected function addUtilSanitizeService(Container $container): Container
    {
        $container[static::SERVICE_UTIL_SANITIZE] = static function (Container $container) {
            return new CustomerProductListConnectorGuiToUtilSanitizeServiceBridge(
                $container->getLocator()->utilSanitize()->service(),
            );
        };

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addUtilEncodingService(Container $container): Container
    {
        $container[static::SERVICE_UTIL_ENCODING] = static function (Container $container) {
            return new CustomerProductListConnectorGuiToUtilEncodingServiceBridge(
                $container->getLocator()->utilEncoding()->service(),
            );
        };

        return $container;
    }
}
