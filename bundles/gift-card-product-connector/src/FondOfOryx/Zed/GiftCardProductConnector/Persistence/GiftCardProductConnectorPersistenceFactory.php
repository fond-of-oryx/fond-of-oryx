<?php

namespace FondOfOryx\Zed\GiftCardProductConnector\Persistence;

use FondOfOryx\Zed\GiftCardProductConnector\GiftCardProductConnectorDependencyProvider;
use FondOfOryx\Zed\GiftCardProductConnector\Persistence\Propel\Mapper\GiftCardProductAbstractConfigurationLinkMapper;
use FondOfOryx\Zed\GiftCardProductConnector\Persistence\Propel\Mapper\GiftCardProductAbstractConfigurationLinkMapperInterface;
use FondOfOryx\Zed\GiftCardProductConnector\Persistence\Propel\Mapper\GiftCardProductAbstractConfigurationMapper;
use FondOfOryx\Zed\GiftCardProductConnector\Persistence\Propel\Mapper\GiftCardProductAbstractConfigurationMapperInterface;
use FondOfOryx\Zed\GiftCardProductConnector\Persistence\Propel\Mapper\GiftCardProductConfigurationLinkMapper;
use FondOfOryx\Zed\GiftCardProductConnector\Persistence\Propel\Mapper\GiftCardProductConfigurationLinkMapperInterface;
use FondOfOryx\Zed\GiftCardProductConnector\Persistence\Propel\Mapper\GiftCardProductConfigurationMapper;
use FondOfOryx\Zed\GiftCardProductConnector\Persistence\Propel\Mapper\GiftCardProductConfigurationMapperInterface;
use Orm\Zed\GiftCard\Persistence\SpyGiftCardProductAbstractConfigurationLinkQuery;
use Orm\Zed\GiftCard\Persistence\SpyGiftCardProductAbstractConfigurationQuery;
use Orm\Zed\GiftCard\Persistence\SpyGiftCardProductConfigurationLinkQuery;
use Orm\Zed\GiftCard\Persistence\SpyGiftCardProductConfigurationQuery;
use Orm\Zed\Product\Persistence\SpyProductAbstractQuery;
use Orm\Zed\Product\Persistence\SpyProductQuery;
use Spryker\Zed\Kernel\Persistence\AbstractPersistenceFactory;

/**
 * @method \FondOfOryx\Zed\GiftCardProductConnector\Persistence\GiftCardProductConnectorEntityManagerInterface getEntityManager()
 * @method \FondOfOryx\Zed\GiftCardProductConnector\GiftCardProductConnectorConfig getConfig()
 */
class GiftCardProductConnectorPersistenceFactory extends AbstractPersistenceFactory
{
    /**
     * @return \Orm\Zed\GiftCard\Persistence\SpyGiftCardProductAbstractConfigurationQuery
     */
    public function createSpyGiftCardProductAbstractConfigurationQuery(): SpyGiftCardProductAbstractConfigurationQuery
    {
        return $this->getProvidedDependency(
            GiftCardProductConnectorDependencyProvider::PROPEL_QUERY_GIFT_CARD_PRODUCT_ABSTRACT_CONFIGURATION,
        );
    }

    /**
     * @return \Orm\Zed\GiftCard\Persistence\SpyGiftCardProductAbstractConfigurationLinkQuery
     */
    public function createSpyGiftCardProductAbstractConfigurationLinkQuery(): SpyGiftCardProductAbstractConfigurationLinkQuery
    {
        return $this->getProvidedDependency(
            GiftCardProductConnectorDependencyProvider::PROPEL_QUERY_GIFT_CARD_PRODUCT_ABSTRACT_CONFIGURATION_LINK,
        );
    }

    /**
     * @return \Orm\Zed\GiftCard\Persistence\SpyGiftCardProductConfigurationQuery
     */
    public function createSpyGiftCardProductConfigurationQuery(): SpyGiftCardProductConfigurationQuery
    {
        return $this->getProvidedDependency(
            GiftCardProductConnectorDependencyProvider::PROPEL_QUERY_GIFT_CARD_PRODUCT_CONFIGURATION,
        );
    }

    /**
     * @return \Orm\Zed\GiftCard\Persistence\SpyGiftCardProductConfigurationLinkQuery
     */
    public function createSpyGiftCardProductConfigurationLinkQuery(): SpyGiftCardProductConfigurationLinkQuery
    {
        return $this->getProvidedDependency(
            GiftCardProductConnectorDependencyProvider::PROPEL_QUERY_GIFT_CARD_PRODUCT_CONFIGURATION_LINK,
        );
    }

    /**
     * @return \FondOfOryx\Zed\GiftCardProductConnector\Persistence\Propel\Mapper\GiftCardProductAbstractConfigurationMapperInterface
     */
    public function createGiftCardProductAbstractConfigurationMapper(): GiftCardProductAbstractConfigurationMapperInterface
    {
        return new GiftCardProductAbstractConfigurationMapper();
    }

    /**
     * @return \FondOfOryx\Zed\GiftCardProductConnector\Persistence\Propel\Mapper\GiftCardProductAbstractConfigurationLinkMapperInterface
     */
    public function createGiftCardProductAbstractConfigurationLinkMapper(): GiftCardProductAbstractConfigurationLinkMapperInterface
    {
        return new GiftCardProductAbstractConfigurationLinkMapper();
    }

    /**
     * @return \FondOfOryx\Zed\GiftCardProductConnector\Persistence\Propel\Mapper\GiftCardProductConfigurationMapperInterface
     */
    public function createGiftCardProductConfigurationMapper(): GiftCardProductConfigurationMapperInterface
    {
        return new GiftCardProductConfigurationMapper();
    }

    /**
     * @return \FondOfOryx\Zed\GiftCardProductConnector\Persistence\Propel\Mapper\GiftCardProductConfigurationLinkMapperInterface
     */
    public function createGiftCardProductConfigurationLinkMapper(): GiftCardProductConfigurationLinkMapperInterface
    {
        return new GiftCardProductConfigurationLinkMapper();
    }

    /**
     * @return \Orm\Zed\Product\Persistence\SpyProductAbstractQuery
     */
    public function createProductAbstractQuery(): SpyProductAbstractQuery
    {
        return $this->getProvidedDependency(
            GiftCardProductConnectorDependencyProvider::PROPEL_QUERY_PRODUCT_ABSTRACT,
        );
    }

    /**
     * @return \Orm\Zed\Product\Persistence\SpyProductQuery
     */
    public function createProductQuery(): SpyProductQuery
    {
        return $this->getProvidedDependency(
            GiftCardProductConnectorDependencyProvider::PROPEL_QUERY_PRODUCT,
        );
    }
}
