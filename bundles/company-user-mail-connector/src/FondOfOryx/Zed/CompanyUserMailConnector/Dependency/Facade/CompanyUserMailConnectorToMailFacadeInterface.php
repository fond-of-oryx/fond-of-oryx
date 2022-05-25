<?php

namespace FondOfOryx\Zed\CompanyUserMailConnector\Dependency\Facade;

use Generated\Shared\Transfer\MailTransfer;

interface CompanyUserMailConnectorToMailFacadeInterface
{
    /**
     * @param \Generated\Shared\Transfer\MailTransfer $mailTransfer
     *
     * @return void
     */
    public function handleMail(MailTransfer $mailTransfer): void;
}
