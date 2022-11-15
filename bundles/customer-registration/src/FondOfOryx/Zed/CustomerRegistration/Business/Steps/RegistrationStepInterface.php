<?php

namespace FondOfOryx\Zed\CustomerRegistration\Business\Steps;

use Generated\Shared\Transfer\CustomerRegistrationRequestTransfer;
use Generated\Shared\Transfer\CustomerTransfer;

interface RegistrationStepInterface
{
    /**
     * @param string $email
     *
     * @return \Generated\Shared\Transfer\CustomerTransfer|null
     */
    public function findCustomer(string $email): ?CustomerTransfer;

    /**
     * @param \Generated\Shared\Transfer\CustomerRegistrationRequestTransfer $customerRegistrationRequestTransfer
     *
     * @throws \Spryker\Shared\Kernel\Transfer\Exception\NullValueException
     * @throws \Spryker\Zed\Locale\Business\Exception\MissingLocaleException
     *
     * @return \Generated\Shared\Transfer\CustomerRegistrationRequestTransfer
     */
    public function register(CustomerRegistrationRequestTransfer $customerRegistrationRequestTransfer): CustomerRegistrationRequestTransfer;
}
