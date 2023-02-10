<?php

namespace FondOfOryx\Shared\CustomerRegistration;

interface CustomerRegistrationConstants
{
    /**
     * @var string
     */
    public const TYPE_REGISTRATION = 'registration';

    /**
     * @var string
     */
    public const TYPE_GDPR = 'gdpr';

    /**
     * @var string
     */
    public const TYPE_EMAIL_VERIFICATION = 'email verification';

    /**
     * @var string
     */
    public const CUSTOMER_REFERENCE_PREFIX = 'CUSTOMER_REFERENCE_PREFIX';

    /**
     * @var string
     */
    public const CUSTOMER_REFERENCE_OFFSET = 'CUSTOMER_REFERENCE_OFFSET';

    /**
     * @var string
     */
    public const CONFIG_PATTERN_VERIFICATION_LINK = 'CUSTOMER_REGISTRATION:CONFIG_PATTERN_VERIFICATION_LINK';

    /**
     * @var string
     */
    public const DEFAULT_PATTERN_VERIFICATION_LINK = '%s/{{locale}}/p/email-verification/{{token}}';

    /**
     * @var string
     */
    public const CONFIG_FALLBACK_URL_LOCALE = 'CUSTOMER_REGISTRATION:CONFIG_FALLBACK_URL_LOCALE';

    /**
     * @var string
     */
    public const CONFIG_BASE_URL = 'CUSTOMER_REGISTRATION:CONFIG_BASE_URL';

    /**
     * @var string
     */
    public const DEFAULT_CONFIG_FALLBACK_URL_LOCALE = 'en';

    /**
     * @var string
     */
    public const ENTITY_CUSTOMER_UPDATE = 'Entity.spy_customer.update';

    /**
     * @var string
     */
    public const MAILJET_CUSTOMER_REGISTRATION_WELCOME_TEMPLATE_ID_BY_LOCALE = 'CUSTOMER_REGISTRATION:MAILJET_CUSTOMER_REGISTRATION_WELCOME_TEMPLATE_ID_BY_LOCALE';

    /**
     * @var string
     */
    public const MAILJET_CUSTOMER_REGISTRATION_CONFIRMATION_TEMPLATE_ID_BY_LOCALE = 'CUSTOMER_REGISTRATION:MAILJET_CUSTOMER_REGISTRATION_CONFIRMATION_TEMPLATE_ID_BY_LOCALE';
}
