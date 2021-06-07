<?php

namespace FondOfOryx\Zed\AvailabilityAlert\Business\Model;

use Exception;
use Generated\Shared\Transfer\AvailabilityAlertSubscriptionErrorTransfer;
use Generated\Shared\Transfer\AvailabilityAlertSubscriptionResponseTransfer;
use Generated\Shared\Transfer\AvailabilityAlertSubscriptionTransfer;

class SubscriptionRequestHandler implements SubscriptionRequestHandlerInterface
{
    /**
     * @var \FondOfOryx\Zed\AvailabilityAlert\Business\Model\SubscriptionManagerInterface
     */
    protected $subscriptionManager;

    /**
     * @param \FondOfOryx\Zed\AvailabilityAlert\Business\Model\SubscriptionManagerInterface $subscriptionManager
     */
    public function __construct(
        SubscriptionManagerInterface $subscriptionManager
    ) {
        $this->subscriptionManager = $subscriptionManager;
    }

    /**
     * @param \Generated\Shared\Transfer\AvailabilityAlertSubscriptionTransfer $availabilityAlertSubscriptionTransfer
     * @param bool $preferFromTransfer
     *
     * @return \Generated\Shared\Transfer\AvailabilityAlertSubscriptionResponseTransfer
     */
    public function processAvailabilityAlertSubscription(
        AvailabilityAlertSubscriptionTransfer $availabilityAlertSubscriptionTransfer,
        bool $preferFromTransfer = false
    ): AvailabilityAlertSubscriptionResponseTransfer {
        $subscriptionResponse = $this->createSubscriptionResponse();

        $subscriptionResponse->setIsSuccess(true);

        try {
            if (!$this->subscriptionManager->isAlreadySubscribed($availabilityAlertSubscriptionTransfer)) {
                $subscription = $this->subscriptionManager->subscribe($availabilityAlertSubscriptionTransfer, $preferFromTransfer);
                $subscriptionResponse->setSubscription($subscription);
            }
        } catch (Exception $e) {
            $subscriptionError = $this->createSubscriptionError();
            $subscriptionError->setMessage($e->getMessage());

            $subscriptionResponse->setIsSuccess(false)
                ->addError($subscriptionError);
        }

        return $subscriptionResponse;
    }

    /**
     * @return \Generated\Shared\Transfer\AvailabilityAlertSubscriptionResponseTransfer
     */
    protected function createSubscriptionResponse()
    {
        return new AvailabilityAlertSubscriptionResponseTransfer();
    }

    /**
     * @return \Generated\Shared\Transfer\AvailabilityAlertSubscriptionErrorTransfer
     */
    protected function createSubscriptionError()
    {
        return new AvailabilityAlertSubscriptionErrorTransfer();
    }
}
