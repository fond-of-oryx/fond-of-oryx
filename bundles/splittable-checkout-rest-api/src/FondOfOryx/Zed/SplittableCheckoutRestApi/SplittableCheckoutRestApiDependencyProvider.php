<?php

namespace FondOfOryx\Zed\SplittableCheckoutRestApi;

use FondOfOryx\Zed\SplittableCheckoutRestApi\Dependency\Facade\SplittableCheckoutRestApiToCalculationFacadeBridge;
use FondOfOryx\Zed\SplittableCheckoutRestApi\Dependency\Facade\SplittableCheckoutRestApiToCartFacadeBridge;
use FondOfOryx\Zed\SplittableCheckoutRestApi\Dependency\Facade\SplittableCheckoutRestApiToCartsRestApiFacadeBridge;
use FondOfOryx\Zed\SplittableCheckoutRestApi\Dependency\Facade\SplittableCheckoutRestApiToCustomerFacadeBridge;
use FondOfOryx\Zed\SplittableCheckoutRestApi\Dependency\Facade\SplittableCheckoutRestApiToPaymentFacadeBridge;
use FondOfOryx\Zed\SplittableCheckoutRestApi\Dependency\Facade\SplittableCheckoutRestApiToQuoteFacadeBridge;
use FondOfOryx\Zed\SplittableCheckoutRestApi\Dependency\Facade\SplittableCheckoutRestApiToShipmentFacadeBridge;
use FondOfOryx\Zed\SplittableCheckoutRestApi\Dependency\Facade\SplittableCheckoutRestApiToSplittableCheckoutFacadeBridge;
use Spryker\Zed\Kernel\AbstractBundleDependencyProvider;
use Spryker\Zed\Kernel\Container;

class SplittableCheckoutRestApiDependencyProvider extends AbstractBundleDependencyProvider
{
    public const FACADE_CART = 'FACADE_CART';
    public const FACADE_CARTS_REST_API = 'FACADE_CARTS_REST_API';
    public const FACADE_SPLITTABLE_CHECKOUT = 'FACADE_SPLITTABLE_CHECKOUT';
    public const FACADE_CUSTOMER = 'FACADE_CUSTOMER';
    public const FACADE_PAYMENT = 'FACADE_PAYMENT';
    public const FACADE_QUOTE = 'FACADE_QUOTE';
    public const FACADE_SHIPMENT = 'FACADE_SHIPMENT';
    public const FACADE_CALCULATION = 'FACADE_CALCULATION';
    public const PLUGINS_QUOTE_MAPPER = 'PLUGINS_QUOTE_MAPPER';
    public const PLUGINS_SPLITTABLE_CHECKOUT_DATA_VALIDATOR = 'PLUGINS_SPLITTABLE_CHECKOUT_DATA_VALIDATOR';

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    public function provideBusinessLayerDependencies(Container $container): Container
    {
        $container = parent::provideBusinessLayerDependencies($container);
        $container = $this->addCartFacade($container);
        $container = $this->addCartsRestApiFacade($container);
        $container = $this->addSplittableCheckoutFacade($container);
        $container = $this->addCustomerFacade($container);
        $container = $this->addPaymentFacade($container);
        $container = $this->addQuoteFacade($container);
        $container = $this->addShipmentFacade($container);
        $container = $this->addCalculationFacade($container);
        $container = $this->addQuoteMapperPlugins($container);
        $container = $this->addSplittableCheckoutDataValidatorPlugins($container);

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addCartFacade(Container $container): Container
    {
        $container[static::FACADE_CART] = function (Container $container) {
            return new SplittableCheckoutRestApiToCartFacadeBridge($container->getLocator()->cart()->facade());
        };

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addCartsRestApiFacade(Container $container): Container
    {
        $container[static::FACADE_CARTS_REST_API] = function (Container $container) {
            return new SplittableCheckoutRestApiToCartsRestApiFacadeBridge($container->getLocator()->cartsRestApi()->facade());
        };

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addSplittableCheckoutFacade(Container $container): Container
    {
        $container[static::FACADE_SPLITTABLE_CHECKOUT] = function (Container $container) {
            return new SplittableCheckoutRestApiToSplittableCheckoutFacadeBridge(
                $container->getLocator()->splittableCheckout()->facade()
            );
        };

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addCustomerFacade(Container $container): Container
    {
        $container[static::FACADE_CUSTOMER] = function (Container $container) {
            return new SplittableCheckoutRestApiToCustomerFacadeBridge($container->getLocator()->customer()->facade());
        };

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addPaymentFacade(Container $container): Container
    {
        $container[static::FACADE_PAYMENT] = function (Container $container) {
            return new SplittableCheckoutRestApiToPaymentFacadeBridge($container->getLocator()->payment()->facade());
        };

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addQuoteFacade(Container $container): Container
    {
        $container[static::FACADE_QUOTE] = function (Container $container) {
            return new SplittableCheckoutRestApiToQuoteFacadeBridge($container->getLocator()->quote()->facade());
        };

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addShipmentFacade(Container $container): Container
    {
        $container[static::FACADE_SHIPMENT] = function (Container $container) {
            return new SplittableCheckoutRestApiToShipmentFacadeBridge($container->getLocator()->shipment()->facade());
        };

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addCalculationFacade(Container $container): Container
    {
        $container[static::FACADE_CALCULATION] = function (Container $container) {
            return new SplittableCheckoutRestApiToCalculationFacadeBridge($container->getLocator()->calculation()->facade());
        };

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addQuoteMapperPlugins(Container $container): Container
    {
        $container[static::PLUGINS_QUOTE_MAPPER] = function () {
            return $this->getQuoteMapperPlugins();
        };

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addSplittableCheckoutDataValidatorPlugins(Container $container): Container
    {
        $container->set(static::PLUGINS_SPLITTABLE_CHECKOUT_DATA_VALIDATOR, function () {
            return $this->getSplittableCheckoutDataValidatorPlugins();
        });

        return $container;
    }

    /**
     * @return \FondOfOryx\Zed\SplittableCheckoutRestApiExtension\Dependency\Plugin\QuoteMapperPluginInterface[]
     */
    protected function getQuoteMapperPlugins(): array
    {
        return [];
    }

    /**
     * @return \FondOfOryx\Zed\SplittableCheckoutRestApiExtension\Dependency\Plugin\SplittableCheckoutDataValidatorPluginInterface[]
     */
    protected function getSplittableCheckoutDataValidatorPlugins(): array
    {
        return [];
    }
}
