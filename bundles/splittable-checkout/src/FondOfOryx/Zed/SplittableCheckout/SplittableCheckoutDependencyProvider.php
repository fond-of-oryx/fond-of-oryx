<?php

namespace FondOfOryx\Zed\SplittableCheckout;

use FondOfOryx\Zed\SplittableCheckout\Dependency\Facade\SplittableCheckoutToCheckoutFacadeBridge;
use FondOfOryx\Zed\SplittableCheckout\Dependency\Facade\SplittableCheckoutToPermissionFacadeBridge;
use FondOfOryx\Zed\SplittableCheckout\Dependency\Facade\SplittableCheckoutToQuoteFacadeBridge;
use FondOfOryx\Zed\SplittableCheckout\Dependency\Facade\SplittableCheckoutToSplittableQuoteFacadeBridge;
use FondOfOryx\Zed\SplittableCheckoutExtension\Dependency\Plugin\IdentifierExtractorPluginInterface;
use Spryker\Zed\Kernel\AbstractBundleDependencyProvider;
use Spryker\Zed\Kernel\Container;

class SplittableCheckoutDependencyProvider extends AbstractBundleDependencyProvider
{
    /**
     * @var string
     */
    public const FACADE_CHECKOUT = 'FACADE_CHECKOUT';

    /**
     * @var string
     */
    public const FACADE_PERMISSION = 'FACADE_PERMISSION';

    /**
     * @var string
     */
    public const FACADE_QUOTE = 'FACADE_QUOTE';

    /**
     * @var string
     */
    public const FACADE_SPLITTABLE_QUOTE = 'FACADE_SPLITTABLE_QUOTE';

    /**
     * @var string
     */
    public const PLUGIN_IDENTIFIER_EXTRACTOR = 'PLUGIN_IDENTIFIER_EXTRACTOR';

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    public function provideBusinessLayerDependencies(Container $container): Container
    {
        $container = parent::provideBusinessLayerDependencies($container);

        $container = $this->addCheckoutFacade($container);
        $container = $this->addSplittableQuoteFacade($container);
        $container = $this->addQuoteFacade($container);
        $container = $this->addPermissionFacade($container);

        return $this->addIdentifierExtractorPlugin($container);
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addCheckoutFacade(Container $container): Container
    {
        $container[static::FACADE_CHECKOUT] = static function () use ($container) {
            return new SplittableCheckoutToCheckoutFacadeBridge($container->getLocator()->checkout()->facade());
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
        $container[static::FACADE_QUOTE] = static function () use ($container) {
            return new SplittableCheckoutToQuoteFacadeBridge($container->getLocator()->quote()->facade());
        };

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addSplittableQuoteFacade(Container $container): Container
    {
        $container[static::FACADE_SPLITTABLE_QUOTE] = static function () use ($container) {
            return new SplittableCheckoutToSplittableQuoteFacadeBridge(
                $container->getLocator()->splittableQuote()->facade(),
            );
        };

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addPermissionFacade(Container $container): Container
    {
        $container[static::FACADE_PERMISSION] = static function () use ($container) {
            return new SplittableCheckoutToPermissionFacadeBridge(
                $container->getLocator()->permission()->facade(),
            );
        };

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addIdentifierExtractorPlugin(Container $container): Container
    {
        $self = $this;

        $container[static::PLUGIN_IDENTIFIER_EXTRACTOR] = static function () use ($self) {
            return $self->getIdentifierExtractorPlugin();
        };

        return $container;
    }

    /**
     * @return \FondOfOryx\Zed\SplittableCheckoutExtension\Dependency\Plugin\IdentifierExtractorPluginInterface|null
     */
    protected function getIdentifierExtractorPlugin(): ?IdentifierExtractorPluginInterface
    {
        return null;
    }
}
