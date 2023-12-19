<?php

namespace FondOfOryx\Zed\ErpOrderPageSearch\Communication\Plugin\PublisherExtension;

use FondOfOryx\Zed\ErpOrder\Dependency\ErpOrderEvents;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;
use Spryker\Zed\PublisherExtension\Dependency\Plugin\PublisherPluginInterface;

/**
 * @method \FondOfOryx\Zed\ErpOrderPageSearch\Communication\ErpOrderPageSearchCommunicationFactory getFactory()
 * @method \FondOfOryx\Zed\ErpOrderPageSearch\Business\ErpOrderPageSearchFacadeInterface getFacade()
 */
class ErpOrderWritePublisherPlugin extends AbstractPlugin implements PublisherPluginInterface
{
    /**
     * @param array<\Generated\Shared\Transfer\EventEntityTransfer> $eventEntityTransfers
     * @param string $eventName
     *
     * @return void
     */
    public function handleBulk(array $eventEntityTransfers, $eventName): void
    {
        $erpOrderIds = $this->getFactory()->getEventBehaviorFacade()->getEventTransferIds($eventEntityTransfers);

        if (count($erpOrderIds) === 0) {
            return;
        }

        $this->getFacade()->publish($erpOrderIds);
    }

    /**
     * @return array<string>
     */
    public function getSubscribedEvents(): array
    {
        return [
            ErpOrderEvents::ENTITY_FOO_ERP_ORDER_CREATE,
            ErpOrderEvents::ENTITY_FOO_ERP_ORDER_UPDATE,
            ErpOrderEvents::ERP_ORDER_PUBLISH,
        ];
    }
}
