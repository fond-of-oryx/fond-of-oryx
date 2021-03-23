<?php

namespace FondOfOryx\Zed\OneTimePasswordRestApi\Business\Sender;

use FondOfOryx\Zed\OneTimePassword\Business\OneTimePasswordFacadeInterface;
use Generated\Shared\Transfer\CustomerTransfer;
use Generated\Shared\Transfer\RestOneTimePasswordRequestAttributesTransfer;
use Generated\Shared\Transfer\RestOneTimePasswordResponseTransfer;

class OneTimePasswordRestApiSender implements OneTimePasswordRestApiSenderInterface
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
     * @param \Generated\Shared\Transfer\RestOneTimePasswordRequestAttributesTransfer $restOneTimePasswordRequestAttributesTransfer
     *
     * @return \Generated\Shared\Transfer\RestOneTimePasswordResponseTransfer
     */
    public function requestOneTimePassword(
        RestOneTimePasswordRequestAttributesTransfer $restOneTimePasswordRequestAttributesTransfer
    ): RestOneTimePasswordResponseTransfer {
        $email = $restOneTimePasswordRequestAttributesTransfer->getEmail();

        $customerTransfer = (new CustomerTransfer())->setEmail($email);

        $oneTimePasswordResponseTransfer = $this->oneTimePasswordFacade->requestOneTimePassword($customerTransfer);

        return (new RestOneTimePasswordResponseTransfer())
            ->setSuccess($oneTimePasswordResponseTransfer->getIsSuccess());
    }
}
