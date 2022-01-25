<?php

namespace FondOfOryx\Zed\JellyfishBuffer\Business;

use Generated\Shared\Transfer\ExportedOrderCollectionTransfer;
use Generated\Shared\Transfer\ExportedOrderConfigTransfer;
use Generated\Shared\Transfer\ExportedOrderHistoryCollectionTransfer;
use Generated\Shared\Transfer\ExportedOrderTransfer;
use Generated\Shared\Transfer\JellyfishOrderTransfer;
use Spryker\Zed\Kernel\Business\AbstractFacade;

/**
 * @method \FondOfOryx\Zed\JellyfishBuffer\Business\JellyfishBufferBusinessFactory getFactory()
 * @method \FondOfOryx\Zed\JellyfishBuffer\Persistence\JellyfishBufferEntityManagerInterface getEntityManager()
 * @method \FondOfOryx\Zed\JellyfishBuffer\Persistence\JellyfishBufferRepositoryInterface getRepository()
 */
class JellyfishBufferFacade extends AbstractFacade implements JellyfishBufferFacadeInterface
{
    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\JellyfishOrderTransfer $jellyfishOrderTransfer
     * @param array $options
     *
     * @return void
     */
    public function bufferOrder(
        JellyfishOrderTransfer $jellyfishOrderTransfer,
        array $options
    ): void {
        $this->getFactory()
            ->createJellyfishBufferOrder()
            ->buffer(
                $jellyfishOrderTransfer,
                $options,
            );
    }

    /**
     * @param \Generated\Shared\Transfer\ExportedOrderConfigTransfer $configTransfer
     *
     * @return bool
     */
    public function exportFromBufferTable(ExportedOrderConfigTransfer $configTransfer): bool
    {
        return $this->getFactory()->createOrderExport()->exportByFilter($configTransfer);
    }

    /**
     * @param \Generated\Shared\Transfer\ExportedOrderTransfer $exportedOrderTransfer
     * @param \Generated\Shared\Transfer\ExportedOrderConfigTransfer $configTransfer
     *
     * @return bool
     */
    public function export(ExportedOrderTransfer $exportedOrderTransfer, ExportedOrderConfigTransfer $configTransfer): bool
    {
        return $this->getFactory()->createOrderExport()->export($exportedOrderTransfer, $configTransfer);
    }

    /**
     * @param int $idExportedOrder
     *
     * @return \Generated\Shared\Transfer\ExportedOrderTransfer
     */
    public function getExportedOrderById(int $idExportedOrder): ExportedOrderTransfer
    {
        return $this->getRepository()->getExportedOrderById($idExportedOrder);
    }

    /**
     * @param int $fkSalesOrder
     *
     * @return \Generated\Shared\Transfer\ExportedOrderCollectionTransfer
     */
    public function findExportedOrdersByFkSalesOrder(int $fkSalesOrder): ExportedOrderCollectionTransfer
    {
        return $this->getRepository()->findExportedOrdersByFkSalesOrder($fkSalesOrder);
    }

    /**
     * @param int $idExportedOrder
     *
     * @return \Generated\Shared\Transfer\ExportedOrderHistoryCollectionTransfer
     */
    public function findHistoryEntriesByIdExportedOrder(int $idExportedOrder): ExportedOrderHistoryCollectionTransfer
    {
        return $this->getRepository()->findHistoryEntriesByIdExportedOrder($idExportedOrder);
    }
}
