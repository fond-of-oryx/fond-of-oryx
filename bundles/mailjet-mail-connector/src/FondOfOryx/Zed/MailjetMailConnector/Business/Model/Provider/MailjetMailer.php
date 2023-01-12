<?php

namespace FondOfOryx\Zed\MailjetMailConnector\Business\Model\Provider;

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
     * @param \Mailjet\Client $mailjetClient
     */
    public function __construct(Client $mailjetClient)
    {
        $this->mailjetClient = $mailjetClient;
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
        $body = ['Messages' => $mailTransfer->getMailjet()->toArray()];
        $response = $this->mailjetClient->post(Resources::$Email, ['body' => $body]);
        $response->success() && var_dump($response->getData());
    }
}
