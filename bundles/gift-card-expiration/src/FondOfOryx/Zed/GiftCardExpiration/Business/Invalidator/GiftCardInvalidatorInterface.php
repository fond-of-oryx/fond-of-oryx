<?php

namespace FondOfOryx\Zed\GiftCardExpiration\Business\Invalidator;

interface GiftCardInvalidatorInterface
{
    /**
     * @return void
     */
    public function invalidate(): void;
}
