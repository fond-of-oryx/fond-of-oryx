<?php

namespace FondOfOryx\Zed\ErpDeliveryNotePageSearch\Dependency\Facade;

use Spryker\Zed\EventBehavior\Business\EventBehaviorFacadeInterface;

class ErpDeliveryNotePageSearchToEventBehaviorFacadeBridge implements ErpDeliveryNotePageSearchToEventBehaviorFacadeInterface
{
    /**
     * @var \Spryker\Zed\EventBehavior\Business\EventBehaviorFacadeInterface
     */
    protected $facade;

    /**
     * @param \Spryker\Zed\EventBehavior\Business\EventBehaviorFacadeInterface $facade
     */
    public function __construct(EventBehaviorFacadeInterface $facade)
    {
        $this->facade = $facade;
    }

    /**
     * @param array<\Generated\Shared\Transfer\EventEntityTransfer> $eventTransfers
     *
     * @return array
     */
    public function getEventTransferIds(array $eventTransfers): array
    {
        return $this->facade->getEventTransferIds($eventTransfers);
    }
}
