<?php

namespace FondOfOryx\Zed\ErpInvoicePageSearch\Communication\Plugin\PublisherExtension;

use FondOfOryx\Zed\ErpInvoice\Dependency\ErpInvoiceEvents;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;
use Spryker\Zed\PublisherExtension\Dependency\Plugin\PublisherPluginInterface;

/**
 * @method \FondOfOryx\Zed\ErpInvoicePageSearch\Communication\ErpInvoicePageSearchCommunicationFactory getFactory()
 * @method \FondOfOryx\Zed\ErpInvoicePageSearch\Business\ErpInvoicePageSearchFacadeInterface getFacade()
 */
class ErpInvoiceWritePublisherPlugin extends AbstractPlugin implements PublisherPluginInterface
{
    /**
     * @param array<\Generated\Shared\Transfer\EventEntityTransfer> $eventEntityTransfers
     * @param string $eventName
     *
     * @return void
     */
    public function handleBulk(array $eventEntityTransfers, $eventName): void
    {
        $erpInvoiceIds = $this->getFactory()->getEventBehaviorFacade()->getEventTransferIds($eventEntityTransfers);

        if (count($erpInvoiceIds) === 0) {
            return;
        }

        $this->getFacade()->publish($erpInvoiceIds);
    }

    /**
     * @return array<string>
     */
    public function getSubscribedEvents(): array
    {
        return [
            ErpInvoiceEvents::ENTITY_FOO_ERP_INVOICE_CREATE,
            ErpInvoiceEvents::ENTITY_FOO_ERP_INVOICE_UPDATE,
            ErpInvoiceEvents::ERP_INVOICE_PUBLISH,
        ];
    }
}
