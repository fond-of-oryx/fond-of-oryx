<?php

namespace FondOfOryx\Zed\MailjetMailConnector\Business\Model\Provider;

use FondOfOryx\Zed\MailjetMailConnector\Business\Mapper\MailjetClientRequestMapperInterface;
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
     * @var \FondOfOryx\Zed\MailjetMailConnector\Business\Mapper\MailjetClientRequestMapperInterface
     */
    protected $mailjetClientRequestMapper;

    /**
     * @param \Mailjet\Client $mailjetClient
     * @param \FondOfOryx\Zed\MailjetMailConnector\Business\Mapper\MailjetClientRequestMapperInterface $mailjetClientRequestMapper
     */
    public function __construct(
        Client $mailjetClient,
        MailjetClientRequestMapperInterface $mailjetClientRequestMapper
    ) {
        $this->mailjetClient = $mailjetClient;
        $this->mailjetClientRequestMapper = $mailjetClientRequestMapper;
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
        $body = [];

        $response = $this->mailjetClient->post(Resources::$Email, ['body' => $body]);
        $response->success() && var_dump($response->getData());
    }
}
