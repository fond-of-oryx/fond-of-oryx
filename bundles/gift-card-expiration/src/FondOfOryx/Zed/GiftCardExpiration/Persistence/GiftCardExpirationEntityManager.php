<?php

namespace FondOfOryx\Zed\GiftCardExpiration\Persistence;

use DateTime;
use Propel\Runtime\ActiveQuery\Criteria;
use Spryker\Zed\Kernel\Persistence\AbstractEntityManager;

/**
 * @method \FondOfOryx\Zed\GiftCardExpiration\Persistence\GiftCardExpirationPersistenceFactory getFactory()
 */
class GiftCardExpirationEntityManager extends AbstractEntityManager implements GiftCardExpirationEntityManagerInterface
{
    /**
     * @param \DateTime $createdAt
     *
     * @return void
     */
    public function expireGiftCardsByCreatedAt(DateTime $createdAt): void
    {
        $giftCardQuery = $this->getFactory()->getGiftCardQuery();

        $giftCardEntities = $giftCardQuery->filterByCreatedAt($createdAt, Criteria::LESS_THAN)
            ->filterByIsActive(true)
            ->find();

        foreach ($giftCardEntities as $giftCardEntity) {
            $giftCardEntity->setIsActive(false)
                ->save();
        }
    }
}
