<?php

namespace FondOfOryx\Zed\OneTimePassword\Business;

use Generated\Shared\Transfer\CustomerTransfer;
use Generated\Shared\Transfer\OneTimePasswordResponseTransfer;
use Generated\Shared\Transfer\OrderTransfer;
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
     * @return \Generated\Shared\Transfer\OneTimePasswordResponseTransfer
     */
    public function requestOneTimePassword(
        CustomerTransfer $customerTransfer
    ): OneTimePasswordResponseTransfer {
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
     * @return \Generated\Shared\Transfer\OneTimePasswordResponseTransfer
     */
    public function generateOneTimePassword(
        CustomerTransfer $customerTransfer
    ): OneTimePasswordResponseTransfer {
        return $this->getFactory()
            ->createOneTimePasswordGenerator()
            ->generateOneTimePassword($customerTransfer);
    }

    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\CustomerTransfer $customerTransfer
     *
     * @return void
     */
    public function resetOneTimePassword(CustomerTransfer $customerTransfer): void
    {
        $this->getFactory()
            ->createOneTimePasswordResetter()
            ->resetOneTimePassword($customerTransfer);
    }

    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\CustomerTransfer $customerTransfer
     *
     * @return \Generated\Shared\Transfer\OneTimePasswordResponseTransfer
     */
    public function generateLoginLink(
        CustomerTransfer $customerTransfer
    ): OneTimePasswordResponseTransfer {
        return $this->getFactory()
            ->createOneTimePasswordLinkGenerator()
            ->generateLoginLink($customerTransfer);
    }

    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\OrderTransfer $orderTransfer
     *
     * @return \Generated\Shared\Transfer\OneTimePasswordResponseTransfer
     */
    public function generateLoginLinkWithOrderReference(
        OrderTransfer $orderTransfer
    ): OneTimePasswordResponseTransfer {
        return $this->getFactory()
            ->createOneTimePasswordLinkGenerator()
            ->generateLoginLinkWithOrderReference(
                $orderTransfer
            );
    }
}
