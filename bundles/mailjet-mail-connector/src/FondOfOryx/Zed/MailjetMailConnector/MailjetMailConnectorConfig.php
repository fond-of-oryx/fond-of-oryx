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
}
