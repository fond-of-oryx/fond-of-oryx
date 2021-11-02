<?php

namespace FondOfOryx\Zed\GiftCardExpiration\Business;

use FondOfOryx\Zed\GiftCardExpiration\Business\Invalidator\GiftCardInvalidator;
use FondOfOryx\Zed\GiftCardExpiration\Business\Invalidator\GiftCardInvalidatorInterface;
use Spryker\Zed\Kernel\Business\AbstractBusinessFactory;

/**
 * @method \FondOfOryx\Zed\GiftCardExpiration\Persistence\GiftCardExpirationEntityManagerInterface getEntityManager()
 * @method \FondOfOryx\Zed\GiftCardExpiration\GiftCardExpirationConfig getConfig()
 */
class GiftCardExpirationBusinessFactory extends AbstractBusinessFactory
{
    /**
     * @return \FondOfOryx\Zed\GiftCardExpiration\Business\Invalidator\GiftCardInvalidatorInterface
     */
    public function createGiftCardInvalidator(): GiftCardInvalidatorInterface
    {
        return new GiftCardInvalidator(
            $this->getEntityManager(),
            $this->getConfig(),
        );
    }
}
