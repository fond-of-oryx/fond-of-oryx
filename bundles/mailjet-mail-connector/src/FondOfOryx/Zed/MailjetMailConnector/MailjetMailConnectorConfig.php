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
    public function getDefaultLocale(): string
    {
        return $this->get(MailjetMailConnectorConstants::MAILJET_DEFAULT_LOCALE, 'en_US');
    }

    /**
     * @param string $locale
     *
     * @return string
     */
    public function getOrderConfirmationEmailTemplateIdByLocale(string $locale): string
    {
        $orderConfirmationEmailTemplateIdByLocales = $this->get(
            MailjetMailConnectorConstants::MAILJET_ORDER_CONFIRMATION_TEMPLATE_ID_BY_LOCALE,
            [],
        );

        return isset($orderConfirmationEmailTemplateIdByLocales[$locale]) ?: $this->getDefaultLocale();
    }
}
