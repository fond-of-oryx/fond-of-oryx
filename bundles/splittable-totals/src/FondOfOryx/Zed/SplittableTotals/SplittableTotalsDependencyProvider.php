<?php

namespace FondOfOryx\Zed\SplittableTotals;

use FondOfOryx\Zed\SplittableTotals\Dependency\Facade\SplittableTotalsToSplittableQuoteFacadeBridge;
use Spryker\Zed\Kernel\AbstractBundleDependencyProvider;
use Spryker\Zed\Kernel\Container;

class SplittableTotalsDependencyProvider extends AbstractBundleDependencyProvider
{
    /**
     * @var string
     */
    public const FACADE_SPLITTABLE_QUOTE = 'FACADE_SPLITTABLE_QUOTE';

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    public function provideBusinessLayerDependencies(Container $container): Container
    {
        $container = parent::provideBusinessLayerDependencies($container);

        return $this->addSplittableQuoteFacade($container);
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addSplittableQuoteFacade(Container $container): Container
    {
        $container[static::FACADE_SPLITTABLE_QUOTE] = static function (Container $container) {
            return new SplittableTotalsToSplittableQuoteFacadeBridge(
                $container->getLocator()->splittableQuote()->facade(),
            );
        };

        return $container;
    }
}
