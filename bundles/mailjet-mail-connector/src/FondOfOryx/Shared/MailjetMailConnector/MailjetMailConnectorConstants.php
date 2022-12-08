<?php

namespace FondOfOryx\Shared\MailjetMailConnector;

interface MailjetMailConnectorConstants
{
    /**
     * @var string
     */
    public const MAILJET_KEY = 'MailjetMailConnector:MAILJET_KEY';

    /**
     * @var string
     */
    public const MAILJET_SECRET = 'MailjetMailConnector:MAILJET_SECRET';

    /**
     * @var string
     */
    public const MAILJET_CONNECTION_TIMEOUT = 'MailjetMailConnector:MAILJET_CONNECTION_TIMEOUT';

    /**
     * @var string
     */
    public const MAILJET_TIMEOUT = 'MailjetMailConnector:MAILJET_TIMEOUT';

    /**
     * @var string
     */
    public const MAILJET_API_CALL_ENABLED = 'MailjetMailConnector:MAILJET_API_CALL_ENABLED';

    /**
     * @var string
     */
    public const MAILJET_FROM_EMAIL = 'MailjetMailConnector:MAILJET_FROM_EMAIL';

    /**
     * @var string
     */
    public const MAILJET_FROM_NAME = 'MailjetMailConnector:MAILJET_FROM_NAME';

    /**
     * @var string
     */
    public const MAILJET_DEFAULT_LOCALE = 'MailjetMailConnector:MAILJET_DEFAULT_LOCALE';

    /**
     * @var string
     */
    public const MAILJET_ORDER_CONFIRMATION_TEMPLATE_ID_BY_LOCALE = 'MailjetMailConnector:MAILJET_ORDER_CONFIRMATION_TEMPLATE_ID_BY_LOCALE';
}
