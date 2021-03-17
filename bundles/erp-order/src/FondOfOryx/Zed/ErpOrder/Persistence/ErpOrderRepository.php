<?php

namespace FondOfOryx\Zed\ErpOrder\Persistence;

use Generated\Shared\Transfer\ErpOrderAddressTransfer;
use Generated\Shared\Transfer\ErpOrderItemCollectionTransfer;
use Generated\Shared\Transfer\ErpOrderItemTransfer;
use Generated\Shared\Transfer\ErpOrderTransfer;
use Orm\Zed\ErpOrder\Persistence\ErpOrderAddressQuery;
use Orm\Zed\ErpOrder\Persistence\ErpOrderItemQuery;
use Orm\Zed\ErpOrder\Persistence\ErpOrderQuery;
use Spryker\Zed\Kernel\Persistence\AbstractRepository;

/**
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

        if (empty($order) || empty($order->getIdErpOrder())) {
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
        $items = $query->findByIdErpOrderItem($idErpOrder);
        $itemCollectionTransfer = new ErpOrderItemCollectionTransfer();

        if (empty($items) || empty($items->getData())) {
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

        if (!is_int($address->getIdErpOrderAddress()) || empty($address)) {
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
}
