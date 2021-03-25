<?php

namespace FondOfOryx\Zed\OneTimePassword\Persistence;

use Generated\Shared\Transfer\CustomerResponseTransfer;
use Generated\Shared\Transfer\CustomerTransfer;

interface OneTimePasswordEntityManagerInterface
{
    /**
     * @param \Generated\Shared\Transfer\CustomerTransfer $customerTransfer
     *
     * @return \Generated\Shared\Transfer\CustomerResponseTransfer
     */
    public function updateCustomerPassword(CustomerTransfer $customerTransfer): CustomerResponseTransfer;

    /**
     * @param \Generated\Shared\Transfer\CustomerTransfer $customerTransfer
     *
     * @return void
     */
    public function resetCustomerPassword(CustomerTransfer $customerTransfer): void;
}
