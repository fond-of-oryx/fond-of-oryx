<?php

namespace FondOfOryx\Zed\CustomerRegistrationRestApi\Dependency\Facade;

use FondOfOryx\Zed\OneTimePassword\Business\OneTimePasswordFacadeInterface;
use Generated\Shared\Transfer\CustomerTransfer;
use Generated\Shared\Transfer\OneTimePasswordResponseTransfer;

class CustomerRegistrationRestApiToOneTimePasswordFacadeBridge implements CustomerRegistrationRestApiToOneTimePasswordFacadeInterface
{
    /**
     * @var \FondOfOryx\Zed\OneTimePassword\Business\OneTimePasswordFacadeInterface
     */
    protected OneTimePasswordFacadeInterface $oneTimePasswordFacade;

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
    public function requestLoginLink(CustomerTransfer $customerTransfer): OneTimePasswordResponseTransfer
    {
        return $this->oneTimePasswordFacade->requestLoginLink($customerTransfer);
    }
}
