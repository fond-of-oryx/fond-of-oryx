<?php

namespace FondOfOryx\Zed\JellyfishThirtyFiveUp;

use FondOfOryx\Zed\JellyfishThirtyFiveUp\Dependency\Facade\JellyfishThirtyFiveUpToThirtyFiveUpFacadeBridge;
use Spryker\Zed\Kernel\AbstractBundleDependencyProvider;
use Spryker\Zed\Kernel\Container;

class JellyfishThirtyFiveUpDependencyProvider extends AbstractBundleDependencyProvider
{
    /**
     * @var string
     */
    public const FACADE_THIRTY_FIVE_UP = 'JELLYFISH_THIRTY_FIVE_UP:FACADE_THIRTY_FIVE_UP';

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    public function provideCommunicationLayerDependencies(Container $container): Container
    {
        $container = parent::provideCommunicationLayerDependencies($container);
        $container = $this->addThirtyFiveUpFacade($container);

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    public function addThirtyFiveUpFacade(Container $container): Container
    {
        $container[static::FACADE_THIRTY_FIVE_UP] = static function (Container $container) {
            return new JellyfishThirtyFiveUpToThirtyFiveUpFacadeBridge($container->getLocator()->thirtyFiveUp()->facade());
        };

        return $container;
    }
}
