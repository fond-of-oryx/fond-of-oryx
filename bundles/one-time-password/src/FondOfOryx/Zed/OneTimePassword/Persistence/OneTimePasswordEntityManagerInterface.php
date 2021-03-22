<?php

namespace FondOfOryx\Zed\OneTimePassword\Persistence;

use Generated\Shared\Transfer\SpyCustomerEntityTransfer;

interface OneTimePasswordEntityManagerInterface
{
    /**
     * @param \Generated\Shared\Transfer\SpyCustomerEntityTransfer $customerEntityTransfer
     *
     * @return int
     */
    public function updateCustomerPassword(SpyCustomerEntityTransfer $customerEntityTransfer): int;
}
