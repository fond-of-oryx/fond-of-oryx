<?php

namespace FondOfOryx\Zed\OneTimePassword\Business;

use Generated\Shared\Transfer\CustomerTransfer;
use Generated\Shared\Transfer\OneTimePasswordResponseTransfer;
use Generated\Shared\Transfer\OrderTransfer;

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
     * @return \Generated\Shared\Transfer\OneTimePasswordResponseTransfer
     */
    public function requestOneTimePassword(
        CustomerTransfer $customerTransfer
    ): OneTimePasswordResponseTransfer;

    /**
     * Specification:
     * - Generate a new one time password for given customer
     * - Identifies customer by customer email
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\CustomerTransfer $customerTransfer
     *
     * @return \Generated\Shared\Transfer\OneTimePasswordResponseTransfer
     */
    public function generateOneTimePassword(
        CustomerTransfer $customerTransfer
    ): OneTimePasswordResponseTransfer;

    /**
     * Specification:
     * - Invalidate current one time password
     * - Identifies customer by customer reference
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\CustomerTransfer $customerTransfer
     *
     * @return void
     */
    public function resetOneTimePassword(CustomerTransfer $customerTransfer): void;

    /**
     * Specification:
     * - Generate a new one time password for given customer
     * - Identifies customer by customer email
     * - Creates a Link with login parameters
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\CustomerTransfer $customerTransfer
     *
     * @return string|null
     */
    public function generateLoginLink(
        CustomerTransfer $customerTransfer
    ): ?string;

    /**
     * Specification:
     * - Generate a new one time password for given customer
     * - Identifies customer by customer email
     * - Creates a Link with login parameters
     * - Add order reference to query params
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\OrderTransfer $orderTransfer
     *
     * @return string|null
     */
    public function generateLoginLinkWithOrderReference(
        OrderTransfer $orderTransfer
    ): ?string;
}
