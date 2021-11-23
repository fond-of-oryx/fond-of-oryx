<?php

namespace FondOfOryx\Zed\ErpInvoicePageSearch\Communication\Plugin\Event\Listener;

use FondOfOryx\Zed\ErpInvoice\Dependency\ErpInvoiceEvents;
use Spryker\Zed\Event\Dependency\Plugin\EventBulkHandlerInterface;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;
use Spryker\Zed\PropelOrm\Business\Transaction\DatabaseTransactionHandlerTrait;

/**
 * @method \FondOfOryx\Zed\ErpInvoicePageSearch\Business\ErpInvoicePageSearchFacadeInterface getFacade()
 * @method \FondOfOryx\Zed\ErpInvoicePageSearch\Communication\ErpInvoicePageSearchCommunicationFactory getFactory()
 * @method \FondOfOryx\Zed\ErpInvoicePageSearch\ErpInvoicePageSearchConfig getConfig()
 * @method \FondOfOryx\Zed\ErpInvoicePageSearch\Persistence\ErpInvoicePageSearchQueryContainerInterface getQueryContainer()
 */
class ErpInvoicePageSearchListener extends AbstractPlugin implements EventBulkHandlerInterface
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
        $erpInvoiceIds = $this->getFactory()
            ->getEventBehaviorFacade()
            ->getEventTransferIds($transfers);

        if (
            $eventName === ErpInvoiceEvents::ENTITY_FOO_ERP_INVOICE_DELETE ||
            $eventName === ErpInvoiceEvents::ERP_INVOICE_UNPUBLISH
        ) {
            $this->getFacade()->unpublish($erpInvoiceIds);

            return;
        }

        $this->getFacade()->publish($erpInvoiceIds);
    }
}
