<?php

namespace FondOfOryx\Shared\JellyfishGiftCard;

interface JellyfishGiftCardConstants
{
    public const SUBJECT = 'fond_of_oryx.jellyfish_gift_card.subject';

    public const SENDER_NAME = 'FOND_OF_ORYX:JELLYFISH_GIFT_CARD:SENDER_NAME';
    public const SENDER_EMAIL = 'FOND_OF_ORYX:JELLYFISH_GIFT_CARD:SENDER_EMAIL';
    public const FALLBACK_LOCALE_NAME = 'FOND_OF_ORYX:JELLYFISH_GIFT_CARD:FALLBACK_LOCALE_NAME';
    public const FALLBACK_LOCALE_NAME_DEFAULT = 'en_US';
    public const HTTP_CLIENT_CONFIG = 'FOND_OF_ORYX:JELLYFISH_GIFT_CARD:HTTP_CLIENT_CONFIG';

    public const LAYOUT_TEMPLATE_MAIL_TEXT = 'JellyfishGiftCard/Mail/layout/mail_layout.text.twig';
    public const LAYOUT_TEMPLATE_MAIL_HTML = 'JellyfishGiftCard/Mail/layout/mail_layout.html.twig';
    public const LAYOUT_TEMPLATE_GIFT_CARD_HTML = 'JellyfishGiftCard/GiftCard/layout/gift_card_layout.html.twig';
}
