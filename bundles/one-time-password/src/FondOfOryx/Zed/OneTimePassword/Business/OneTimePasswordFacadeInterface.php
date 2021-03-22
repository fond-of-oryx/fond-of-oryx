<?php

namespace FondOfOryx\Zed\OneTimePassword\Business;

use Generated\Shared\Transfer\CustomerResponseTransfer;
use Generated\Shared\Transfer\CustomerTransfer;

interface OneTimePasswordFacadeInterface
{
    /**
     * Specification:
     * - Generate a new one time password for given customer and send him a mail with the new one time password
     * - Identifies customer by customer email
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\CustomerTransfer $customerTransfer
     *
     * @return \Generated\Shared\Transfer\CustomerResponseTransfer
     */
    public function requestOneTimePassword(
        CustomerTransfer $customerTransfer
    ): CustomerResponseTransfer;

    /**
     * Specification:
     * - Generate a new one time password for given customer
     * - Identifies customer by customer email
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\CustomerTransfer $customerTransfer
     *
     * @return \Generated\Shared\Transfer\CustomerResponseTransfer
     */
    public function generateOneTimePassword(
        CustomerTransfer $customerTransfer
    ): CustomerResponseTransfer;
}
