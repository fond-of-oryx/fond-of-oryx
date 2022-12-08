<?php

namespace FondOfOryx\Zed\MailjetMailConnector\Business\Mapper;

use FondOfOryx\Zed\MailjetMailConnector\MailjetMailConnectorConfig;
use Generated\Shared\Transfer\MailjetClientRequestEmailTransfer;
use Generated\Shared\Transfer\MailjetClientRequestTransfer;
use Generated\Shared\Transfer\MailTransfer;

class MailjetClientRequestMapper implements MailjetClientRequestMapperInterface
{
    /**
     * @var \FondOfOryx\Zed\MailjetMailConnector\MailjetMailConnectorConfig
     */
    protected $config;

    /**
     * @param \FondOfOryx\Zed\MailjetMailConnector\MailjetMailConnectorConfig $config
     */
    public function __construct(MailjetMailConnectorConfig $config)
    {
        $this->config = $config;
    }

    /**
     * @param \Generated\Shared\Transfer\MailTransfer $mailTransfer
     *
     * @return \Generated\Shared\Transfer\MailjetClientRequestTransfer
     */
    public function mailTransferToRequest(MailTransfer $mailTransfer): MailjetClientRequestTransfer
    {
        $orderTransfer = $mailTransfer->getOrder();

        $mailjetClientRequestEmailFromTransfer = (new MailjetClientRequestEmailTransfer())
            ->setEmail($this->config->getFromEmail())
            ->setName($this->config->getFromName());

        $mailjetClientRequestEmailToTransfer = (new MailjetClientRequestEmailTransfer())
            ->setEmail($orderTransfer->getEmail())
            ->setName(sprintf('%s %s', $orderTransfer->getFirstName(), $orderTransfer->getLastName()));

        return (new MailjetClientRequestTransfer())
            ->setFrom($mailjetClientRequestEmailFromTransfer)
            ->setTo($mailjetClientRequestEmailToTransfer)
            ->setSubject('mail.order.confirmation.subject');
    }
}
