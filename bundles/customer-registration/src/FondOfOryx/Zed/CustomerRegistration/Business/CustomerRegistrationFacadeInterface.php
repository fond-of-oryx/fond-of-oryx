<?php

namespace FondOfOryx\Zed\CustomerRegistration\Business;

use Generated\Shared\Transfer\CustomerRegistrationRequestTransfer;
use Generated\Shared\Transfer\CustomerRegistrationResponseTransfer;
use Generated\Shared\Transfer\CustomerRegistrationTransfer;
use Generated\Shared\Transfer\CustomerTransfer;

interface CustomerRegistrationFacadeInterface
{
    /**
     * @param \Generated\Shared\Transfer\CustomerRegistrationRequestTransfer $customerRegistrationRequestTransfer
     *
     * @throws \Spryker\Shared\Kernel\Transfer\Exception\NullValueException
     * @throws \Spryker\Zed\Kernel\Exception\Container\ContainerKeyNotFoundException
     * @throws \Spryker\Zed\Locale\Business\Exception\MissingLocaleException
     *
     * @return \Generated\Shared\Transfer\CustomerRegistrationRequestTransfer
     */
    public function registerCustomer(
        CustomerRegistrationRequestTransfer $customerRegistrationRequestTransfer
    ): CustomerRegistrationRequestTransfer;

    /**
     * @param \Generated\Shared\Transfer\CustomerTransfer $customerTransfer
     *
     * @return void
     */
    public function sendWelcomeMail(CustomerTransfer $customerTransfer): void;

    /**
     * @param \Generated\Shared\Transfer\CustomerRegistrationTransfer $customerRegistrationTransfer
     *
     * @return void
     */
    public function handleKnownCustomer(CustomerRegistrationTransfer $customerRegistrationTransfer): void;
}
