<?php

namespace FondOfOryx\Zed\ErpOrderPageSearch\Communication\Plugin\Event\Listener;

use FondOfOryx\Zed\ErpOrder\Dependency\ErpOrderEvents;
use Spryker\Zed\Event\Dependency\Plugin\EventBulkHandlerInterface;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;
use Spryker\Zed\PropelOrm\Business\Transaction\DatabaseTransactionHandlerTrait;

/**
 * @method \FondOfOryx\Zed\ErpOrderPageSearch\Business\ErpOrderPageSearchFacadeInterface getFacade()
 * @method \FondOfOryx\Zed\ErpOrderPageSearch\Communication\ErpOrderPageSearchCommunicationFactory getFactory()
 * @method \FondOfOryx\Zed\ErpOrderPageSearch\ErpOrderPageSearchConfig getConfig()
 * @method \FondOfOryx\Zed\ErpOrderPageSearch\Persistence\ErpOrderPageSearchQueryContainerInterface getQueryContainer()
 */
class ErpOrderPageSearchListener extends AbstractPlugin implements EventBulkHandlerInterface
{
    use DatabaseTransactionHandlerTrait;

    /**
     * Specification
     *  - Listeners needs to implement this interface to execute the codes for more
     *  than one event at same time (Bulk Operation)
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\EventEntityTransfer[] $transfers
     * @param string $eventName
     *
     * @return void
     */
    public function handleBulk(array $transfers, $eventName): void
    {
        $erpOrderIds = $this->getFactory()
            ->getEventBehaviorFacade()
            ->getEventTransferIds($transfers);

        if (
            $eventName === ErpOrderEvents::ENTITY_FOO_ERP_ORDER_DELETE ||
            $eventName === ErpOrderEvents::ERP_ORDER_UNPUBLISH
        ) {
            $this->getFacade()->unpublish($erpOrderIds);

            return;
        }

        $this->getFacade()->publish($erpOrderIds);
    }
}
