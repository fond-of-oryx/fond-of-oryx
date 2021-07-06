<?php

namespace FondOfOryx\Zed\GiftCardProductConnector;

use FondOfOryx\Zed\GiftCardProductConnector\Dependency\Facade\GiftCardProductConnectorToProductFacadeBridge;
use Orm\Zed\GiftCard\Persistence\SpyGiftCardProductAbstractConfigurationLinkQuery;
use Orm\Zed\GiftCard\Persistence\SpyGiftCardProductAbstractConfigurationQuery;
use Orm\Zed\GiftCard\Persistence\SpyGiftCardProductConfigurationLinkQuery;
use Orm\Zed\GiftCard\Persistence\SpyGiftCardProductConfigurationQuery;
use Orm\Zed\Product\Persistence\SpyProductAbstractQuery;
use Orm\Zed\Product\Persistence\SpyProductQuery;
use Spryker\Zed\Kernel\AbstractBundleDependencyProvider;
use Spryker\Zed\Kernel\Container;

class GiftCardProductConnectorDependencyProvider extends AbstractBundleDependencyProvider
{
    public const FACADE_PRODUCT = 'FACADE_PRODUCT';

    public const PROPEL_QUERY_GIFT_CARD_PRODUCT_ABSTRACT_CONFIGURATION = 'PROPEL_QUERY_GIFT_CARD_PRODUCT_ABSTRACT_CONFIGURATION';
    public const PROPEL_QUERY_GIFT_CARD_PRODUCT_CONFIGURATION = 'PROPEL_QUERY_GIFT_CARD_PRODUCT_CONFIGURATION';
    public const PROPEL_QUERY_GIFT_CARD_PRODUCT_ABSTRACT_CONFIGURATION_LINK = 'PROPEL_QUERY_GIFT_CARD_PRODUCT_ABSTRACT_CONFIGURATION_LINK';
    public const PROPEL_QUERY_GIFT_CARD_PRODUCT_CONFIGURATION_LINK = 'PROPEL_QUERY_GIFT_CARD_PRODUCT_CONFIGURATION_LINK';
    public const PROPEL_QUERY_PRODUCT_ABSTRACT = 'PROPEL_QUERY_PRODUCT_ABSTRACT';
    public const PROPEL_QUERY_PRODUCT = 'PROPEL_QUERY_PRODUCT';

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    public function provideBusinessLayerDependencies(Container $container): Container
    {
        $container = parent::provideBusinessLayerDependencies($container);

        $container = $this->addProductFacade($container);

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addProductFacade(Container $container): Container
    {
        $container[static::FACADE_PRODUCT] = static function (Container $container) {
            return new GiftCardProductConnectorToProductFacadeBridge($container->getLocator()->product()->facade());
        };

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    public function providePersistenceLayerDependencies(Container $container): Container
    {
        $container = parent::providePersistenceLayerDependencies($container);

        $container = $this->addGiftCardProductAbstractConfigurationPropelQuery($container);
        $container = $this->addGiftCardProductConfigurationPropelQuery($container);
        $container = $this->addGiftCardProductAbstractConfigurationLinkPropelQuery($container);
        $container = $this->addGiftCardProductConfigurationLinkPropelQuery($container);
        $container = $this->addProductAbstractPropelQuery($container);
        $container = $this->addProductPropelQuery($container);

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addGiftCardProductAbstractConfigurationPropelQuery(Container $container): Container
    {
        $container[static::PROPEL_QUERY_GIFT_CARD_PRODUCT_ABSTRACT_CONFIGURATION] = static function () {
            return SpyGiftCardProductAbstractConfigurationQuery::create();
        };

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addGiftCardProductConfigurationPropelQuery(Container $container): Container
    {
        $container[static::PROPEL_QUERY_GIFT_CARD_PRODUCT_CONFIGURATION] = static function () {
            return SpyGiftCardProductConfigurationQuery::create();
        };

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addGiftCardProductAbstractConfigurationLinkPropelQuery(Container $container): Container
    {
        $container[static::PROPEL_QUERY_GIFT_CARD_PRODUCT_ABSTRACT_CONFIGURATION_LINK] = static function () {
            return SpyGiftCardProductAbstractConfigurationLinkQuery::create();
        };

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addGiftCardProductConfigurationLinkPropelQuery(Container $container): Container
    {
        $container[static::PROPEL_QUERY_GIFT_CARD_PRODUCT_CONFIGURATION_LINK] = static function () {
            return SpyGiftCardProductConfigurationLinkQuery::create();
        };

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addProductAbstractPropelQuery(Container $container): Container
    {
        $container[static::PROPEL_QUERY_PRODUCT_ABSTRACT] = static function () {
            return SpyProductAbstractQuery::create();
        };

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addProductPropelQuery(Container $container): Container
    {
        $container[static::PROPEL_QUERY_PRODUCT] = static function () {
            return SpyProductQuery::create();
        };

        return $container;
    }
}
