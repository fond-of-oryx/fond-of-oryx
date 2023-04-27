<?php

namespace FondOfOryx\Zed\MailjetMailConnector\Business;

use FondOfOryx\Zed\MailjetMailConnector\Business\Model\Provider\MailjetMailer;
use GuzzleHttp\HandlerStack;
use GuzzleRetry\GuzzleRetryMiddleware;
use Mailjet\Client;
use Mailjet\Client as MailjetClient;
use Spryker\Shared\Log\LoggerTrait;
use Spryker\Zed\Kernel\Business\AbstractBusinessFactory;
use Spryker\Zed\MailExtension\Dependency\Plugin\MailProviderPluginInterface;

/**
 * @method \FondOfOryx\Zed\MailjetMailConnector\MailjetMailConnectorConfig getConfig()
 */
class MailjetMailConnectorBusinessFactory extends AbstractBusinessFactory
{
    use LoggerTrait;

    /**
     * @return \Spryker\Zed\MailExtension\Dependency\Plugin\MailProviderPluginInterface
     */
    public function createMailjetMailer(): MailProviderPluginInterface
    {
        return new MailjetMailer(
            $this->getConfig(),
            $this->createMailjetClient(),
            $this->getLogger(),
        );
    }

    /**
     * @return \Mailjet\Client
     */
    protected function createMailjetClient(): Client
    {
        $mailjetClient = new MailjetClient(
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

        $stack = HandlerStack::create();
        $stack->push(GuzzleRetryMiddleware::factory([
            'retry_enabled' => $this->getConfig()->getRetryEnabled(),
            'max_retry_attempts' => $this->getConfig()->getRetryMaxAttempts(),
            'retry_on_status' => $this->getConfig()->getRetryOnStatus(),
            'default_retry_multiplier' => $this->getConfig()->getRetryMultiplier(),
        ]));

        $mailjetClient->addRequestOption('handler', $stack);

        return $mailjetClient;
    }
}
