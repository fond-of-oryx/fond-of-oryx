<?php

namespace FondOfOryx\Zed\OneTimePassword\Persistence;

use Generated\Shared\Transfer\CustomerResponseTransfer;
use Generated\Shared\Transfer\CustomerTransfer;
use Spryker\Zed\Kernel\Persistence\AbstractEntityManager;

/**
 * @method \FondOfOryx\Zed\OneTimePassword\Persistence\OneTimePasswordPersistenceFactory getFactory()
 */
class OneTimePasswordEntityManager extends AbstractEntityManager implements OneTimePasswordEntityManagerInterface
{
    protected const COLUMN_PASSWORD = 'Password';

    /**
     * @param \Generated\Shared\Transfer\CustomerTransfer $customerTransfer
     *
     * @return \Generated\Shared\Transfer\CustomerResponseTransfer
     */
    public function updateCustomerPassword(CustomerTransfer $customerTransfer): CustomerResponseTransfer
    {
        $customerTransfer->requireEmail()->requireNewPassword();

        $changesRows = $this->getFactory()
            ->getCustomerQueryContainer()
            ->queryCustomerByEmail($customerTransfer->getEmail())
            ->update([
                static::COLUMN_PASSWORD => $customerTransfer->getNewPassword(),
            ]);

        $customerTransfer->setPassword($customerTransfer->getNewPassword())
            ->setNewPassword(null);

        return (new CustomerResponseTransfer())
            ->setIsSuccess($changesRows > 0)
            ->setCustomerTransfer($customerTransfer);
    }
}
