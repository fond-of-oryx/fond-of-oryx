<?php

namespace FondOfOryx\Zed\CustomerRegistrationRestApi\Dependency\Facade;

use Generated\Shared\Transfer\MailTransfer;

interface CustomerRegistrationRestApiToMailFacadeInterface
{
    /**
     * @param \Generated\Shared\Transfer\MailTransfer $mailTransfer
     *
     * @return void
     */
    public function handleMail(MailTransfer $mailTransfer): void;
}
