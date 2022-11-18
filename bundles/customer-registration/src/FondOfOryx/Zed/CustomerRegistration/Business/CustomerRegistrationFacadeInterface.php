<?php

namespace FondOfOryx\Zed\CustomerRegistration\Business;

use Generated\Shared\Transfer\CustomerRegistrationRequestTransfer;
use Generated\Shared\Transfer\CustomerRegistrationResponseTransfer;
use Generated\Shared\Transfer\CustomerTransfer;

interface CustomerRegistrationFacadeInterface
{
    /**
     * @param \Generated\Shared\Transfer\CustomerRegistrationRequestTransfer $customerRegistrationRequestTransfer
     *
     * @return \Generated\Shared\Transfer\CustomerRegistrationResponseTransfer
     */
    public function customerRegistration(
        CustomerRegistrationRequestTransfer $customerRegistrationRequestTransfer
    ): CustomerRegistrationResponseTransfer;

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
     * @param \Generated\Shared\Transfer\CustomerRegistrationRequestTransfer $customerRegistrationRequestTransfer
     *
     * @throws \Spryker\Shared\Kernel\Transfer\Exception\NullValueException
     * @throws \Spryker\Zed\Kernel\Exception\Container\ContainerKeyNotFoundException
     * @throws \Spryker\Zed\Locale\Business\Exception\MissingLocaleException
     *
     * @return \Generated\Shared\Transfer\CustomerRegistrationRequestTransfer
     */
    public function verifyMail(
        CustomerRegistrationRequestTransfer $customerRegistrationRequestTransfer
    ): CustomerRegistrationRequestTransfer;

    /**
     * @param \Generated\Shared\Transfer\CustomerRegistrationRequestTransfer $customerRegistrationRequestTransfer
     *
     * @throws \Spryker\Shared\Kernel\Transfer\Exception\NullValueException
     * @throws \Spryker\Zed\Kernel\Exception\Container\ContainerKeyNotFoundException
     * @throws \Spryker\Zed\Locale\Business\Exception\MissingLocaleException
     *
     * @return \Generated\Shared\Transfer\CustomerRegistrationRequestTransfer
     */
    public function checkGdpr(
        CustomerRegistrationRequestTransfer $customerRegistrationRequestTransfer
    ): CustomerRegistrationRequestTransfer;

    /**
     * @param \Generated\Shared\Transfer\CustomerTransfer $customerTransfer
     *
     * @throws \Spryker\Zed\Kernel\Exception\Container\ContainerKeyNotFoundException
     *
     * @return string
     */
    public function generateEmailVerificationLink(CustomerTransfer $customerTransfer): string;

    /**
     * @param \Generated\Shared\Transfer\CustomerTransfer $customerTransfer
     *
     * @return \Generated\Shared\Transfer\CustomerTransfer
     * @throws \Spryker\Zed\Kernel\Exception\Container\ContainerKeyNotFoundException
     *
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function flagCustomerAsGdprAccepted(CustomerTransfer $customerTransfer): CustomerTransfer;

    /**
     * @param \Generated\Shared\Transfer\CustomerTransfer $customerTransfer
     *
     * @return \Generated\Shared\Transfer\CustomerTransfer
     * @throws \Spryker\Zed\Kernel\Exception\Container\ContainerKeyNotFoundException
     *
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function saveRegistrationKeyToCustomer(CustomerTransfer $customerTransfer): CustomerTransfer;

    /**
     * @return string
     */
    public function generateToken(): string;
}
