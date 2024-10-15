<?php

namespace FondOfOryx\Zed\ErpOrder\Persistence;

use Generated\Shared\Transfer\ErpOrderAddressTransfer;
use Generated\Shared\Transfer\ErpOrderAmountTransfer;
use Generated\Shared\Transfer\ErpOrderExpenseCollectionTransfer;
use Generated\Shared\Transfer\ErpOrderExpenseTransfer;
use Generated\Shared\Transfer\ErpOrderItemCollectionTransfer;
use Generated\Shared\Transfer\ErpOrderItemTransfer;
use Generated\Shared\Transfer\ErpOrderTotalsTransfer;
use Generated\Shared\Transfer\ErpOrderTransfer;
use Orm\Zed\ErpOrder\Persistence\ErpOrderAddressQuery;
use Orm\Zed\ErpOrder\Persistence\ErpOrderItemQuery;
use Orm\Zed\ErpOrder\Persistence\ErpOrderQuery;
use Orm\Zed\ErpOrder\Persistence\FooErpOrderAmountQuery;
use Orm\Zed\ErpOrder\Persistence\FooErpOrderExpenseQuery;
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
     * @param string $externalReference
     *
     * @return \Generated\Shared\Transfer\ErpOrderTransfer|null
     */
    public function findErpOrderByExternalReference(string $externalReference): ?ErpOrderTransfer
    {
        $query = $this->getErpOrderQuery();
        $order = $query->findOneByExternalReference($externalReference);

        if ($order === null) {
            return null;
        }

        return $this->getFactory()->createEntityToTransferMapper()->fromErpOrderToTransfer($order);
    }

    /**
     * @param string $reference
     *
     * @return \Generated\Shared\Transfer\ErpOrderTransfer|null
     */
    public function findErpOrderByReference(string $reference): ?ErpOrderTransfer
    {
        $query = $this->getErpOrderQuery();
        $order = $query->findOneByReference($reference);

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

    /**
     * @param int $idErpOrder
     *
     * @return \Generated\Shared\Transfer\ErpOrderExpenseCollectionTransfer
     */
    public function findErpOrderExpensesByIdErpOrder(int $idErpOrder): ErpOrderExpenseCollectionTransfer
    {
        $query = $this->getErpOrderExpenseQuery();
        $items = $query->findByFkErpOrder($idErpOrder);
        $itemCollectionTransfer = new ErpOrderExpenseCollectionTransfer();

        if (empty($items->getData())) {
            return $itemCollectionTransfer;
        }

        foreach ($items->getData() as $item) {
            $itemCollectionTransfer->addExpense($this->getFactory()->createEntityToTransferMapper()->fromEprOrderExpenseToTransfer($item));
        }

        return $itemCollectionTransfer;
    }

    /**
     * @param int $idErpOrderExpense
     *
     * @return \Generated\Shared\Transfer\ErpOrderExpenseTransfer|null
     */
    public function findErpOrderExpenseByIdErpOrderExpense(int $idErpOrderExpense): ?ErpOrderExpenseTransfer
    {
        $query = $this->getErpOrderExpenseQuery();
        $item = $query->findOneByIdErpOrderExpense($idErpOrderExpense);

        if ($item === null) {
            return null;
        }

        return $this->getFactory()->createEntityToTransferMapper()->fromEprOrderExpenseToTransfer($item);
    }

    /**
     * @param int $idErpOrderAmount
     *
     * @return \Generated\Shared\Transfer\ErpOrderAmountTransfer|null
     */
    public function findErpOrderAmountByIdErpOrderAmount(int $idErpOrderAmount): ?ErpOrderAmountTransfer
    {
        $query = $this->getErpOrderAmountQuery();
        $total = $query->findOneByIdErpOrderAmount($idErpOrderAmount);

        if ($total === null) {
            return null;
        }

        return $this->getFactory()->createEntityToTransferMapper()->fromErpOrderAmountToTransfer($total);
    }

    /**
     * @return \Orm\Zed\ErpOrder\Persistence\FooErpOrderExpenseQuery
     */
    protected function getErpOrderExpenseQuery(): FooErpOrderExpenseQuery
    {
        return $this->getFactory()->createErpOrderExpenseQuery();
    }

    /**
     * @return \Orm\Zed\ErpOrder\Persistence\FooErpOrderAmountQuery
     */
    protected function getErpOrderAmountQuery(): FooErpOrderAmountQuery
    {
        return $this->getFactory()->createErpOrderAmountQuery();
    }
}
