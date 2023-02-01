<?php

namespace FondOfOryx\Zed\GiftCardApi;

use FondOfOryx\Zed\GiftCardApi\Dependency\Facade\GiftCardApiToApiFacadeBridge;
use FondOfOryx\Zed\GiftCardApi\Dependency\QueryContainer\GiftCardApiToApiQueryBuilderContainerBridge;
use FondOfOryx\Zed\GiftCardApi\Dependency\QueryContainer\GiftCardApiToGiftCardQueryContainerBridge;
use Spryker\Zed\Kernel\AbstractBundleDependencyProvider;
use Spryker\Zed\Kernel\Container;

class GiftCardApiDependencyProvider extends AbstractBundleDependencyProvider
{
    /**
     * @var string
     */
    public const FACADE_API = 'FACADE_API';

    /**
     * @var string
     */
    public const QUERY_CONTAINER_GIFT_CARD = 'QUERY_CONTAINER_GIFT_CARD';

    /**
     * @var string
     */
    public const QUERY_BUILDER_CONTAINER_API = 'QUERY_BUILDER_CONTAINER_API';

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    public function providePersistenceLayerDependencies(Container $container): Container
    {
        $container = parent::providePersistenceLayerDependencies($container);

        $container = $this->addApiFacade($container);
        $container = $this->addApiQueryBuilderContainer($container);

        return $this->addGiftCardQueryContainer($container);
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addApiFacade(Container $container): Container
    {
        $container[static::FACADE_API] = static function (Container $container) {
            return new GiftCardApiToApiFacadeBridge($container->getLocator()->api()->facade());
        };

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addApiQueryBuilderContainer(Container $container): Container
    {
        $container[static::QUERY_BUILDER_CONTAINER_API] = static function (Container $container) {
            return new GiftCardApiToApiQueryBuilderContainerBridge(
                $container->getLocator()->apiQueryBuilder()->queryContainer(),
            );
        };

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addGiftCardQueryContainer(Container $container): Container
    {
        $container[static::QUERY_CONTAINER_GIFT_CARD] = static function (Container $container) {
            return new GiftCardApiToGiftCardQueryContainerBridge(
                $container->getLocator()->giftCard()->queryContainer(),
            );
        };

        return $container;
    }
}
