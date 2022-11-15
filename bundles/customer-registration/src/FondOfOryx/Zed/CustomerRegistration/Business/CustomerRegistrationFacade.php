<?php

namespace FondOfOryx\Zed\CustomerRegistration\Business;

use Generated\Shared\Transfer\CustomerRegistrationRequestTransfer;
use Generated\Shared\Transfer\CustomerRegistrationResponseTransfer;
use Generated\Shared\Transfer\CustomerTransfer;
use Spryker\Zed\Kernel\Business\AbstractFacade;

/**
 * @method \FondOfOryx\Zed\CustomerRegistration\Business\CustomerRegistrationBusinessFactory getFactory()
 */
class CustomerRegistrationFacade extends AbstractFacade implements CustomerRegistrationFacadeInterface
{
    /**
     * @param \Generated\Shared\Transfer\CustomerRegistrationRequestTransfer $customerRegistrationRequestTransfer
     *
     * @return \Generated\Shared\Transfer\CustomerRegistrationResponseTransfer
     */
    public function customerRegistration(CustomerRegistrationRequestTransfer $customerRegistrationRequestTransfer): CustomerRegistrationResponseTransfer
    {
        return $this->getFactory()->createCustomerRegistrationProcessor()->processCustomerRegistration($customerRegistrationRequestTransfer);
    }

    /**
     * @param \Generated\Shared\Transfer\CustomerRegistrationRequestTransfer $customerRegistrationRequestTransfer
     *
     * @return \Generated\Shared\Transfer\CustomerRegistrationRequestTransfer
     */
    public function registerCustomer(
        CustomerRegistrationRequestTransfer $customerRegistrationRequestTransfer
    ): CustomerRegistrationRequestTransfer {
        return $this->getFactory()
            ->createRegistrationStep()
            ->register($customerRegistrationRequestTransfer);
    }

    /**
     * @param \Generated\Shared\Transfer\CustomerRegistrationRequestTransfer $customerRegistrationRequestTransfer
     *
     * @return \Generated\Shared\Transfer\CustomerRegistrationRequestTransfer
     */
    public function verifyMail(CustomerRegistrationRequestTransfer $customerRegistrationRequestTransfer): CustomerRegistrationRequestTransfer
    {
        return $this->getFactory()
            ->createMailVerificationStep()
            ->verifyEmail($customerRegistrationRequestTransfer);
    }

    /**
     * @param \Generated\Shared\Transfer\CustomerRegistrationRequestTransfer $customerRegistrationRequestTransfer
     *
     * @return \Generated\Shared\Transfer\CustomerRegistrationRequestTransfer
     */
    public function checkGdpr(CustomerRegistrationRequestTransfer $customerRegistrationRequestTransfer): CustomerRegistrationRequestTransfer
    {
        return $this->getFactory()
            ->createGdprStep()
            ->checkGdprState($customerRegistrationRequestTransfer);
    }

    /**
     * @param \Generated\Shared\Transfer\CustomerTransfer $customerTransfer
     *
     * @return string
     */
    public function generateEmailVerificationLink(CustomerTransfer $customerTransfer): string
    {
        return $this->getFactory()
            ->createEmailVerificationLinkGenerator()
            ->generateLink($customerTransfer);
    }
}
