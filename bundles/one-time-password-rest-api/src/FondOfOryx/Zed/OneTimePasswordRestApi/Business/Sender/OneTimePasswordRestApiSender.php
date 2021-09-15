<?php

namespace FondOfOryx\Zed\OneTimePasswordRestApi\Business\Sender;

use FondOfOryx\Zed\OneTimePasswordRestApi\Dependency\Facade\OneTimePasswordRestApiToOneTimePasswordFacadeInterface;
use Generated\Shared\Transfer\CustomerTransfer;
use Generated\Shared\Transfer\OneTimePasswordResponseTransfer;
use Generated\Shared\Transfer\OrderTransfer;
use Generated\Shared\Transfer\RestOneTimePasswordLoginLinkRequestAttributesTransfer;
use Generated\Shared\Transfer\RestOneTimePasswordRequestAttributesTransfer;
use Generated\Shared\Transfer\RestOneTimePasswordResponseTransfer;

class OneTimePasswordRestApiSender implements OneTimePasswordRestApiSenderInterface
{
    /**
     * @var \FondOfOryx\Zed\OneTimePasswordRestApi\Dependency\Facade\OneTimePasswordRestApiToOneTimePasswordFacadeInterface
     */
    protected $oneTimePasswordFacade;

    /**
     * @param \FondOfOryx\Zed\OneTimePasswordRestApi\Dependency\Facade\OneTimePasswordRestApiToOneTimePasswordFacadeInterface $oneTimePasswordFacade
     */
    public function __construct(OneTimePasswordRestApiToOneTimePasswordFacadeInterface $oneTimePasswordFacade)
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

        return $this->createRestOneTimePasswordResponseTransfer(
            $oneTimePasswordResponseTransfer
        );
    }

    /**
     * @param \Generated\Shared\Transfer\RestOneTimePasswordLoginLinkRequestAttributesTransfer $restOneTimePasswordRequestAttributesTransfer
     *
     * @return \Generated\Shared\Transfer\RestOneTimePasswordResponseTransfer
     */
    public function requestLoginLink(
        RestOneTimePasswordLoginLinkRequestAttributesTransfer $restOneTimePasswordRequestAttributesTransfer
    ): RestOneTimePasswordResponseTransfer {
        $email = $restOneTimePasswordRequestAttributesTransfer->getEmail();

        $customerTransfer = (new CustomerTransfer())->setEmail($email);

        if ($restOneTimePasswordRequestAttributesTransfer->getOrderReference()) {
            $orderTransfer = (new OrderTransfer())
                ->setCustomer($customerTransfer)
                ->setOrderReference($restOneTimePasswordRequestAttributesTransfer->getOrderReference());

            $oneTimePasswordResponseTransfer = $this->oneTimePasswordFacade->requestLoginLinkWithOrderReference($orderTransfer);

            return $this->createRestOneTimePasswordResponseTransfer(
                $oneTimePasswordResponseTransfer
            );
        }

        $oneTimePasswordResponseTransfer = $this->oneTimePasswordFacade->requestLoginLink($customerTransfer);

        return $this->createRestOneTimePasswordResponseTransfer(
            $oneTimePasswordResponseTransfer
        );
    }

    /**
     * @param \Generated\Shared\Transfer\OneTimePasswordResponseTransfer $oneTimePasswordResponseTransfer
     *
     * @return \Generated\Shared\Transfer\RestOneTimePasswordResponseTransfer
     */
    protected function createRestOneTimePasswordResponseTransfer(
        OneTimePasswordResponseTransfer $oneTimePasswordResponseTransfer
    ): RestOneTimePasswordResponseTransfer {
        return (new RestOneTimePasswordResponseTransfer())
            ->setSuccess($oneTimePasswordResponseTransfer->getIsSuccess());
    }
}
