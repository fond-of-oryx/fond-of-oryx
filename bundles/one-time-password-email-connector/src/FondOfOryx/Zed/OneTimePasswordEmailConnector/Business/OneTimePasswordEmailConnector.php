<?php

namespace FondOfOryx\Zed\OneTimePasswordEmailConnector\Business;

use FondOfOryx\Zed\OneTimePasswordEmailConnector\Business\Dependency\Facade\OneTimePasswordEmailConnectorToMailBridge;
use FondOfOryx\Zed\OneTimePasswordEmailConnector\Communication\Plugin\Mail\OneTimePasswordEmailConnectorMailTypePlugin;
use Generated\Shared\Transfer\MailTransfer;
use Generated\Shared\Transfer\OneTimePasswordResponseTransfer;

class OneTimePasswordEmailConnector implements OneTimePasswordEmailConnectorInterface
{
    /**
     * @var \FondOfOryx\Zed\OneTimePasswordEmailConnector\Business\Dependency\Facade\OneTimePasswordEmailConnectorToMailBridge
     */
    protected $mailFacade;

    /**
     * @param \FondOfOryx\Zed\OneTimePasswordEmailConnector\Business\Dependency\Facade\OneTimePasswordEmailConnectorToMailBridge $mailFacade
     */
    public function __construct(OneTimePasswordEmailConnectorToMailBridge $mailFacade)
    {
        $this->mailFacade = $mailFacade;
    }

    /**
     * @param \Generated\Shared\Transfer\OneTimePasswordResponseTransfer $oneTimePasswordResponseTransfer
     *
     * @return void
     */
    public function sendOneTimePasswordMail(OneTimePasswordResponseTransfer $oneTimePasswordResponseTransfer): void
    {
        $customerTransfer = $oneTimePasswordResponseTransfer
            ->requireNewPasswordPlain()
            ->requireCustomerTransfer()
            ->getCustomerTransfer();

        $mailTransfer = (new MailTransfer())
            ->setType(OneTimePasswordEmailConnectorMailTypePlugin::MAIL_TYPE)
            ->setCustomer($customerTransfer)
            ->setNewPasswordPlain($oneTimePasswordResponseTransfer->getNewPasswordPlain())
            ->setLocale($customerTransfer->getLocale());

        $this->mailFacade->handleMail($mailTransfer);
    }
}
