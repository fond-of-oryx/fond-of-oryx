<?php

namespace FondOfOryx\Zed\JellyfishBuffer\Persistence;

use Generated\Shared\Transfer\ExportedOrderHistoryTransfer;
use Generated\Shared\Transfer\JellyfishOrderTransfer;
use Orm\Zed\JellyfishBuffer\Persistence\FooExportedOrderHistory;
use Spryker\Zed\Kernel\Persistence\AbstractEntityManager;

/**
 * @method \FondOfOryx\Zed\JellyfishBuffer\Persistence\JellyfishBufferPersistenceFactory getFactory()
 */
class JellyfishBufferEntityManager extends AbstractEntityManager implements JellyfishBufferEntityManagerInterface
{
    /**
     * @param \Generated\Shared\Transfer\JellyfishOrderTransfer $jellyfishOrderTransfer
     * @param array $options
     *
     * @return void
     */
    public function createExportedOrder(JellyfishOrderTransfer $jellyfishOrderTransfer, array $options): void
    {
        $jellyfishOrderTransfer->requireId()
            ->requireReference();

        $fooExportedOrder = $this->getFactory()
            ->createJellyfishBufferMapper()
            ->mapTransferAndOptionsToEntity(
                $jellyfishOrderTransfer,
                $options,
                $this->getFactory()->createExportedOrderQuery()->filterByFkSalesOrder($jellyfishOrderTransfer->getId())->findOneOrCreate(),
            );

        $fooExportedOrder->save();
    }

    /**
     * @param int $fkSalesOrder
     *
     * @return void
     */
    public function flagAsReexported(int $fkSalesOrder): void
    {
        $entity = $this->getFactory()->createExportedOrderQuery()->filterByFkSalesOrder($fkSalesOrder)->findOneOrCreate();
        $entity->setIsReexported(true)->setUpdatedAt(time())->save();
    }

    /**
     * @param \Generated\Shared\Transfer\ExportedOrderHistoryTransfer $exportedOrderHistoryTransfer
     *
     * @return void
     */
    public function createHistoryEntry(ExportedOrderHistoryTransfer $exportedOrderHistoryTransfer): void
    {
        $exportedOrderHistoryTransfer->requireFkExportedOrder()->requireFkUser()->requireData();

        $fooExportedOrderHistory = new FooExportedOrderHistory();
        $fooExportedOrderHistory->fromArray($exportedOrderHistoryTransfer->toArray());
        $fooExportedOrderHistory->save();
    }
}
