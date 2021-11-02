<?php

namespace FondOfOryx\Zed\ProductLocaleRestrictionStorage\Communication\Plugin\Event\Listener;

use Spryker\Zed\Event\Dependency\Plugin\EventBulkHandlerInterface;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;
use Spryker\Zed\PropelOrm\Business\Transaction\DatabaseTransactionHandlerTrait;

/**
 * @method \FondOfOryx\Zed\ProductLocaleRestrictionStorage\ProductLocaleRestrictionStorageConfig getConfig()
 * @method \FondOfOryx\Zed\ProductLocaleRestrictionStorage\Business\ProductLocaleRestrictionStorageFacadeInterface getFacade()
 * @method \FondOfOryx\Zed\ProductLocaleRestrictionStorage\Communication\ProductLocaleRestrictionStorageCommunicationFactory getFactory()
 */
class ProductAbstractListener extends AbstractPlugin implements EventBulkHandlerInterface
{
    use DatabaseTransactionHandlerTrait;

    /**
     * {@inheritDoc}
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
        $this->preventTransaction();

        $this->getFacade()->publish(
            $this->getProductAbstractIds($transfers, $eventName),
        );
    }

    /**
     * @param array<\Generated\Shared\Transfer\EventEntityTransfer> $eventTransfers
     * @param string $eventName
     *
     * @return array<int>
     */
    protected function getProductAbstractIds(array $eventTransfers, string $eventName): array
    {
        return $this->getFactory()
            ->getEventBehaviorFacade()
            ->getEventTransferIds($eventTransfers);
    }
}
