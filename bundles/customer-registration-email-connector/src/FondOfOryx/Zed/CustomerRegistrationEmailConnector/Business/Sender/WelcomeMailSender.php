<?php

namespace FondOfOryx\Zed\CustomerRegistrationEmailConnector\Business\Sender;

use FondOfOryx\Zed\CustomerRegistrationEmailConnector\Communication\Plugins\Mail\CustomerRegistrationEmailConnectorWelcomeMailTypePlugin;
use FondOfOryx\Zed\CustomerRegistrationEmailConnector\Dependency\Facade\CustomerRegistrationEmailConnectorToMailInterface;
use Generated\Shared\Transfer\CustomerTransfer;
use Generated\Shared\Transfer\MailTransfer;

class WelcomeMailSender implements WelcomeMailSenderInterface
{
    /**
     * @var \FondOfOryx\Zed\CustomerRegistrationEmailConnector\Dependency\Facade\CustomerRegistrationEmailConnectorToMailInterface
     */
    protected $mailFacade;

    /**
     * @param \FondOfOryx\Zed\CustomerRegistrationEmailConnector\Dependency\Facade\CustomerRegistrationEmailConnectorToMailInterface $mailFacade
     */
    public function __construct(CustomerRegistrationEmailConnectorToMailInterface $mailFacade)
    {
        $this->mailFacade = $mailFacade;
    }

    /**
     * @param \Generated\Shared\Transfer\CustomerTransfer $customerTransfer
     * @param string $link
     *
     * @return void
     */
    public function sendWelcomeMail(CustomerTransfer $customerTransfer, string $link): void
    {
        $mailTransfer = (new MailTransfer())
            ->setType(CustomerRegistrationEmailConnectorWelcomeMailTypePlugin::MAIL_TYPE)
            ->setCustomer($customerTransfer)
            ->setEmailVerificationLink($link)
            ->setLocale($customerTransfer->getLocale());

        $this->mailFacade->handleMail($mailTransfer);
    }
}
