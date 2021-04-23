<?php

namespace FondOfOryx\Zed\AvailabilityAlertCrossEngage\Business\Handler;

use Exception;
use FondOfOryx\Zed\AvailabilityAlertCrossEngage\Dependency\Facade\AvailabilityAlertCrossEngageToJellyfishAvailabilityAlertFacadeInterface;
use Generated\Shared\Transfer\AvailabilityAlertCrossEngageSubscriberRegistrationResponseTransfer;
use Generated\Shared\Transfer\AvailabilityAlertSubscriberTransfer;

class RegisterSubscriberHandler implements RegisterSubscriberHandlerInterface
{
    /**
     * @var \FondOfOryx\Zed\AvailabilityAlertCrossEngage\Dependency\Facade\AvailabilityAlertCrossEngageToJellyfishAvailabilityAlertFacadeInterface
     */
    protected $jellyfishAvailabilityAlertFacade;

    /**
     * @param \FondOfOryx\Zed\AvailabilityAlertCrossEngage\Dependency\Facade\AvailabilityAlertCrossEngageToJellyfishAvailabilityAlertFacadeInterface $jellyfishAvailabilityAlertFacade
     */
    public function __construct(
        AvailabilityAlertCrossEngageToJellyfishAvailabilityAlertFacadeInterface $jellyfishAvailabilityAlertFacade
    ) {
        $this->jellyfishAvailabilityAlertFacade = $jellyfishAvailabilityAlertFacade;
    }

    /**
     * @param \Generated\Shared\Transfer\AvailabilityAlertSubscriberTransfer $subscriberTransfer
     *
     * @return \Generated\Shared\Transfer\AvailabilityAlertCrossEngageSubscriberRegistrationResponseTransfer
     */
    public function registerSubscriber(
        AvailabilityAlertSubscriberTransfer $subscriberTransfer
    ): AvailabilityAlertCrossEngageSubscriberRegistrationResponseTransfer {
        $response = (new AvailabilityAlertCrossEngageSubscriberRegistrationResponseTransfer())
            ->setSubscriber($subscriberTransfer)
            ->setStatus(true);

        try {
            $this->jellyfishAvailabilityAlertFacade->dispatchSubscriber($subscriberTransfer);
        } catch (Exception $exception) {
            $response->setStatus(false);
        }

        return $response;
    }
}
