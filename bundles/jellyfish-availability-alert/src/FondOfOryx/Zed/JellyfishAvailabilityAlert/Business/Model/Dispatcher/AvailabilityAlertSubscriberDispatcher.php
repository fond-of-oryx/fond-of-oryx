<?php

namespace FondOfOryx\Zed\JellyfishAvailabilityAlert\Business\Model\Dispatcher;

use Exception;
use FondOfOryx\Zed\JellyfishAvailabilityAlert\Business\Api\Adapter\AvailabilityAlertAdapterInterface;
use Generated\Shared\Transfer\AvailabilityAlertDataWrapperTransfer;
use Generated\Shared\Transfer\AvailabilityAlertSubscriberTransfer;
use Spryker\Shared\Log\LoggerTrait;

class AvailabilityAlertSubscriberDispatcher implements AvailabilityAlertSubscriberDispatcherInterface
{
    use LoggerTrait;

    /**
     * @var \FondOfOryx\Zed\JellyfishAvailabilityAlert\Business\Api\Adapter\AvailabilityAlertAdapterInterface
     */
    protected $adapter;

    /**
     * @param \FondOfOryx\Zed\JellyfishAvailabilityAlert\Business\Api\Adapter\AvailabilityAlertAdapterInterface $adapter
     */
    public function __construct(AvailabilityAlertAdapterInterface $adapter)
    {
        $this->adapter = $adapter;
    }

    /**
     * @param \Generated\Shared\Transfer\AvailabilityAlertSubscriberTransfer $availabilityAlertSubscriberTransfer
     *
     * @throws \Exception
     *
     * @return void
     */
    public function dispatch(AvailabilityAlertSubscriberTransfer $availabilityAlertSubscriberTransfer): void
    {
        try {
            $this->adapter->sendRequest((new AvailabilityAlertDataWrapperTransfer())->setSubscriber($availabilityAlertSubscriberTransfer));
        } catch (Exception $exception) {
            $this->getLogger()->error(
                sprintf(
                    'AvailabilityAlertSubscriber with id "%s" could not be dispatched to JellyFish! Message: %s',
                    $availabilityAlertSubscriberTransfer->getIdAvailabilityAlertSubscriber(),
                    $exception->getMessage()
                ),
                $exception->getTrace()
            );

            throw $exception;
        }
    }
}
