<?php

namespace FondOfOryx\Zed\MailjetMailConnector\Business;

use Generated\Shared\Transfer\MailTransfer;

interface MailjetMailConnectorFacadeInterface
{
    /**
     * Specification:
     * - Sends the mail
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\MailTransfer $mailTransfer
     *
     * @return void
     */
    public function sendMail(MailTransfer $mailTransfer): void;
}
