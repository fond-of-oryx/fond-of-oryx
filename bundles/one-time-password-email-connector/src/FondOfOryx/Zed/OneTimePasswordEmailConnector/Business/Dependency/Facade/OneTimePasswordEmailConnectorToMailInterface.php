<?php

namespace FondOfOryx\Zed\OneTimePasswordEmailConnector\Business\Dependency\Facade;

use Generated\Shared\Transfer\MailTransfer;

interface OneTimePasswordEmailConnectorToMailInterface
{
    /**
     * @param \Generated\Shared\Transfer\MailTransfer $mailTransfer
     *
     * @return void
     */
    public function handleMail(MailTransfer $mailTransfer): void;
}
