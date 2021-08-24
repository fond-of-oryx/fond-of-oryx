<?php

namespace FondOfOryx\Zed\GiftCardExpiration\Persistence;

use FondOfOryx\Zed\GiftCardExpiration\GiftCardExpirationDependencyProvider;
use Orm\Zed\GiftCard\Persistence\SpyGiftCardQuery;
use Spryker\Zed\Kernel\Persistence\AbstractPersistenceFactory;

/**
 * @method \FondOfOryx\Zed\GiftCardExpiration\Persistence\GiftCardExpirationEntityManagerInterface getEntityManager()
 * @method \FondOfOryx\Zed\GiftCardExpiration\GiftCardExpirationConfig getConfig()
 */
class GiftCardExpirationPersistenceFactory extends AbstractPersistenceFactory
{
    /**
     * @return \Orm\Zed\GiftCard\Persistence\SpyGiftCardQuery
     */
    public function getGiftCardQuery(): SpyGiftCardQuery
    {
        return $this->getProvidedDependency(GiftCardExpirationDependencyProvider::QUERY_GIFT_CARD);
    }
}
