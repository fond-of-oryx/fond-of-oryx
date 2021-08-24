<?php

namespace FondOfOryx\Zed\GiftCardExpiration\Persistence;

use DateTime;

interface GiftCardExpirationEntityManagerInterface
{
    /**
     * @param \DateTime $createdAt
     *
     * @return void
     */
    public function expireGiftCardsByCreatedAt(DateTime $createdAt): void;
}
