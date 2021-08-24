<?php

namespace FondOfOryx\Zed\GiftCardExpiration;

use Orm\Zed\GiftCard\Persistence\SpyGiftCardQuery;
use Spryker\Zed\Kernel\AbstractBundleDependencyProvider;
use Spryker\Zed\Kernel\Container;

class GiftCardExpirationDependencyProvider extends AbstractBundleDependencyProvider
{
    public const QUERY_GIFT_CARD = 'QUERY_GIFT_CARD';

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    public function providePersistenceLayerDependencies(Container $container): Container
    {
        $container = parent::providePersistenceLayerDependencies($container);

        return $this->addSpyGiftCardQuery($container);
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    public function addSpyGiftCardQuery(Container $container): Container
    {
        $container[static::QUERY_GIFT_CARD] = static function () {
            return SpyGiftCardQuery::create();
        };

        return $container;
    }
}
