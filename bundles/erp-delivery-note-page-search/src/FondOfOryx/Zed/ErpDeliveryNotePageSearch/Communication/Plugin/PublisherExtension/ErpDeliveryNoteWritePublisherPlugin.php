<?php

namespace FondOfOryx\Zed\ErpDeliveryNotePageSearch\Communication\Plugin\PublisherExtension;

use FondOfOryx\Zed\ErpDeliveryNote\Dependency\ErpDeliveryNoteEvents;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;
use Spryker\Zed\PublisherExtension\Dependency\Plugin\PublisherPluginInterface;

/**
 * @method \FondOfOryx\Zed\ErpDeliveryNotePageSearch\Communication\ErpDeliveryNotePageSearchCommunicationFactory getFactory()
 * @method \FondOfOryx\Zed\ErpDeliveryNotePageSearch\Business\ErpDeliveryNotePageSearchFacadeInterface getFacade()
 */
class ErpDeliveryNoteWritePublisherPlugin extends AbstractPlugin implements PublisherPluginInterface
{
    /**
     * @param array<\Generated\Shared\Transfer\EventEntityTransfer> $eventEntityTransfers
     * @param string $eventName
     *
     * @return void
     */
    public function handleBulk(array $eventEntityTransfers, $eventName): void
    {
        $erpDeliveryNoteIds = $this->getFactory()->getEventBehaviorFacade()->getEventTransferIds($eventEntityTransfers);

        if (count($erpDeliveryNoteIds) === 0) {
            return;
        }

        $this->getFacade()->publish($erpDeliveryNoteIds);
    }

    /**
     * @return array<string>
     */
    public function getSubscribedEvents(): array
    {
        return [
            ErpDeliveryNoteEvents::ENTITY_FOO_ERP_DELIVERY_NOTE_CREATE,
            ErpDeliveryNoteEvents::ENTITY_FOO_ERP_DELIVERY_NOTE_UPDATE,
            ErpDeliveryNoteEvents::ERP_DELIVERY_NOTE_PUBLISH,
        ];
    }
}
