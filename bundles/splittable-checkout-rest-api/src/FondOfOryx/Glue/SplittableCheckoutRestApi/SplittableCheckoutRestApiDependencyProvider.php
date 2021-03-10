<?php

namespace FondOfOryx\Glue\SplittableCheckoutRestApi;

use FondOfOryx\Glue\SplittableCheckoutRestApi\Dependency\Client\SplittableCheckoutRestApiToCheckoutRestApiClientBridge;
use FondOfOryx\Glue\SplittableCheckoutRestApi\Dependency\Client\SplittableCheckoutRestApiToGlossaryStorageClientBridge;
use Spryker\Glue\Kernel\AbstractBundleDependencyProvider;
use Spryker\Glue\Kernel\Container;

/**
 * @method \FondOfOryx\Glue\SplittableCheckoutRestApi\SplittableCheckoutRestApiConfig getConfig()
 */
class SplittableCheckoutRestApiDependencyProvider extends AbstractBundleDependencyProvider
{
    public const CLIENT_CHECKOUT_REST_API = 'CLIENT_CHECKOUT_REST_API';
    public const CLIENT_GLOSSARY_STORAGE = 'CLIENT_GLOSSARY_STORAGE';
    public const PLUGINS_SPLITTABLE_CHECKOUT_REQUEST_VALIDATOR = 'PLUGINS_SPLITTABLE_CHECKOUT_REQUEST_VALIDATOR';
    public const PLUGINS_SPLITTABLE_CHECKOUT_REQUEST_ATTRIBUTES_VALIDATOR = 'PLUGINS_SPLITTABLE_CHECKOUT_REQUEST_ATTRIBUTES_VALIDATOR';
    public const PLUGINS_SPLITTABLE_CHECKOUT_REQUEST_EXPANDER = 'PLUGINS_SPLITTABLE_CHECKOUT_REQUEST_EXPANDER';

    /**
     * @param \Spryker\Glue\Kernel\Container $container
     *
     * @return \Spryker\Glue\Kernel\Container
     */
    public function provideDependencies(Container $container): Container
    {
        $container = parent::provideDependencies($container);

        $container = $this->addCheckoutRestApiClient($container);
        $container = $this->addGlossaryStorageClient($container);
        $container = $this->addSplittableCheckoutRequestValidatorPlugins($container);
        $container = $this->addSplittableCheckoutRequestAttributesValidatorPlugins($container);
        $container = $this->addSplittableCheckoutRequestExpanderPlugins($container);

        return $container;
    }

    /**
     * @param \Spryker\Glue\Kernel\Container $container
     *
     * @return \Spryker\Glue\Kernel\Container
     */
    protected function addCheckoutRestApiClient(Container $container): Container
    {
        $container[static::CLIENT_CHECKOUT_REST_API] = static function (Container $container) {
            return new SplittableCheckoutRestApiToCheckoutRestApiClientBridge(
                $container->getLocator()->checkoutRestApi()->client()
            );
        };

        return $container;
    }

    /**
     * @param \Spryker\Glue\Kernel\Container $container
     *
     * @return \Spryker\Glue\Kernel\Container
     */
    protected function addGlossaryStorageClient(Container $container): Container
    {
        $container->set(static::CLIENT_GLOSSARY_STORAGE, function (Container $container) {
            return new SplittableCheckoutRestApiToGlossaryStorageClientBridge(
                $container->getLocator()->glossaryStorage()->client()
            );
        });

        return $container;
    }

    /**
     * @param \Spryker\Glue\Kernel\Container $container
     *
     * @return \Spryker\Glue\Kernel\Container
     */
    protected function addSplittableCheckoutRequestAttributesValidatorPlugins(Container $container): Container
    {
        $container[static::PLUGINS_SPLITTABLE_CHECKOUT_REQUEST_ATTRIBUTES_VALIDATOR] = function () {
            return $this->getSplittableCheckoutRequestAttributesValidatorPlugins();
        };

        return $container;
    }

    /**
     * @param \Spryker\Glue\Kernel\Container $container
     *
     * @return \Spryker\Glue\Kernel\Container
     */
    protected function addSplittableCheckoutRequestValidatorPlugins(Container $container): Container
    {
        $container[static::PLUGINS_SPLITTABLE_CHECKOUT_REQUEST_VALIDATOR] = function () {
            return $this->getSplittableCheckoutRequestValidatorPlugins();
        };

        return $container;
    }

    /**
     * @param \Spryker\Glue\Kernel\Container $container
     *
     * @return \Spryker\Glue\Kernel\Container
     */
    protected function addSplittableCheckoutRequestExpanderPlugins(Container $container): Container
    {
        $container->set(static::PLUGINS_SPLITTABLE_CHECKOUT_REQUEST_EXPANDER, function () {
            return $this->getSplittableCheckoutRequestExpanderPlugins();
        });

        return $container;
    }

    /**
     * @return \FondOfOryx\Glue\SplittableCheckoutRestApiExtension\Dependency\Plugin\SplittableCheckoutRequestExpanderPluginInterface[]
     */
    protected function getSplittableCheckoutRequestExpanderPlugins(): array
    {
        return [];
    }

    /**
     * @return \FondOfOryx\Glue\SplittableCheckoutRestApiExtension\Dependency\Plugin\SplittableCheckoutRequestValidatorPluginInterface[]
     */
    protected function getSplittableCheckoutRequestValidatorPlugins(): array
    {
        return [];
    }

    /**
     * @return \FondOfOryx\Glue\SplittableCheckoutRestApiExtension\Dependency\Plugin\SplittableCheckoutRequestAttributesValidatorPluginInterface[]
     */
    protected function getSplittableCheckoutRequestAttributesValidatorPlugins(): array
    {
        return [];
    }
}
