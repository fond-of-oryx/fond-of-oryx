<?php

namespace FondOfOryx\Zed\MailjetMailConnector\Business\Model\Provider;

use FondOfOryx\Zed\MailjetMailConnector\MailjetMailConnectorConfig;
use Generated\Shared\Transfer\MailTransfer;
use Mailjet\Client;
use Mailjet\Resources;
use Psr\Log\LoggerInterface;
use Spryker\Zed\MailExtension\Dependency\Plugin\MailProviderPluginInterface;

class MailjetMailer implements MailProviderPluginInterface
{
    /**
     * @var \Mailjet\Client
     */
    protected Client $mailjetClient;

    /**
     * @var \FondOfOryx\Zed\MailjetMailConnector\MailjetMailConnectorConfig
     */
    protected MailjetMailConnectorConfig $config;

    /**
     * @var \Psr\Log\LoggerInterface
     */
    protected LoggerInterface $logger;

    /**
     * @param \FondOfOryx\Zed\MailjetMailConnector\MailjetMailConnectorConfig $config
     * @param \Mailjet\Client $mailjetClient
     * @param \Psr\Log\LoggerInterface $logger
     */
    public function __construct(
        MailjetMailConnectorConfig $config,
        Client $mailjetClient,
        LoggerInterface $logger
    ) {
        $this->mailjetClient = $mailjetClient;
        $this->config = $config;
        $this->logger = $logger;
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
                ],
            ],
            'SandboxMode' => $this->isSandbox($customerTransfer->getEmail()),
        ];

        $response = $this->mailjetClient->post(Resources::$Email, ['body' => $body]);

        if (!$response->success()) {
            $this->logger->error(
                sprintf(
                    'Sending to mailjet failed after %d retries with status %d',
                    $this->config->getRetryEnabled() ? $this->config->getRetryMultiplier() : 1,
                    $response->getStatus(),
                ),
                $response->getBody(),
            );
        }
    }

    /**
     * @param string $email
     *
     * @return bool
     */
    protected function isSandbox(string $email): bool
    {
        if (in_array($email, $this->config->getWhitelistedEmails(), true)) {
            return false;
        }

        foreach ($this->config->getWhitelistedTLD() as $tld) {
            if (str_contains(strtolower($email), sprintf('@%s', $tld))) {
                return false;
            }
        }

        return $this->config->getSandboxMode();
    }
}
