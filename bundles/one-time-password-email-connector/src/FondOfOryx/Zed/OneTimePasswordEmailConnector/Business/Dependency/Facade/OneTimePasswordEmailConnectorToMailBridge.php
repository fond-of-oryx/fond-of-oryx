<?php

namespace FondOfOryx\Zed\OneTimePasswordEmailConnector\Business\Dependency\Facade;

use Generated\Shared\Transfer\MailTransfer;
use Spryker\Zed\Mail\Business\MailFacadeInterface;

class OneTimePasswordEmailConnectorToMailBridge implements OneTimePasswordEmailConnectorToMailInterface
{
    /**
     * @var \Spryker\Zed\Mail\Business\MailFacadeInterface
     */
    protected $mailFacade;

    /**
     * @param \Spryker\Zed\Mail\Business\MailFacadeInterface $mailFacade
     */
    public function __construct(MailFacadeInterface $mailFacade)
    {
        $this->mailFacade = $mailFacade;
    }

    /**
     * @param \Generated\Shared\Transfer\MailTransfer $mailTransfer
     *
     * @return void
     */
    public function handleMail(MailTransfer $mailTransfer): void
    {
        $this->mailFacade->handleMail($mailTransfer);
    }
}
