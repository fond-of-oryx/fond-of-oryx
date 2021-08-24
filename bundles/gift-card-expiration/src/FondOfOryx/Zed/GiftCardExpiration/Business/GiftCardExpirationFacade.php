<?php

namespace FondOfOryx\Zed\GiftCardExpiration\Business;

use Spryker\Zed\Kernel\Business\AbstractFacade;

/**
 * @method \FondOfOryx\Zed\GiftCardExpiration\Persistence\GiftCardExpirationEntityManagerInterface getEntityManager()
 * @method \FondOfOryx\Zed\GiftCardExpiration\Business\GiftCardExpirationBusinessFactory getFactory()
 */
class GiftCardExpirationFacade extends AbstractFacade implements GiftCardExpirationFacadeInterface
{
    /**
     * @return void
     */
    public function expireGiftCards(): void
    {
        $this->getFactory()->createGiftCardInvalidator()->invalidate();
    }
}
