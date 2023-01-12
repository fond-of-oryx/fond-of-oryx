<?php

namespace FondOfOryx\Zed\MailjetMailConnector;

use FondOfOryx\Shared\MailjetMailConnector\MailjetMailConnectorConstants;
use Spryker\Zed\Kernel\AbstractBundleConfig;

class MailjetMailConnectorConfig extends AbstractBundleConfig
{
    /**
     * @return string
     */
    public function getMailjetKey(): string
    {
        return $this->get(MailjetMailConnectorConstants::MAILJET_KEY, '');
    }

    /**
     * @return string
     */
    public function getMailjetSecret(): string
    {
        return $this->get(MailjetMailConnectorConstants::MAILJET_SECRET, '');
    }

    /**
     * @return float
     */
    public function getMailjetConnectionTimeout(): float
    {
        return $this->get(MailjetMailConnectorConstants::MAILJET_CONNECTION_TIMEOUT, 2);
    }

    /**
     * @return float
     */
    public function getMailjetTimeout(): float
    {
        return $this->get(MailjetMailConnectorConstants::MAILJET_TIMEOUT, 15);
    }

    /**
     * @return bool
     */
    public function isMailjetApiCallEnabled(): bool
    {
        return $this->get(MailjetMailConnectorConstants::MAILJET_API_CALL_ENABLED, true);
    }

    /**
     * @return string
     */
    public function getFromEmail(): string
    {
        return $this->get(MailjetMailConnectorConstants::MAILJET_FROM_EMAIL, '');
    }

    /**
     * @return string
     */
    public function getFromName(): string
    {
        return $this->get(MailjetMailConnectorConstants::MAILJET_FROM_NAME, true);
    }

    /**
     * @return string
     */
    public function getVersion(): string
    {
        return $this->get(MailjetMailConnectorConstants::MAILJET_VERSION, 'v3.1');
    }

    /**
     * @return string
     */
    public function getDefaultLocale(): string
    {
        return $this->get(MailjetMailConnectorConstants::MAILJET_DEFAULT_LOCALE, 'en_US');
    }

    /**
     * @return string
     */
    public function getUrl(): string
    {
        return $this->get(MailjetMailConnectorConstants::MAILJET_URL, 'api.mailjet.com');
    }

    /**
     * @return bool
     */
    public function getSecure(): bool
    {
        return $this->get(MailjetMailConnectorConstants::MAILJET_SECURE, true);
    }

    /**
     * @example ['de_DE' => 100, 'en_US' => 200]
     *
     * @api
     *
     * @param string $locale
     *
     * @return int|null
     */
    public function getOrderConfirmationEmailTemplateIdByLocale(string $locale): ?int
    {
        $orderConfirmationEmailTemplateIdByLocales = $this->get(
            MailjetMailConnectorConstants::MAILJET_ORDER_CONFIRMATION_TEMPLATE_ID_BY_LOCALE,
            [],
        );

        if (isset($orderConfirmationEmailTemplateIdByLocales[$locale])) {
            return $orderConfirmationEmailTemplateIdByLocales[$locale];
        }

        if (isset($orderConfirmationEmailTemplateIdByLocales[$this->getDefaultLocale()])) {
            return $orderConfirmationEmailTemplateIdByLocales[$this->getDefaultLocale()];
        }

        return null;
    }
}