<?php

namespace FondOfOryx\Shared\GiftCardRestriction;

interface GiftCardRestrictionConstants
{
    /**
     * @var string
     */
    public const BLACKLISTED_COUNTRIES = 'FOND_OF_ORYX:GIFT_CARD_RESTRICTION:BLACKLISTED_COUNTRIES';

    /**
     * @var array
     */
    public const BLACKLISTED_COUNTRIES_VALUE = [];

    /**
     * @var string
     */
    public const CART_CODE_TYPE_GIFT_CARD = 'gift card';
}
