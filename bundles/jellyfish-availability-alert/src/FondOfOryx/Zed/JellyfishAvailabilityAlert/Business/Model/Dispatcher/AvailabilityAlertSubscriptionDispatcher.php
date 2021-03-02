<?php

namespace FondOfOryx\Zed\JellyfishAvailabilityAlert\Business\Model\Dispatcher;

use Exception;
use FondOfOryx\Zed\JellyfishAvailabilityAlert\Business\Api\Adapter\AvailabilityAlertAdapterInterface;
use Generated\Shared\Transfer\AvailabilityAlertSubscriptionTransfer;
use Spryker\Shared\Log\LoggerTrait;

class AvailabilityAlertSubscriptionDispatcher implements AvailabilityAlertSubscriptionDispatcherInterface
{
    use LoggerTrait;

    /**
     * @var \FondOfOryx\Zed\JellyfishAvailabilityAlert\Business\Api\Adapter\AvailabilityAlertAdapterInterface
     */
    protected $adapter;

    /**
     * AvailabilityAlertSubscriptionDispatcher constructor.
     *
     * @param  \FondOfOryx\Zed\JellyfishAvailabilityAlert\Business\Api\Adapter\AvailabilityAlertAdapterInterface  $adapter
     */
    public function __construct(
        AvailabilityAlertAdapterInterface $adapter
    ) {
        $this->adapter = $adapter;
    }

    /**
     * @param  \Generated\Shared\Transfer\AvailabilityAlertSubscriptionTransfer  $availabilityAlertSubscriptionTransfer
     *
     * @return void
     */
    public function dispatch(AvailabilityAlertSubscriptionTransfer $availabilityAlertSubscriptionTransfer): void
    {
        try {
            $this->adapter->sendRequest($availabilityAlertSubscriptionTransfer);
        } catch (Exception $exception) {
            $this->getLogger()->error(
                sprintf(
                    'AvailabilityAlert with id "%s" could not be dispatched to JellyFish! Message: %s',
                    $availabilityAlertSubscriptionTransfer->getIdAvailabilityAlertSubscription(),
                    $exception->getMessage()
                ),
                $exception->getTrace()
            );

            throw $exception;
        }
    }
}
