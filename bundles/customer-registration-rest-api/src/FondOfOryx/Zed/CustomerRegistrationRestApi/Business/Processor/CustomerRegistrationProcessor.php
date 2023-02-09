<?php

namespace FondOfOryx\Zed\CustomerRegistrationRestApi\Business\Processor;

use FondOfOryx\Zed\CustomerRegistrationRestApi\CustomerRegistrationRestApiConfig;
use FondOfOryx\Zed\CustomerRegistrationRestApi\Dependency\Facade\CustomerRegistrationRestApiToCustomerFacadeInterface;
use FondOfOryx\Zed\CustomerRegistrationRestApi\Dependency\Facade\CustomerRegistrationRestApiToMailFacadeInterface;
use FondOfOryx\Zed\CustomerRegistrationRestApi\Dependency\Facade\CustomerRegistrationRestApiToOneTimePasswordFacadeInterface;
use Generated\Shared\Transfer\CustomerTransfer;
use Generated\Shared\Transfer\MailTransfer;

class CustomerRegistrationProcessor implements CustomerRegistrationProcessorInterface
{
    /**
     * @var \FondOfOryx\Zed\CustomerRegistrationRestApi\Dependency\Facade\CustomerRegistrationRestApiToCustomerFacadeInterface
     */
    protected CustomerRegistrationRestApiToCustomerFacadeInterface $customerFacade;

    /**
     * @var \FondOfOryx\Zed\CustomerRegistrationRestApi\Dependency\Facade\CustomerRegistrationRestApiToOneTimePasswordFacadeInterface
     */
    protected CustomerRegistrationRestApiToOneTimePasswordFacadeInterface $oneTimePasswordFacade;

    /**
     * @var \FondOfOryx\Zed\CustomerRegistrationRestApi\Dependency\Facade\CustomerRegistrationRestApiToMailFacadeInterface
     */
    protected CustomerRegistrationRestApiToMailFacadeInterface $mailFacade;

    /**
     * @var \FondOfOryx\Zed\CustomerRegistrationRestApi\CustomerRegistrationRestApiConfig
     */
    protected CustomerRegistrationRestApiConfig $config;

    /**
     * @param \FondOfOryx\Zed\CustomerRegistrationRestApi\Dependency\Facade\CustomerRegistrationRestApiToCustomerFacadeInterface $customerFacade
     * @param \FondOfOryx\Zed\CustomerRegistrationRestApi\Dependency\Facade\CustomerRegistrationRestApiToOneTimePasswordFacadeInterface $oneTimePasswordFacade
     * @param \FondOfOryx\Zed\CustomerRegistrationRestApi\Dependency\Facade\CustomerRegistrationRestApiToMailFacadeInterface $mailFacade
     * @param \FondOfOryx\Zed\CustomerRegistrationRestApi\CustomerRegistrationRestApiConfig $config
     */
    public function __construct(
        CustomerRegistrationRestApiToCustomerFacadeInterface $customerFacade,
        CustomerRegistrationRestApiToOneTimePasswordFacadeInterface $oneTimePasswordFacade,
        CustomerRegistrationRestApiToMailFacadeInterface $mailFacade,
        CustomerRegistrationRestApiConfig $config
    ) {
        $this->customerFacade = $customerFacade;
        $this->oneTimePasswordFacade = $oneTimePasswordFacade;
        $this->mailFacade = $mailFacade;
        $this->config = $config;
    }

    /**
     * @param \Generated\Shared\Transfer\CustomerTransfer $customerTransfer
     *
     * @return void
     */
    public function handleKnownCustomer(CustomerTransfer $customerTransfer): void
    {
        $customer = $this->customerFacade->getCustomer($customerTransfer);

        $registrationKey = $customer->getRegistrationKey();

        if ($registrationKey === null) {
            $this->oneTimePasswordFacade->requestLoginLink($customerTransfer);
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
        $mailTransfer->setType(CustomerRegistrationRestApiConfig::CUSTOMER_REGISTRATION_WITH_CONFIRMATION_MAIL_TYPE);
        $mailTransfer->setCustomer($customerTransfer);
        $mailTransfer->setLocale($customerTransfer->getLocale());

        $this->mailFacade->handleMail($mailTransfer);
    }
}