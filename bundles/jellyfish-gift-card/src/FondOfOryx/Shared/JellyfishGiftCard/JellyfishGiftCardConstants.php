<?php

namespace FondOfOryx\Shared\JellyfishGiftCard;

interface JellyfishGiftCardConstants
{
    /**
     * @var string
     */
    public const SUBJECT = 'fond_of_oryx.jellyfish_gift_card.subject';

    /**
     * @var string
     */
    public const SENDER_NAME = 'FOND_OF_ORYX:JELLYFISH_GIFT_CARD:SENDER_NAME';

    /**
     * @var string
     */
    public const SENDER_EMAIL = 'FOND_OF_ORYX:JELLYFISH_GIFT_CARD:SENDER_EMAIL';

    /**
     * @var string
     */
    public const FALLBACK_LOCALE_NAME = 'FOND_OF_ORYX:JELLYFISH_GIFT_CARD:FALLBACK_LOCALE_NAME';

    /**
     * @var string
     */
    public const FALLBACK_LOCALE_NAME_DEFAULT = 'en_US';

    /**
     * @var string
     */
    public const HTTP_CLIENT_CONFIG = 'FOND_OF_ORYX:JELLYFISH_GIFT_CARD:HTTP_CLIENT_CONFIG';

    /**
     * @var string
     */
    public const LAYOUT_TEMPLATE_MAIL_TEXT = 'JellyfishGiftCard/Mail/layout/mail_layout.text.twig';

    /**
     * @var string
     */
    public const LAYOUT_TEMPLATE_MAIL_HTML = 'JellyfishGiftCard/Mail/layout/mail_layout.html.twig';

    /**
     * @var string
     */
    public const LAYOUT_TEMPLATE_GIFT_CARD_HTML = 'JellyfishGiftCard/GiftCard/layout/gift_card_layout.html.twig';
}
