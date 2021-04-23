<?php

namespace FondOfOryx\Zed\AvailabilityAlert\Dependency\Facade;

use Generated\Shared\Transfer\MailTransfer;

class AvailabilityAlertToMailBridge implements AvailabilityAlertToMailInterface
{
    /**
     * @var \Spryker\Zed\Mail\Business\MailFacadeInterface
     */
    protected $mailFacade;

    /**
     * @param \Spryker\Zed\Mail\Business\MailFacadeInterface $mailFacade
     */
    public function __construct($mailFacade)
    {
        $this->mailFacade = $mailFacade;
    }

    /**
     * @param \Generated\Shared\Transfer\MailTransfer $mailTransfer
     *
     * @return void
     */
    public function handleMail(MailTransfer $mailTransfer)
    {
        $this->mailFacade->handleMail($mailTransfer);
    }
}
