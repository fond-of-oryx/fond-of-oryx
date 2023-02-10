<?php

namespace FondOfOryx\Zed\CustomerRegistration\Business\Sender;

use FondOfOryx\Zed\CustomerRegistration\Communication\Plugins\Mail\CustomerRegistrationWelcomeMailjetMailTypeBuilder;
use FondOfOryx\Zed\CustomerRegistration\Dependency\Facade\CustomerRegistrationToMailFacadeInterface;
use FondOfOryx\Zed\CustomerRegistration\Dependency\Facade\CustomerRegistrationToOneTimePasswordFacadeInterface;
use Generated\Shared\Transfer\CustomerTransfer;
use Generated\Shared\Transfer\MailTransfer;

class WelcomeMailSender implements WelcomeMailSenderInterface
{
    /**
     * @var \FondOfOryx\Zed\CustomerRegistration\Dependency\Facade\CustomerRegistrationToMailFacadeInterface
     */
    private CustomerRegistrationToMailFacadeInterface $mailFacade;

    /**
     * @var \FondOfOryx\Zed\CustomerRegistration\Dependency\Facade\CustomerRegistrationToOneTimePasswordFacadeInterface
     */
    protected CustomerRegistrationToOneTimePasswordFacadeInterface $oneTimePasswordFacade;

    /**
     * @param \FondOfOryx\Zed\CustomerRegistration\Dependency\Facade\CustomerRegistrationToMailFacadeInterface $mailFacade
     * @param \FondOfOryx\Zed\CustomerRegistration\Dependency\Facade\CustomerRegistrationToOneTimePasswordFacadeInterface $oneTimePasswordFacade
     */
    public function __construct(
        CustomerRegistrationToMailFacadeInterface $mailFacade,
        CustomerRegistrationToOneTimePasswordFacadeInterface $oneTimePasswordFacade
    ) {
        $this->mailFacade = $mailFacade;
        $this->oneTimePasswordFacade = $oneTimePasswordFacade;
    }

    /**
     * @param \Generated\Shared\Transfer\CustomerTransfer $customerTransfer
     *
     * @return void
     */
    public function sendWelcomeMail(CustomerTransfer $customerTransfer): void
    {
        $oneTimePasswordResponse = $this->oneTimePasswordFacade->generateLoginLink($customerTransfer);

        if (!$oneTimePasswordResponse->getIsSuccess()) {
            return;
        }

        $mailTransfer = (new MailTransfer())
            ->setOneTimePasswordLoginLink($oneTimePasswordResponse->getLoginLink())
            ->setType(CustomerRegistrationWelcomeMailjetMailTypeBuilder::MAIL_TYPE)
            ->setCustomer($customerTransfer)
            ->setLocale($customerTransfer->getLocale())
            ->setEmailVerificationLink('');

        $this->mailFacade->handleMail($mailTransfer);
    }
}
