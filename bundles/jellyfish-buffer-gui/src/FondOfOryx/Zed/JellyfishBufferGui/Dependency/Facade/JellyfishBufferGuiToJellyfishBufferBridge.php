<?php

namespace FondOfOryx\Zed\JellyfishBufferGui\Dependency\Facade;

use FondOfOryx\Zed\JellyfishBuffer\Business\JellyfishBufferFacadeInterface;
use Generated\Shared\Transfer\ExportedOrderCollectionTransfer;
use Generated\Shared\Transfer\ExportedOrderConfigTransfer;
use Generated\Shared\Transfer\ExportedOrderHistoryCollectionTransfer;
use Generated\Shared\Transfer\ExportedOrderTransfer;

class JellyfishBufferGuiToJellyfishBufferBridge implements JellyfishBufferGuiToJellyfishBufferInterface
{
    /**
     * @var \FondOfOryx\Zed\JellyfishBuffer\Business\JellyfishBufferFacadeInterface
     */
    protected $facade;

    /**
     * @param \FondOfOryx\Zed\JellyfishBuffer\Business\JellyfishBufferFacadeInterface $jellyfishBufferFacade
     */
    public function __construct(JellyfishBufferFacadeInterface $jellyfishBufferFacade)
    {
        $this->facade = $jellyfishBufferFacade;
    }

    /**
     * @param int $idExportedOrder
     *
     * @return \Generated\Shared\Transfer\ExportedOrderTransfer
     */
    public function getExportedOrderById(int $idExportedOrder): ExportedOrderTransfer
    {
        return $this->facade->getExportedOrderById($idExportedOrder);
    }

    /**
     * @param int $fkSalesOrder
     *
     * @return \Generated\Shared\Transfer\ExportedOrderCollectionTransfer
     */
    public function findExportedOrdersByFkSalesOrder(int $fkSalesOrder): ExportedOrderCollectionTransfer
    {
        return $this->facade->findExportedOrdersByFkSalesOrder($fkSalesOrder);
    }

    /**
     * @param int $idExportedOrder
     *
     * @return \Generated\Shared\Transfer\ExportedOrderHistoryCollectionTransfer
     */
    public function findHistoryEntriesByIdExportedOrder(int $idExportedOrder): ExportedOrderHistoryCollectionTransfer
    {
        return $this->facade->findHistoryEntriesByIdExportedOrder($idExportedOrder);
    }

    /**
     * @param \Generated\Shared\Transfer\ExportedOrderTransfer $exportedOrderTransfer
     * @param \Generated\Shared\Transfer\ExportedOrderConfigTransfer $configTransfer
     *
     * @return bool
     */
    public function export(ExportedOrderTransfer $exportedOrderTransfer, ExportedOrderConfigTransfer $configTransfer): bool
    {
        return $this->facade->export($exportedOrderTransfer, $configTransfer);
    }
}
