<?php

namespace FondOfOryx\Zed\ErpOrder\Persistence;

use Generated\Shared\Transfer\ErpOrderAddressTransfer;
use Generated\Shared\Transfer\ErpOrderItemCollectionTransfer;
use Generated\Shared\Transfer\ErpOrderItemTransfer;
use Generated\Shared\Transfer\ErpOrderTotalsTransfer;
use Generated\Shared\Transfer\ErpOrderTotalTransfer;
use Generated\Shared\Transfer\ErpOrderTransfer;
use Orm\Zed\ErpOrder\Persistence\ErpOrderAddressQuery;
use Orm\Zed\ErpOrder\Persistence\ErpOrderItemQuery;
use Orm\Zed\ErpOrder\Persistence\ErpOrderQuery;
use Orm\Zed\ErpOrder\Persistence\OldErpOrderTotalQuery;
use Spryker\Zed\Kernel\Persistence\AbstractRepository;

/**
 * @codeCoverageIgnore
 *
 * @method \FondOfOryx\Zed\ErpOrder\Persistence\ErpOrderPersistenceFactory getFactory()
 */
class ErpOrderRepository extends AbstractRepository implements ErpOrderRepositoryInterface
{
    /**
     * @param int $idErpOrder
     *
     * @return \Generated\Shared\Transfer\ErpOrderTransfer|null
     */
    public function findErpOrderByIdErpOrder(int $idErpOrder): ?ErpOrderTransfer
    {
        $query = $this->getErpOrderQuery();
        $order = $query->findOneByIdErpOrder($idErpOrder);

        if ($order === null) {
            return null;
        }

        return $this->getFactory()->createEntityToTransferMapper()->fromErpOrderToTransfer($order);
    }

    /**
     * @param int $idErpOrder
     *
     * @return \Generated\Shared\Transfer\ErpOrderItemCollectionTransfer
     */
    public function findErpOrderItemsByIdErpOrder(int $idErpOrder): ErpOrderItemCollectionTransfer
    {
        $query = $this->getErpOrderItemQuery();
        $items = $query->findByFkErpOrder($idErpOrder);
        $itemCollectionTransfer = new ErpOrderItemCollectionTransfer();

        if (empty($items->getData())) {
            return $itemCollectionTransfer;
        }

        foreach ($items->getData() as $item) {
            $itemCollectionTransfer->addItem($this->getFactory()->createEntityToTransferMapper()->fromEprOrderItemToTransfer($item));
        }

        return $itemCollectionTransfer;
    }

    /**
     * @param int $idErpOrderItem
     *
     * @return \Generated\Shared\Transfer\ErpOrderItemTransfer|null
     */
    public function findErpOrderItemByIdErpOrderItem(int $idErpOrderItem): ?ErpOrderItemTransfer
    {
        $query = $this->getErpOrderItemQuery();
        $item = $query->findOneByIdErpOrderItem($idErpOrderItem);

        if ($item === null) {
            return null;
        }

        return $this->getFactory()->createEntityToTransferMapper()->fromEprOrderItemToTransfer($item);
    }

    /**
     * @param int $idErpOrderAddress
     *
     * @return \Generated\Shared\Transfer\ErpOrderAddressTransfer|null
     */
    public function findErpOrderAddressByIdErpOrderAddress(int $idErpOrderAddress): ?ErpOrderAddressTransfer
    {
        $query = $this->getErpOrderAddressQuery();
        $address = $query->findOneByIdErpOrderAddress($idErpOrderAddress);

        if ($address === null) {
            return null;
        }

        return $this->getFactory()->createEntityToTransferMapper()->fromErpOrderAddressToTransfer($address);
    }

    /**
     * @param int $idErpOrderTotal
     *
     * @return \Generated\Shared\Transfer\ErpOrderTotalTransfer|null
     */
    public function findErpOrderTotalByIdErpOrderTotal(int $idErpOrderTotal): ?ErpOrderTotalTransfer
    {
        $query = $this->getOldErpOrderTotalQuery();
        $total = $query->findOneByIdErpOrderTotal($idErpOrderTotal);

        if ($total === null) {
            return null;
        }

        return $this->getFactory()->createEntityToTransferMapper()->fromOldErpOrderTotalToTransfer($total);
    }

    /**
     * @param int $idErpOrder
     *
     * @return \Generated\Shared\Transfer\ErpOrderTotalTransfer|null
     */
    public function findErpOrderTotalByIdErpOrder(int $idErpOrder): ?ErpOrderTotalTransfer
    {
        $query = $this->getOldErpOrderTotalQuery();
        $total = $query->findOneByFkErpOrder($idErpOrder);

        if ($total === null) {
            return null;
        }

        return $this->getFactory()->createEntityToTransferMapper()->fromOldErpOrderTotalToTransfer($total);
    }

    /**
     * @return \Orm\Zed\ErpOrder\Persistence\ErpOrderQuery
     */
    protected function getErpOrderQuery(): ErpOrderQuery
    {
        return $this->getFactory()->createErpOrderQuery();
    }

    /**
     * @return \Orm\Zed\ErpOrder\Persistence\ErpOrderItemQuery
     */
    protected function getErpOrderItemQuery(): ErpOrderItemQuery
    {
        return $this->getFactory()->createErpOrderItemQuery();
    }

    /**
     * @return \Orm\Zed\ErpOrder\Persistence\ErpOrderAddressQuery
     */
    protected function getErpOrderAddressQuery(): ErpOrderAddressQuery
    {
        return $this->getFactory()->createErpOrderAddressQuery();
    }

    /**
     * @return \Orm\Zed\ErpOrder\Persistence\OldErpOrderTotalQuery
     */
    protected function getOldErpOrderTotalQuery(): OldErpOrderTotalQuery
    {
        return $this->getFactory()->createOldErpOrderTotalQuery();
    }

    /**
     * @param int $idErpOrderTotals
     *
     * @return \Generated\Shared\Transfer\ErpOrderTotalsTransfer|null
     */
    public function findErpOrderTotalsByIdErpOrderTotals(int $idErpOrderTotals): ?ErpOrderTotalsTransfer
    {
        $query = $this->getFactory()->createErpOrderTotalsQuery();
        $erpOrderTotals = $query->findOneByIdErpOrderTotals($idErpOrderTotals);

        if ($erpOrderTotals === null) {
            return null;
        }

        return $this->getFactory()->createEntityToTransferMapper()->fromErpOrderTotalsToTransfer($erpOrderTotals);
    }
}
