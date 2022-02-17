<?php

namespace FondOfOryx\Zed\ErpDeliveryNotePageSearch\Communication\Plugin\Event\Listener;

use FondOfOryx\Zed\ErpDeliveryNote\Dependency\ErpDeliveryNoteEvents;
use Spryker\Zed\Event\Dependency\Plugin\EventBulkHandlerInterface;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;
use Spryker\Zed\PropelOrm\Business\Transaction\DatabaseTransactionHandlerTrait;

/**
 * @method \FondOfOryx\Zed\ErpDeliveryNotePageSearch\Business\ErpDeliveryNotePageSearchFacadeInterface getFacade()
 * @method \FondOfOryx\Zed\ErpDeliveryNotePageSearch\Communication\ErpDeliveryNotePageSearchCommunicationFactory getFactory()
 * @method \FondOfOryx\Zed\ErpDeliveryNotePageSearch\ErpDeliveryNotePageSearchConfig getConfig()
 * @method \FondOfOryx\Zed\ErpDeliveryNotePageSearch\Persistence\ErpDeliveryNotePageSearchQueryContainerInterface getQueryContainer()
 */
class ErpDeliveryNotePageSearchListener extends AbstractPlugin implements EventBulkHandlerInterface
{
    use DatabaseTransactionHandlerTrait;

    /**
     * Specification
     *  - Listeners needs to implement this interface to execute the codes for more
     *  than one event at same time (Bulk Operation)
     *
     * @api
     *
     * @param array<\Generated\Shared\Transfer\EventEntityTransfer> $transfers
     * @param string $eventName
     *
     * @return void
     */
    public function handleBulk(array $transfers, $eventName): void
    {
        $erpDeliveryNoteIds = $this->getFactory()
            ->getEventBehaviorFacade()
            ->getEventTransferIds($transfers);

        if (
            $eventName === ErpDeliveryNoteEvents::ENTITY_FOO_ERP_DELIVERY_NOTE_DELETE ||
            $eventName === ErpDeliveryNoteEvents::ERP_DELIVERY_NOTE_UNPUBLISH
        ) {
            $this->getFacade()->unpublish($erpDeliveryNoteIds);

            return;
        }

        $this->getFacade()->publish($erpDeliveryNoteIds);
    }
}
