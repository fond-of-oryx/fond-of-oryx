<?php

namespace FondOfOryx\Zed\JellyfishSalesOrderProductType;

use FondOfOryx\Zed\JellyfishSalesOrderProductType\Dependency\Facade\JellyfishSalesOrderProductTypeToGiftCardFacadeBridge;
use Spryker\Zed\Kernel\AbstractBundleDependencyProvider;
use Spryker\Zed\Kernel\Container;

class JellyfishSalesOrderProductTypeDependencyProvider extends AbstractBundleDependencyProvider
{
    /**
     * @var string
     */
    public const FACADE_GIFT_CARD = 'FACADE_GIFT_CARD';

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    public function provideBusinessLayerDependencies(Container $container): Container
    {
        $container = parent::provideBusinessLayerDependencies($container);

        $container = $this->addGiftCardFacade($container);

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addGiftCardFacade(Container $container): Container
    {
        $container[static::FACADE_GIFT_CARD] = static function () use ($container) {
            return new JellyfishSalesOrderProductTypeToGiftCardFacadeBridge($container->getLocator()->giftCard()->facade());
        };

        return $container;
    }
}
