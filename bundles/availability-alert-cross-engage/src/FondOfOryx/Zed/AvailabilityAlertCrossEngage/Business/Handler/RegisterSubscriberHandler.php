<?php

namespace FondOfOryx\Zed\AvailabilityAlertCrossEngage\Business\Handler;

use Exception;
use FondOfOryx\Zed\AvailabilityAlertCrossEngage\Dependency\Facade\AvailabilityAlertCrossEngageToJellyfishAvailabilityAlertFacadeInterface;
use Generated\Shared\Transfer\AvailabilityAlertCrossEngageSubscriberRegistrationResponseTransfer;
use Generated\Shared\Transfer\AvailabilityAlertSubscriberTransfer;
use Psr\Log\LoggerInterface;

class RegisterSubscriberHandler implements RegisterSubscriberHandlerInterface
{
    /**
     * @var \FondOfOryx\Zed\AvailabilityAlertCrossEngage\Dependency\Facade\AvailabilityAlertCrossEngageToJellyfishAvailabilityAlertFacadeInterface
     */
    protected $jellyfishAvailabilityAlertFacade;

    /**
     * @var \Psr\Log\LoggerInterface
     */
    protected $logger;

    /**
     * @param \FondOfOryx\Zed\AvailabilityAlertCrossEngage\Dependency\Facade\AvailabilityAlertCrossEngageToJellyfishAvailabilityAlertFacadeInterface $jellyfishAvailabilityAlertFacade
     * @param \Psr\Log\LoggerInterface $logger
     */
    public function __construct(
        AvailabilityAlertCrossEngageToJellyfishAvailabilityAlertFacadeInterface $jellyfishAvailabilityAlertFacade,
        LoggerInterface $logger
    ) {
        $this->jellyfishAvailabilityAlertFacade = $jellyfishAvailabilityAlertFacade;
        $this->logger = $logger;
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
            $this->logger->error(sprintf('Could not register subscriber in cross engage. Message: %s', $exception->getMessage()));
            $response->setStatus(false);
        }

        return $response;
    }
}
