<?php

namespace FondOfOryx\Glue\SplittableCheckoutRestApi;

use Spryker\Glue\Kernel\AbstractBundleDependencyProvider;
use Spryker\Glue\Kernel\Container;

class SplittableCheckoutRestApiDependencyProvider extends AbstractBundleDependencyProvider
{
    /**
     * @var string
     */
    public const PLUGINS_REST_SPLITTABLE_CHECKOUT_EXPANDER = 'PLUGINS_REST_SPLITTABLE_CHECKOUT_EXPANDER';

    /**
     * @param \Spryker\Glue\Kernel\Container $container
     *
     * @return \Spryker\Glue\Kernel\Container
     */
    public function provideDependencies(Container $container): Container
    {
        $container = parent::provideDependencies($container);

        return $this->addRestSplittableCheckoutExpanderPlugins($container);
    }

    /**
     * @param \Spryker\Glue\Kernel\Container $container
     *
     * @return \Spryker\Glue\Kernel\Container
     */
    protected function addRestSplittableCheckoutExpanderPlugins(Container $container): Container
    {
        $self = $this;

        $container[static::PLUGINS_REST_SPLITTABLE_CHECKOUT_EXPANDER] = static function () use ($self) {
            return $self->getRestSplittableCheckoutExpanderPlugins();
        };

        return $container;
    }

    /**
     * @return array<\FondOfOryx\Glue\SplittableCheckoutRestApiExtension\Dependency\Plugin\RestSplittableCheckoutExpanderPluginInterface>
     */
    protected function getRestSplittableCheckoutExpanderPlugins(): array
    {
        return [];
    }
}
