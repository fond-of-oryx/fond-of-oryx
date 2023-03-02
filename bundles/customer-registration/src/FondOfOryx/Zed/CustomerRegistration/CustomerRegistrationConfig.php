<?php

namespace FondOfOryx\Zed\CustomerRegistration;

use FondOfOryx\Shared\CustomerRegistration\CustomerRegistrationConstants;
use Spryker\Zed\Kernel\AbstractBundleConfig;

class CustomerRegistrationConfig extends AbstractBundleConfig
{
    /**
     * @var string
     */
    protected const MAILJET_DEFAULT_LOCALE = 'en_US';

    /**
     * @uses CustomerConstants::CUSTOMER_REGISTRATION_WITH_CONFIRMATION_MAIL_TYPE
     *
     * @var string
     */
    public const CUSTOMER_REGISTRATION_WITH_CONFIRMATION_MAIL_TYPE = 'customer registration confirmation mail';

    /**
     * @example ['de_DE' => 100, 'en_US' => 200]
     *
     * @param string $locale
     *
     * @return int|null
     */
    public function getCustomerRegistrationWelcomeMailTemplateIdByLocale(string $locale = 'en_US'): ?int
    {
        $customerRegistrationWelcomeMailTemplateIdByLocale = $this->get(
            CustomerRegistrationConstants::MAILJET_CUSTOMER_REGISTRATION_WELCOME_TEMPLATE_ID_BY_LOCALE,
            [],
        );

        if (isset($customerRegistrationWelcomeMailTemplateIdByLocale[$locale])) {
            return $customerRegistrationWelcomeMailTemplateIdByLocale[$locale];
        }

        if (isset($customerRegistrationWelcomeMailTemplateIdByLocale[static::MAILJET_DEFAULT_LOCALE])) {
            return $customerRegistrationWelcomeMailTemplateIdByLocale[static::MAILJET_DEFAULT_LOCALE];
        }

        return null;
    }

    /**
     * @example ['de_DE' => 100, 'en_US' => 200]
     *
     * @param string $locale
     *
     * @return int|null
     */
    public function getCustomerRegistrationConfirmationMailTemplateIdByLocale(string $locale = 'en_US'): ?int
    {
        $oneTimePasswordLoginLinkMailTemplateIdByLocale = $this->get(
            CustomerRegistrationConstants::MAILJET_CUSTOMER_REGISTRATION_CONFIRMATION_TEMPLATE_ID_BY_LOCALE,
            [],
        );

        if (isset($oneTimePasswordLoginLinkMailTemplateIdByLocale[$locale])) {
            return $oneTimePasswordLoginLinkMailTemplateIdByLocale[$locale];
        }

        if (isset($oneTimePasswordLoginLinkMailTemplateIdByLocale[static::MAILJET_DEFAULT_LOCALE])) {
            return $oneTimePasswordLoginLinkMailTemplateIdByLocale[static::MAILJET_DEFAULT_LOCALE];
        }

        return null;
    }

    /**
     * Specification:
     * - Provides a registration confirmation token url.
     *
     * @api
     *
     * @param string $token
     *
     * @return string
     */
    public function getRegisterConfirmTokenUrl(string $token): string
    {
        $fallback = $this->getHostYves() . '/register/confirm?token=%s';

        return sprintf($this->get(CustomerRegistrationConstants::REGISTRATION_CONFIRMATION_TOKEN_URL, $fallback), $token);
    }

    /**
     * @api
     *
     * @return string
     */
    public function getHostYves(): string
    {
        return $this->get(CustomerRegistrationConstants::BASE_URL_YVES);
    }
}
