<?php

namespace FondOfOryx\Zed\OneTimePasswordRestApi\Business\Sender;

use Exception;
use FondOfOryx\Zed\OneTimePasswordRestApi\Dependency\Facade\OneTimePasswordRestApiToCustomerFacadeInterface;
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
     * @var \FondOfOryx\Zed\OneTimePasswordRestApi\Dependency\Facade\OneTimePasswordRestApiToCustomerFacadeInterface
     */
    protected $customerFacade;

    /**
     * @param \FondOfOryx\Zed\OneTimePasswordRestApi\Dependency\Facade\OneTimePasswordRestApiToOneTimePasswordFacadeInterface $oneTimePasswordFacade
     * @param \FondOfOryx\Zed\OneTimePasswordRestApi\Dependency\Facade\OneTimePasswordRestApiToCustomerFacadeInterface $customerFacade
     */
    public function __construct(
        OneTimePasswordRestApiToOneTimePasswordFacadeInterface $oneTimePasswordFacade,
        OneTimePasswordRestApiToCustomerFacadeInterface $customerFacade
    ) {
        $this->oneTimePasswordFacade = $oneTimePasswordFacade;
        $this->customerFacade = $customerFacade;
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

        try {
            $customerTransfer = $this->getCustomerByEmail($email);
        } catch (Exception $customerNotFoundException) {
            return (new RestOneTimePasswordResponseTransfer())->setSuccess(false);
        }

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

        try {
            $customerTransfer = $this->getCustomerByEmail($email);
        } catch (Exception $customerNotFoundException) {
            return (new RestOneTimePasswordResponseTransfer())->setSuccess(false);
        }

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
     * @param string $email
     *
     * @return \Generated\Shared\Transfer\CustomerTransfer
     */
    protected function getCustomerByEmail(string $email): CustomerTransfer
    {
        $customerTransfer = (new CustomerTransfer())->setEmail($email);

        return $this->customerFacade->getCustomer($customerTransfer);
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
