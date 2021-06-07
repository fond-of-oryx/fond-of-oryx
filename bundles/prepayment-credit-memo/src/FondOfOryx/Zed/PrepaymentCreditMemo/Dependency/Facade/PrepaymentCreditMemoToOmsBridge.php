<?php

namespace FondOfOryx\Zed\PrepaymentCreditMemo\Dependency\Facade;

use Propel\Runtime\Collection\ObjectCollection;
use Spryker\Zed\Oms\Business\OmsFacadeInterface;

class PrepaymentCreditMemoToOmsBridge implements PrepaymentCreditMemoToOmsInterface
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
     * Specification:
     *  - Triggers even for given order items, data is used as additional payload which is passed to commands.
     *  - Locks state machine trigger from concurrent access
     *  - Logs state machine transitions
     *  - Executes state machine for each order item following their definitions
     *  - Calls command plugins
     *  - Calls condition plugins
     *  - Sets timeouts for timeout events
     *  - Triggers item reservation plugins
     *  - Unlocks state machine trigger
     *  - Returns data which was aggregated from state machine plugins
     *  - Returns NULL is case of an internal failure
     *
     * @api
     *
     * @param string $eventId
     * @param \Propel\Runtime\Collection\ObjectCollection $orderItems
     * @param array $logContext
     * @param array $data
     *
     * @return array|null
     */
    public function triggerEvent($eventId, ObjectCollection $orderItems, array $logContext, array $data = []): ?array
    {
        return $this->omsFacade->triggerEvent($eventId, $orderItems, $logContext, $data);
    }
}
