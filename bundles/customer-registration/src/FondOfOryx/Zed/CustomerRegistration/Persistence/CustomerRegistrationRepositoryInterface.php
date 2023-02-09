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

    /**
     * @param int $idCustomer
     *
     * @return \Orm\Zed\Customer\Persistence\SpyCustomerQuery
     */
    public function findCustomerById(int $idCustomer): CustomerTransfer;
}
