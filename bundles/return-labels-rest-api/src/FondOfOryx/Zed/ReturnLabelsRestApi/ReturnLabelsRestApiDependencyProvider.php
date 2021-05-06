<?php

namespace FondOfOryx\Zed\ReturnLabelsRestApi;

use FondOfOryx\Zed\ReturnLabelsRestApi\Dependency\Facade\ReturnLabelsRestApiToReturnLabelFacadeBridge;
use Spryker\Zed\Kernel\AbstractBundleDependencyProvider;
use Spryker\Zed\Kernel\Container;

class ReturnLabelsRestApiDependencyProvider extends AbstractBundleDependencyProvider
{
    public const FACADE_RETURN_LABEL = 'FACADE_RETURN_LABEL';

    public const PLUGINS_RETURN_LABEL_REQUEST_EXPANDER = 'PLUGINS_RETURN_LABEL_REQUEST_EXPANDER';

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    public function provideBusinessLayerDependencies(Container $container)
    {
        $container = parent::provideBusinessLayerDependencies($container);

        $container = $this->addReturnLabelRequestExpanderPlugins($container);

        return $this->addReturnLabelFacade($container);
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addReturnLabelFacade(Container $container): Container
    {
        $container[static::FACADE_RETURN_LABEL] = static function (Container $container) {
            return new ReturnLabelsRestApiToReturnLabelFacadeBridge(
                $container->getLocator()->returnLabel()->facade()
            );
        };

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addReturnLabelRequestExpanderPlugins(Container $container): Container
    {
        $self = $this;

        $container[static::PLUGINS_RETURN_LABEL_REQUEST_EXPANDER] = static function () use ($self) {
            return $self->getReturnLabelRequestExpanderPlugins();
        };

        return $container;
    }

    /**
     * @return \FondOfOryx\Zed\ReturnLabelsRestApiExtension\Dependency\Plugin\ReturnLabelRequestExpanderPluginInterface[]
     */
    protected function getReturnLabelRequestExpanderPlugins(): array
    {
        return [];
    }
}
