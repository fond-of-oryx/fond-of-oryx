<?php

namespace FondOfOryx\Zed\ErporderPageSearch\Dependency\Service;

use Spryker\Zed\EventBehavior\Business\EventBehaviorFacadeInterface;

class ErpOrderPageSearchToEventBehaviorFacadeBridge implements ErpOrderPageSearchToEventBehaviorFacadeInterface
{
    /**
     * @var \Spryker\Zed\EventBehavior\Business\EventBehaviorFacadeInterface
     */
    protected $facade;

    /**
     * ErpOrderPageSearchToEventBehaviorFacadeBridge constructor.
     *
     * @param  \Spryker\Zed\EventBehavior\Business\EventBehaviorFacadeInterface  $facade
     */
    public function __construct(EventBehaviorFacadeInterface $facade)
    {
        $this->facade = $facade;
    }

    /**
     * @param \Generated\Shared\Transfer\EventEntityTransfer[] $eventTransfers
     *
     * @return array
     */
    public function getEventTransferIds(array $eventTransfers): array
    {
        return $this->facade->getEventTransferIds($eventTransfers);
    }
}
