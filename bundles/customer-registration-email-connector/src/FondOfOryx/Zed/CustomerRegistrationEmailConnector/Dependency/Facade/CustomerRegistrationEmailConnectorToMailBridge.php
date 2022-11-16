<?php

namespace FondOfOryx\Zed\CustomerRegistrationEmailConnector\Dependency\Facade;

use Generated\Shared\Transfer\MailTransfer;
use Spryker\Zed\Mail\Business\MailFacadeInterface;

class CustomerRegistrationEmailConnectorToMailBridge implements CustomerRegistrationEmailConnectorToMailInterface
{
    /**
     * @var \Spryker\Zed\Mail\Business\MailFacadeInterface
     */
    protected $facade;

    /**
     * @param \Spryker\Zed\Mail\Business\MailFacadeInterface $facade
     */
    public function __construct(MailFacadeInterface $facade)
    {
        $this->facade = $facade;
    }

    /**
     * @param \Generated\Shared\Transfer\MailTransfer $mailTransfer
     *
     * @return void
     */
    public function handleMail(MailTransfer $mailTransfer): void
    {
        $this->facade->handleMail($mailTransfer);
    }
}
