<?php

namespace FondOfOryx\Zed\MailjetMailConnector\Business\Model\Provider;

use FondOfOryx\Zed\MailjetMailConnector\MailjetMailConnectorConfig;
use Generated\Shared\Transfer\MailTransfer;
use Mailjet\Client;
use Mailjet\Resources;
use Spryker\Zed\MailExtension\Dependency\Plugin\MailProviderPluginInterface;

class MailjetMailer implements MailProviderPluginInterface
{
    /**
     * @var \Mailjet\Client
     */
    protected $mailjetClient;

    /**
     * @var \FondOfOryx\Zed\MailjetMailConnector\MailjetMailConnectorConfig
     */
    protected $config;

    /**
     * @param \FondOfOryx\Zed\MailjetMailConnector\MailjetMailConnectorConfig $config
     * @param \Mailjet\Client $mailjetClient
     */
    public function __construct(
        MailjetMailConnectorConfig $config,
        Client $mailjetClient
    ) {
        $this->mailjetClient = $mailjetClient;
        $this->config = $config;
    }

    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\MailTransfer $mailTransfer
     *
     * @return void
     */
    public function sendMail(MailTransfer $mailTransfer): void
    {
        $customerTransfer = $mailTransfer->getCustomer();

        $body = [
            'Messages' => [
                [
                    'From' => [
                        'Email' => $this->config->getFromEmail(),
                        'Name' => $this->config->getFromName(),
                    ],
                    'To' => [
                        [
                            'Email' => $customerTransfer->getEmail(),
                            'Name' => sprintf('%s %s', $customerTransfer->getFirstName(), $customerTransfer->getLastName()),
                        ],
                    ],
                    'Subject' => null,
                    'TemplateID' => $mailTransfer->getMailjetTemplate()->getTemplateId(),
                    'Variables' => $mailTransfer->getMailjetTemplate()->getVariables(),
                    'TemplateLanguage' => $this->config->getTemplateLanguage(),
                    'SandboxMode' => $this->config->getSandboxMode(),
                ],
            ],
        ];

        $this->mailjetClient->post(Resources::$Email, ['body' => $body]);
    }
}
