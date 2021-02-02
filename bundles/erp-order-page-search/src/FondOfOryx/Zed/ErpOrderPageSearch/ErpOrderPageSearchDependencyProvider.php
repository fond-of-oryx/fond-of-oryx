<?php

namespace FondOfOryx\Zed\ErpOrderPageSearch;

use FondOfOryx\Zed\ErporderPageSearch\Dependency\Service\ErpOrderPageSearchToUtilEncodingServiceBridge;
use Spryker\Zed\Kernel\Container;

/**
 * @method \FondOfOryx\Zed\ErporderPageSearch\ErpOrderPageSearchConfig getConfig()
 */
class ErpOrderPageSearchDependencyProvider extends AbstractBundleDependencyProvider
{
    public const SERVICE_UTIL_ENCODING = 'SERVICE_UTIL_ENCODING';

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    public function provideBusinessLayerDependencies(Container $container): Container
    {
        $container = parent::provideBusinessLayerDependencies($container);

        $container = $this->addUtilEncodingService($container);

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
            return new ErpOrderPageSearchToUtilEncodingServiceBridge(
                $container->getLocator()->utilEncoding()->service()
            );
        };

        return $container;
    }
}
