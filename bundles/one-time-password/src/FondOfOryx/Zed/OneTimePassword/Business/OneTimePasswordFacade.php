<?php

namespace FondOfOryx\Zed\OneTimePassword\Business;

use Generated\Shared\Transfer\CustomerResponseTransfer;
use Generated\Shared\Transfer\CustomerTransfer;
use Spryker\Zed\Kernel\Business\AbstractFacade;

/**
 * @method \FondOfOryx\Zed\OneTimePassword\Persistence\OneTimePasswordEntityManagerInterface getEntityManager()
 * @method \FondOfOryx\Zed\OneTimePassword\Business\OneTimePasswordBusinessFactory getFactory()
 */
class OneTimePasswordFacade extends AbstractFacade implements OneTimePasswordFacadeInterface
{
    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\CustomerTransfer $customerTransfer
     *
     * @return \Generated\Shared\Transfer\CustomerResponseTransfer
     */
    public function requestOneTimePassword(
        CustomerTransfer $customerTransfer
    ): CustomerResponseTransfer {
        return $this->getFactory()
            ->createOneTimePasswordSender()
            ->requestOneTimePassword($customerTransfer);
    }

    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\CustomerTransfer $customerTransfer
     *
     * @return \Generated\Shared\Transfer\CustomerResponseTransfer
     */
    public function generateOneTimePassword(
        CustomerTransfer $customerTransfer
    ): CustomerResponseTransfer {
        return $this->getFactory()
            ->createOneTimePasswordGenerator()
            ->generateOneTimePassword($customerTransfer);
    }
}
