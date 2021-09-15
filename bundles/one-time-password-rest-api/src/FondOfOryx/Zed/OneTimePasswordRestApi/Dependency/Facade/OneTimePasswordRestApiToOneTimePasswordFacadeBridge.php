<?php

namespace FondOfOryx\Zed\OneTimePasswordRestApi\Dependency\Facade;

use FondOfOryx\Zed\OneTimePassword\Business\OneTimePasswordFacadeInterface;
use Generated\Shared\Transfer\CustomerTransfer;
use Generated\Shared\Transfer\OneTimePasswordResponseTransfer;
use Generated\Shared\Transfer\OrderTransfer;

class OneTimePasswordRestApiToOneTimePasswordFacadeBridge implements OneTimePasswordRestApiToOneTimePasswordFacadeInterface
{
    /**
     * @var \FondOfOryx\Zed\OneTimePassword\Business\OneTimePasswordFacadeInterface
     */
    protected $oneTimePasswordFacade;

    /**
     * @param \FondOfOryx\Zed\OneTimePassword\Business\OneTimePasswordFacadeInterface $oneTimePasswordFacade
     */
    public function __construct(OneTimePasswordFacadeInterface $oneTimePasswordFacade)
    {
        $this->oneTimePasswordFacade = $oneTimePasswordFacade;
    }

    /**
     * @param \Generated\Shared\Transfer\CustomerTransfer $customerTransfer
     *
     * @return \Generated\Shared\Transfer\OneTimePasswordResponseTransfer
     */
    public function requestOneTimePassword(CustomerTransfer $customerTransfer): OneTimePasswordResponseTransfer
    {
        return $this->oneTimePasswordFacade->requestOneTimePassword($customerTransfer);
    }

    /**
     * @param \Generated\Shared\Transfer\CustomerTransfer $customerTransfer
     *
     * @return \Generated\Shared\Transfer\OneTimePasswordResponseTransfer
     */
    public function requestLoginLink(CustomerTransfer $customerTransfer): OneTimePasswordResponseTransfer
    {
        return $this->oneTimePasswordFacade->requestLoginLink($customerTransfer);
    }

    /**
     * @param \Generated\Shared\Transfer\OrderTransfer $orderTransfer
     *
     * @return \Generated\Shared\Transfer\OneTimePasswordResponseTransfer
     */
    public function requestLoginLinkWithOrderReference(OrderTransfer $orderTransfer): OneTimePasswordResponseTransfer
    {
        return $this->oneTimePasswordFacade->requestLoginLinkWithOrderReference($orderTransfer);
    }
}
