<?php

namespace FondOfOryx\Zed\GiftCardExpiration\Business;

interface GiftCardExpirationFacadeInterface
{
    /**
     * Specifications:
     * - Expires gift cards
     *
     * @api
     *
     * @return void
     */
    public function expireGiftCards(): void;
}
