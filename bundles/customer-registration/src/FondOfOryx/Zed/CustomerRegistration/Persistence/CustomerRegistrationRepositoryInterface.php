<?php

namespace FondOfOryx\Zed\CustomerRegistration\Persistence;

use Generated\Shared\Transfer\CustomerTransfer;

interface CustomerRegistrationRepositoryInterface
{
    /**
     * @param string $token
     *
     * @return \Generated\Shared\Transfer\CustomerTransfer
     */
    public function findCustomerByToken(string $token): CustomerTransfer;
}
