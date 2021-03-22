<?php

namespace FondOfOryx\Zed\OneTimePassword\Persistence;

use Generated\Shared\Transfer\SpyCustomerEntityTransfer;
use Spryker\Zed\Kernel\Persistence\AbstractEntityManager;

/**
 * @method \FondOfOryx\Zed\OneTimePassword\Persistence\OneTimePasswordPersistenceFactory getFactory()
 */
class OneTimePasswordEntityManager extends AbstractEntityManager implements OneTimePasswordEntityManagerInterface
{
    /**
     * @param \Generated\Shared\Transfer\SpyCustomerEntityTransfer $customerEntityTransfer
     *
     * @return int
     */
    public function updateCustomerPassword(SpyCustomerEntityTransfer $customerEntityTransfer): int
    {
        $customerEntityTransfer->requireEmail();

        return $this->getFactory()
            ->createSpyCustomer()
            ->filterByEmail($customerEntityTransfer->getEmail())
            ->update([
                'password' => $customerEntityTransfer->getPassword(),
            ]);
    }
}
