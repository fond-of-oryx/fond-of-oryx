<?php

namespace FondOfOryx\Zed\CustomerRegistration\Business\Sender;

use FondOfOryx\Zed\CustomerRegistration\Communication\Plugins\Mail\CustomerRegistrationWelcomeMailjetMailTypeBuilder;
use FondOfOryx\Zed\CustomerRegistration\Dependency\Facade\CustomerRegistrationToMailFacadeInterface;
use Generated\Shared\Transfer\CustomerTransfer;
use Generated\Shared\Transfer\MailTransfer;

class WelcomeMailSender implements WelcomeMailSenderInterface
{
    /**
     * @var \FondOfOryx\Zed\CustomerRegistration\Dependency\Facade\CustomerRegistrationToMailFacadeInterface
     */
    private CustomerRegistrationToMailFacadeInterface $mailFacade;

    /**
     * @param \FondOfOryx\Zed\CustomerRegistration\Dependency\Facade\CustomerRegistrationToMailFacadeInterface $mailFacade
     */
    public function __construct(CustomerRegistrationToMailFacadeInterface $mailFacade)
    {
        $this->mailFacade = $mailFacade;
    }

    /**
     * @param \Generated\Shared\Transfer\CustomerTransfer $customerTransfer
     *
     * @return void
     */
    public function sendWelcomeMail(CustomerTransfer $customerTransfer): void
    {
        $mailTransfer = (new MailTransfer())
            ->setType(CustomerRegistrationWelcomeMailjetMailTypeBuilder::MAIL_TYPE)
            ->setCustomer($customerTransfer)
            ->setLocale($customerTransfer->getLocale())
            ->setEmailVerificationLink('');

        $this->mailFacade->handleMail($mailTransfer);
    }
}
