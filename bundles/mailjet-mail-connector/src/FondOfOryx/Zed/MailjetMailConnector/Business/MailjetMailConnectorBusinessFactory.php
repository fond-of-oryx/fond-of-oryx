<?php

namespace FondOfOryx\Zed\MailjetMailConnector\Business;

use FondOfOryx\Zed\MailjetMailConnector\Business\Model\Provider\MailjetMailer;
use Mailjet\Client;
use Mailjet\Client as MailjetClient;
use Spryker\Zed\Kernel\Business\AbstractBusinessFactory;
use Spryker\Zed\MailExtension\Dependency\Plugin\MailProviderPluginInterface;

/**
 * @method \FondOfOryx\Zed\MailjetMailConnector\MailjetMailConnectorConfig getConfig()
 */
class MailjetMailConnectorBusinessFactory extends AbstractBusinessFactory
{
    /**
     * @return \Spryker\Zed\MailExtension\Dependency\Plugin\MailProviderPluginInterface
     */
    public function createMailjetMailer(): MailProviderPluginInterface
    {
        return new MailjetMailer(
            $this->getConfig(),
            $this->createMailjetClient(),
        );
    }

    /**
     * @return \Mailjet\Client
     */
    protected function createMailjetClient(): Client
    {
        return new MailjetClient(
            $this->getConfig()->getMailjetKey(),
            $this->getConfig()->getMailjetSecret(),
            $this->getConfig()->isMailjetApiCallEnabled(),
            [
                MailjetClient::TIMEOUT => $this->getConfig()->getMailjetTimeout(),
                MailjetClient::CONNECT_TIMEOUT => $this->getConfig()->getMailjetConnectionTimeout(),
                'version' => $this->getConfig()->getVersion(),
                'url' => $this->getConfig()->getUrl(),
                'secured' => $this->getConfig()->getSecure(),
            ],
        );
    }
}
