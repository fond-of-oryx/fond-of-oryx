<?php

namespace FondOfOryx\Glue\CartSearchRestApi;

use FondOfOryx\Glue\CartSearchRestApi\Dependency\Client\CartSearchRestApiToGlossaryStorageClientBridge;
use FondOfOryx\Glue\CartSearchRestApi\Dependency\Service\CartSearchRestApiToUtilEncodingServiceBridge;
use Spryker\Glue\Kernel\AbstractBundleDependencyProvider;
use Spryker\Glue\Kernel\Container;

/**
 * @codeCoverageIgnore
 */
class CartSearchRestApiDependencyProvider extends AbstractBundleDependencyProvider
{
 /**
  * @var string
  */
    public const PLUGINS_FILTER_FIELDS_EXPANDER = 'PLUGINS_FILTER_FIELDS_EXPANDER';

     /**
      * @var string
      */
    public const CLIENT_GLOSSARY_STORAGE = 'CLIENT_GLOSSARY_STORAGE';

    /**
     * @var string
     */
    public const SERVICE_UTIL_ENCODING = 'SERVICE_UTIL_ENCODING';

    /**
     * @param \Spryker\Glue\Kernel\Container $container
     *
     * @return \Spryker\Glue\Kernel\Container
     */
    public function provideDependencies(Container $container): Container
    {
        $container = parent::provideDependencies($container);

        $container = $this->addGlossaryStorageClient($container);
        $container = $this->addFilterFieldsExpanderPlugins($container);

        return $this->addUtilEncodingService($container);
    }

    /**
     * @param \Spryker\Glue\Kernel\Container $container
     *
     * @return \Spryker\Glue\Kernel\Container
     */
    protected function addGlossaryStorageClient(Container $container): Container
    {
        $container[static::CLIENT_GLOSSARY_STORAGE] = static function (Container $container) {
            return new CartSearchRestApiToGlossaryStorageClientBridge(
                $container->getLocator()->glossaryStorage()->client(),
            );
        };

        return $container;
    }

    /**
     * @param \Spryker\Glue\Kernel\Container $container
     *
     * @return \Spryker\Glue\Kernel\Container
     */
    protected function addFilterFieldsExpanderPlugins(Container $container): Container
    {
        $self = $this;

        $container[static::PLUGINS_FILTER_FIELDS_EXPANDER] = static function () use ($self) {
            return $self->getFilterFieldsExpanderPlugins();
        };

        return $container;
    }

    /**
     * @return array<\FondOfOryx\Glue\CartSearchRestApiExtension\Dependency\Plugin\FilterFieldsExpanderPluginInterface>
     */
    protected function getFilterFieldsExpanderPlugins(): array
    {
        return [];
    }

    /**
     * @param \Spryker\Glue\Kernel\Container $container
     *
     * @return \Spryker\Glue\Kernel\Container
     */
    protected function addUtilEncodingService(Container $container): Container
    {
        $container[static::SERVICE_UTIL_ENCODING] = static function (Container $container) {
            return new CartSearchRestApiToUtilEncodingServiceBridge(
                $container->getLocator()->utilEncoding()->service(),
            );
        };

        return $container;
    }
}
