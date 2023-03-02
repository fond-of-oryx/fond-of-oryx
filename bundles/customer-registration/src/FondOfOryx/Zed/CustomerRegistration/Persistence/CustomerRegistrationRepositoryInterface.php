<?php

namespace FondOfOryx\Zed\CustomerRegistration\Persistence;

use Generated\Shared\Transfer\CustomerTransfer;

interface CustomerRegistrationRepositoryInterface
{
    /**
     * @param int $idCustomer
     *
     * @return \Generated\Shared\Transfer\CustomerTransfer
     */
    public function findCustomerById(int $idCustomer): CustomerTransfer;
}
