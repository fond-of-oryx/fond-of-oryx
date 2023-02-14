<?php

namespace FondOfOryx\Zed\CustomerRegistration\Business\Processor;

use FondOfOryx\Zed\CustomerRegistration\CustomerRegistrationConfig;
use FondOfOryx\Zed\CustomerRegistration\Dependency\Facade\CustomerRegistrationToCustomerFacadeInterface;
use FondOfOryx\Zed\CustomerRegistration\Dependency\Facade\CustomerRegistrationToMailFacadeInterface;
use FondOfOryx\Zed\CustomerRegistration\Dependency\Facade\CustomerRegistrationToOneTimePasswordFacadeInterface;
use Generated\Shared\Transfer\CustomerRegistrationTransfer;
use Generated\Shared\Transfer\CustomerTransfer;
use Generated\Shared\Transfer\MailTransfer;

class CustomerRegistrationHandler implements CustomerRegistrationHandlerInterface
{
    /**
     * @var \FondOfOryx\Zed\CustomerRegistration\Dependency\Facade\CustomerRegistrationToCustomerFacadeInterface
     */
    protected CustomerRegistrationToCustomerFacadeInterface $customerFacade;

    /**
     * @var \FondOfOryx\Zed\CustomerRegistration\Dependency\Facade\CustomerRegistrationToOneTimePasswordFacadeInterface
     */
    protected CustomerRegistrationToOneTimePasswordFacadeInterface $oneTimePasswordFacade;

    /**
     * @var \FondOfOryx\Zed\CustomerRegistration\Dependency\Facade\CustomerRegistrationToMailFacadeInterface
     */
    protected CustomerRegistrationToMailFacadeInterface $mailFacade;

    /**
     * @var \FondOfOryx\Zed\CustomerRegistration\CustomerRegistrationConfig
     */
    protected CustomerRegistrationConfig $config;

    /**
     * @param \FondOfOryx\Zed\CustomerRegistration\Dependency\Facade\CustomerRegistrationToCustomerFacadeInterface $customerFacade
     * @param \FondOfOryx\Zed\CustomerRegistration\Dependency\Facade\CustomerRegistrationToOneTimePasswordFacadeInterface $oneTimePasswordFacade
     * @param \FondOfOryx\Zed\CustomerRegistration\Dependency\Facade\CustomerRegistrationToMailFacadeInterface $mailFacade
     * @param \FondOfOryx\Zed\CustomerRegistration\CustomerRegistrationConfig $config
     */
    public function __construct(
        CustomerRegistrationToCustomerFacadeInterface $customerFacade,
        CustomerRegistrationToOneTimePasswordFacadeInterface $oneTimePasswordFacade,
        CustomerRegistrationToMailFacadeInterface $mailFacade,
        CustomerRegistrationConfig $config
    ) {
        $this->customerFacade = $customerFacade;
        $this->oneTimePasswordFacade = $oneTimePasswordFacade;
        $this->mailFacade = $mailFacade;
        $this->config = $config;
    }

    /**
     * @param \Generated\Shared\Transfer\CustomerRegistrationTransfer $customerRegistrationTransfer
     *
     * @return void
     */
    public function handleKnownCustomer(CustomerRegistrationTransfer $customerRegistrationTransfer): void
    {
        /** @var \Generated\Shared\Transfer\CustomerTransfer $customerTransfer */
        $customerTransfer = $customerRegistrationTransfer->getCustomerOrFail();
        $customer = $this->customerFacade->getCustomer($customerTransfer);

        $registrationKey = $customer->getRegistrationKey();

        if ($registrationKey === null) {
            $this->oneTimePasswordFacade->requestLoginLink($customerTransfer, $customerRegistrationTransfer->getOneTimePasswordAttributes());

            return;
        }

        $this->sendRegistrationToken($customerTransfer);
    }

    /**
     * @param \Generated\Shared\Transfer\CustomerTransfer $customerTransfer
     *
     * @return void
     */
    protected function sendRegistrationToken(CustomerTransfer $customerTransfer): void
    {
        $confirmationLink = $this->config
            ->getRegisterConfirmTokenUrl($customerTransfer->getRegistrationKey());

        $customerTransfer->setConfirmationLink($confirmationLink);

        $mailTransfer = new MailTransfer();
        $mailTransfer->setType(CustomerRegistrationConfig::CUSTOMER_REGISTRATION_WITH_CONFIRMATION_MAIL_TYPE);
        $mailTransfer->setCustomer($customerTransfer);
        $mailTransfer->setLocale($customerTransfer->getLocale());

        $this->mailFacade->handleMail($mailTransfer);
    }
}
