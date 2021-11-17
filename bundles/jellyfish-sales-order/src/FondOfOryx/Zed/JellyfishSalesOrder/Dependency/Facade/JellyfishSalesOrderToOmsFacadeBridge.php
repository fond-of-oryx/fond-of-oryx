<?php

namespace FondOfOryx\Zed\JellyfishSalesOrder\Dependency\Facade;

use Propel\Runtime\Collection\ObjectCollection;
use Spryker\Zed\Oms\Business\OmsFacadeInterface;

class JellyfishSalesOrderToOmsFacadeBridge implements JellyfishSalesOrderToOmsFacadeInterface
{
    /**
     * @var \Spryker\Zed\Oms\Business\OmsFacadeInterface
     */
    protected $omsFacade;

    /**
     * @param \Spryker\Zed\Oms\Business\OmsFacadeInterface $omsFacade
     */
    public function __construct(OmsFacadeInterface $omsFacade)
    {
        $this->omsFacade = $omsFacade;
    }

    /**
     * @param string $eventId
     * @param \Propel\Runtime\Collection\ObjectCollection $orderItems
     * @param array $logContext
     * @param array $data
     *
     * @return array|null
     */
    public function triggerEvent(
        string $eventId,
        ObjectCollection $orderItems,
        array $logContext,
        array $data = []
    ): ?array {
        return $this->omsFacade->triggerEvent($eventId, $orderItems, $logContext, $data);
    }
}
