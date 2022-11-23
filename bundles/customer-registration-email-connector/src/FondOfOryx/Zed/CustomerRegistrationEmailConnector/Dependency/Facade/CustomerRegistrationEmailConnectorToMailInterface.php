<?php

namespace FondOfOryx\Zed\CustomerRegistrationEmailConnector\Dependency\Facade;

use Generated\Shared\Transfer\MailTransfer;

interface CustomerRegistrationEmailConnectorToMailInterface
{
    /**
     * @param \Generated\Shared\Transfer\MailTransfer $mailTransfer
     *
     * @return void
     */
    public function handleMail(MailTransfer $mailTransfer): void;
}
