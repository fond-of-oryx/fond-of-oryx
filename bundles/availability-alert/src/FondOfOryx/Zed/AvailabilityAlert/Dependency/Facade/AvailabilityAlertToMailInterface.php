<?php

namespace FondOfOryx\Zed\AvailabilityAlert\Dependency\Facade;

use Generated\Shared\Transfer\MailTransfer;

interface AvailabilityAlertToMailInterface
{
    /**
     * @param \Generated\Shared\Transfer\MailTransfer $mailTransfer
     *
     * @return void
     */
    public function handleMail(MailTransfer $mailTransfer);
}
