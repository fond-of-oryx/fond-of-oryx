<?php

namespace FondOfOryx\Glue\ProductListSearchRestApi;

use Spryker\Glue\Kernel\AbstractBundleDependencyProvider;
use Spryker\Glue\Kernel\Container;

class ProductListSearchRestApiDependencyProvider extends AbstractBundleDependencyProvider
{
    /**
     * @var string
     */
    public const PLUGINS_FILTER_FIELDS_EXPANDER = 'PLUGINS_FILTER_FIELDS_EXPANDER';

    /**
     * @param \Spryker\Glue\Kernel\Container $container
     *
     * @return \Spryker\Glue\Kernel\Container
     */
    public function provideDependencies(Container $container): Container
    {
        $container = parent::provideDependencies($container);

        $container = $this->addFilterFieldsExpanderPlugins($container);

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
     * @return array<\FondOfOryx\Glue\ProductListSearchRestApiExtension\Dependency\Plugin\FilterFieldsExpanderPluginInterface>
     */
    protected function getFilterFieldsExpanderPlugins(): array
    {
        return [];
    }
}
