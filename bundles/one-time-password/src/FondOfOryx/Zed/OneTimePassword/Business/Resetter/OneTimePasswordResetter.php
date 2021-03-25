<?php

namespace FondOfOryx\Zed\OneTimePassword\Business\Resetter;

use FondOfOryx\Zed\OneTimePassword\Persistence\OneTimePasswordEntityManagerInterface;
use Generated\Shared\Transfer\CustomerTransfer;

class OneTimePasswordResetter implements OneTimePasswordResetterInterface
{
    /**
     * @var \FondOfOryx\Zed\OneTimePassword\Persistence\OneTimePasswordEntityManagerInterface
     */
    protected $oneTimePasswordEntityManager;

    /**
     * @param \FondOfOryx\Zed\OneTimePassword\Persistence\OneTimePasswordEntityManagerInterface $oneTimePasswordEntityManager
     */
    public function __construct(OneTimePasswordEntityManagerInterface $oneTimePasswordEntityManager)
    {
        $this->oneTimePasswordEntityManager = $oneTimePasswordEntityManager;
    }

    /**
     * @param \Generated\Shared\Transfer\CustomerTransfer $customerTransfer
     *
     * @return void
     */
    public function resetOneTimePassword(CustomerTransfer $customerTransfer): void
    {
        $this->oneTimePasswordEntityManager->resetCustomerPassword($customerTransfer);
    }
}
