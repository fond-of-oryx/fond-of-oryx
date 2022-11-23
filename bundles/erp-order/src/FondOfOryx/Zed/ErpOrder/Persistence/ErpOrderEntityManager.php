<?php

namespace FondOfOryx\Zed\ErpOrder\Persistence;

use DateTime;
use Exception;
use Generated\Shared\Transfer\ErpOrderAddressTransfer;
use Generated\Shared\Transfer\ErpOrderItemTransfer;
use Generated\Shared\Transfer\ErpOrderTotalsTransfer;
use Generated\Shared\Transfer\ErpOrderTransfer;
use Orm\Zed\ErpOrder\Persistence\ErpOrder;
use Orm\Zed\ErpOrder\Persistence\ErpOrderAddress;
use Orm\Zed\ErpOrder\Persistence\ErpOrderItem;
use Orm\Zed\ErpOrder\Persistence\ErpOrderTotals;
use Spryker\Zed\Kernel\Persistence\AbstractEntityManager;

/**
 * @codeCoverageIgnore
 *
 * @method \FondOfOryx\Zed\ErpOrder\Persistence\ErpOrderPersistenceFactory getFactory()
 */
class ErpOrderEntityManager extends AbstractEntityManager implements ErpOrderEntityManagerInterface
{
    /**
     * @param \Generated\Shared\Transfer\ErpOrderTransfer $erpOrderTransfer
     *
     * @throws \Exception
     *
     * @return \Generated\Shared\Transfer\ErpOrderTransfer
     */
    public function createErpOrder(ErpOrderTransfer $erpOrderTransfer): ErpOrderTransfer
    {
        if ($erpOrderTransfer->getIdErpOrder() !== null) {
            throw new Exception('Use "updateErpOrder" function instead of "createErpOrder" if you already have an id!');
        }

        $erpOrderTransfer
            ->requireOrderItems()
            ->requireBillingAddress()
            ->requireShippingAddress();

        $now = new DateTime();
        $entity = new ErpOrder();
        $entity->fromArray($erpOrderTransfer->toArray());
        $entity
            ->setFkCompanyBusinessUnit($erpOrderTransfer->getFkCompanyBusinessUnit() ?: $erpOrderTransfer->getCompanyBusinessUnit()->getIdCompanyBusinessUnit())
            ->setCreatedAt($erpOrderTransfer->getCreatedAt())
            ->setUpdatedAt($now)
            ->setConcreteDeliveryDate($this->getDate($erpOrderTransfer->getConcreteDeliveryDate()))
            ->save();

        return $this->getFactory()
            ->createEntityToTransferMapper()
            ->fromErpOrderToTransfer($entity, $erpOrderTransfer);
    }

    /**
     * @param \Generated\Shared\Transfer\ErpOrderAddressTransfer $orderAddressTransfer
     *
     * @return \Generated\Shared\Transfer\ErpOrderAddressTransfer
     */
    public function createErpOrderAddress(ErpOrderAddressTransfer $orderAddressTransfer): ErpOrderAddressTransfer
    {
        $orderAddressTransfer
            ->requireName1()
            ->requireName2()
            ->requireAddress1()
            ->requireCity()
            ->requireZipCode();

        $entity = new ErpOrderAddress();
        $entity->fromArray($orderAddressTransfer->toArray());
        $entity->save();

        return $this->getFactory()->createEntityToTransferMapper()->fromErpOrderAddressToTransfer($entity);
    }

    /**
     * @param \Generated\Shared\Transfer\ErpOrderItemTransfer $itemTransfer
     *
     * @return \Generated\Shared\Transfer\ErpOrderItemTransfer
     */
    public function createErpOrderItem(ErpOrderItemTransfer $itemTransfer): ErpOrderItemTransfer
    {
        $itemTransfer
            ->requireFkErpOrder()
            ->requireSku()
            ->requireName();

        $now = new DateTime();

        $entity = new ErpOrderItem();
        $entity->fromArray($itemTransfer->toArray());
        $entity
            ->setCreatedAt($now)
            ->setUpdatedAt($now)
            ->setConcreteDeliveryDate($this->getDate($itemTransfer->getConcreteDeliveryDate()))
            ->setExpectedDeliveryDate($this->getDate($itemTransfer->getExpectedDeliveryDate()))
            ->setGoodsIssueDate($this->getDate($itemTransfer->getGoodsIssueDate()))
            ->save();

        return $this->getFactory()->createEntityToTransferMapper()->fromEprOrderItemToTransfer(
            $entity,
            $itemTransfer,
        );
    }

    /**
     * @param \Generated\Shared\Transfer\ErpOrderTransfer $erpOrderTransfer
     *
     * @throws \Exception
     *
     * @return \Generated\Shared\Transfer\ErpOrderTransfer
     */
    public function updateErpOrder(ErpOrderTransfer $erpOrderTransfer): ErpOrderTransfer
    {
        $erpOrderTransfer->requireIdErpOrder();

        $query = $this->getFactory()->createErpOrderQuery()->clear();

        $entity = $query->findOneByIdErpOrder($erpOrderTransfer->getIdErpOrder());

        if ($entity === null) {
            throw new Exception(sprintf(
                'Erp order with id %s not found',
                $erpOrderTransfer->getIdErpOrder(),
            ));
        }
        $createdAt = $entity->getCreatedAt();
        $entity->fromArray($erpOrderTransfer->toArray());

        $entity
            ->setFkCompanyBusinessUnit($erpOrderTransfer->getFkCompanyBusinessUnit() ?: $erpOrderTransfer->getCompanyBusinessUnit()->getIdCompanyBusinessUnit())
            ->setIdErpOrder($entity->getIdErpOrder())
            ->setCreatedAt($createdAt)
            ->setUpdatedAt(new DateTime())
            ->setConcreteDeliveryDate($this->getDate($erpOrderTransfer->getConcreteDeliveryDate()))
            ->save();

        return $this->getFactory()
            ->createEntityToTransferMapper()
            ->fromErpOrderToTransfer($entity, $erpOrderTransfer);
    }

    /**
     * @param \Generated\Shared\Transfer\ErpOrderItemTransfer $orderItemTransfer
     *
     * @return \Generated\Shared\Transfer\ErpOrderItemTransfer
     */
    public function updateErpOrderItem(ErpOrderItemTransfer $orderItemTransfer): ErpOrderItemTransfer
    {
        $orderItemTransfer
            ->requireIdErpOrderItem()
            ->requireFkErpOrder()
            ->requireSku()
            ->requireName();

        $entity = $this->findOrCreateErpOrderItem($orderItemTransfer->getFkErpOrder(), $orderItemTransfer->getSku());
        $createdAt = $entity->getCreatedAt();
        $updatedAt = new DateTime();
        $entity->fromArray($orderItemTransfer->modifiedToArray());

        $entity
            ->setConcreteDeliveryDate($this->getDate($orderItemTransfer->getConcreteDeliveryDate()))
            ->setCreatedAt($createdAt)
            ->setUpdatedAt($updatedAt)
            ->save();

        return $this->getFactory()->createEntityToTransferMapper()->fromEprOrderItemToTransfer($entity);
    }

    /**
     * @param int $idErpOrder
     *
     * @return void
     */
    public function deleteErpOrderByIdErpOrder(int $idErpOrder): void
    {
        $order = $this->getFactory()->createErpOrderQuery()->clear()->findOneByIdErpOrder($idErpOrder);
        $items = $order->getErpOrderItems();

        foreach ($items as $item) {
            $item->delete();
        }

        $idTotals = $order->getFkTotals();
        $addressIds = [
            $order->getFkBillingAddress(),
            $order->getFkShippingAddress(),
        ];

        $order->delete();

        if ($idTotals !== null) {
            $this->getFactory()->createErpOrderTotalsQuery()
                ->findOneByIdErpOrderTotals($idTotals)
                ->delete();
        }

        $ordersWithBilling = $this->getFactory()->createErpOrderQuery()->filterByFkBillingAddress_In($addressIds)->find();
        if (count($ordersWithBilling) === 0 || empty($ordersWithBilling->getData()) === true) {
            $this->getFactory()->createErpOrderAddressQuery()
                ->findOneByIdErpOrderAddress($addressIds[0])
                ->delete();
        }

        $ordersWithShipping = $this->getFactory()->createErpOrderQuery()->filterByFkShippingAddress_In($addressIds)->find();
        if (count($ordersWithShipping) === 0 || empty($ordersWithShipping->getData()) === true) {
            $this->getFactory()->createErpOrderAddressQuery()
                ->findOneByIdErpOrderAddress($addressIds[1])
                ->delete();
        }
    }

    /**
     * @param int $idErpOrderItem
     *
     * @return void
     */
    public function deleteErpOrderItemByIdErpOrderItem(int $idErpOrderItem): void
    {
        $orderItem = $this->getFactory()->createErpOrderItemQuery()->clear()->filterByIdErpOrderItem($idErpOrderItem)->findOne();
        if ($orderItem === null) {
            return;
        }
        $orderItem->delete();
    }

    /**
     * @param int $idErpOrderAddress
     *
     * @return void
     */
    public function deleteErpOrderAddressByIdErpOrderAddress(int $idErpOrderAddress): void
    {
        $orderAddress = $this->getFactory()->createErpOrderAddressQuery()->clear()->findOneByIdErpOrderAddress($idErpOrderAddress);
        if ($orderAddress === null) {
            return;
        }
        $orderAddress->delete();
    }

    /**
     * @param \Generated\Shared\Transfer\ErpOrderAddressTransfer $erpOrderAddressTransfer
     *
     * @throws \Exception
     *
     * @return \Generated\Shared\Transfer\ErpOrderAddressTransfer
     */
    public function updateErpOrderAddress(ErpOrderAddressTransfer $erpOrderAddressTransfer): ErpOrderAddressTransfer
    {
        $erpOrderAddressTransfer->requireIdErpOrderAddress();

        $query = $this->getFactory()->createErpOrderAddressQuery()->clear();

        $entity = $query->findOneByIdErpOrderAddress($erpOrderAddressTransfer->getIdErpOrderAddress());

        if ($entity === null) {
            throw new Exception(sprintf(
                'Erp order address with id %s not found',
                $erpOrderAddressTransfer->getIdErpOrderAddress(),
            ));
        }
        $id = $entity->getIdErpOrderAddress();
        $createdAt = $entity->getCreatedAt();
        $updatedAt = new DateTime();
        $entity->fromArray($erpOrderAddressTransfer->toArray());
        $entity
            ->setIdErpOrderAddress($id)
            ->setCreatedAt($createdAt)
            ->setUpdatedAt($updatedAt)
            ->save();

        return $this->getFactory()->createEntityToTransferMapper()->fromErpOrderAddressToTransfer($entity);
    }

    /**
     * @param int $idErpOrder
     * @param string $sku
     *
     * @return \Orm\Zed\ErpOrder\Persistence\ErpOrderItem
     */
    protected function findOrCreateErpOrderItem(int $idErpOrder, string $sku): ErpOrderItem
    {
        return $this->getFactory()->createErpOrderItemQuery()->clear()
            ->filterByFkErpOrder($idErpOrder)
            ->filterBySku($sku)
            ->findOneOrCreate();
    }

    /**
     * @param string|null $date
     *
     * @return \DateTime|null
     */
    protected function getDate(?string $date): ?DateTime
    {
        if ($date !== null) {
            $date = new DateTime($date);
        }

        return $date;
    }

    /**
     * @param \Generated\Shared\Transfer\ErpOrderTotalsTransfer $erpOrderTotalsTransfer
     *
     * @return \Generated\Shared\Transfer\ErpOrderTotalsTransfer
     */
    public function createErpOrderTotals(ErpOrderTotalsTransfer $erpOrderTotalsTransfer): ErpOrderTotalsTransfer
    {
        $erpOrderTotalsTransfer
            ->requireSubtotal()
            ->requireGrandTotal()
            ->requireTaxTotal();

        $entity = new ErpOrderTotals();
        $entity->fromArray($erpOrderTotalsTransfer->toArray());
        $entity->save();

        return $this->getFactory()->createEntityToTransferMapper()->fromErpOrderTotalsToTransfer($entity);
    }

    /**
     * @param \Generated\Shared\Transfer\ErpOrderTotalsTransfer $erpOrderTotalsTransfer
     *
     * @throws \Exception
     *
     * @return \Generated\Shared\Transfer\ErpOrderTotalsTransfer
     */
    public function updateErpOrderTotals(ErpOrderTotalsTransfer $erpOrderTotalsTransfer): ErpOrderTotalsTransfer
    {
        $erpOrderTotalsTransfer->requireIdErpOrderTotals();

        $query = $this->getFactory()->createErpOrderTotalsQuery();

        $entity = $query->findOneByIdErpOrderTotals($erpOrderTotalsTransfer->getIdErpOrderTotals());

        if ($entity === null) {
            throw new Exception(sprintf(
                'Erp order total with id %s not found',
                $erpOrderTotalsTransfer->getIdErpOrderTotals(),
            ));
        }

        $id = $entity->getIdErpOrderTotals();

        $entity->fromArray($erpOrderTotalsTransfer->toArray());
        $entity->setIdErpOrderTotals($id)
            ->save();

        return $this->getFactory()->createEntityToTransferMapper()->fromErpOrderTotalsToTransfer($entity);
    }

    /**
     * @param int $idErpOrderTotals
     *
     * @return void
     */
    public function deleteErpOrderTotalsByIdErpOrderTotals(int $idErpOrderTotals): void
    {
        $erpOrderTotals = $this->getFactory()->createErpOrderTotalsQuery()->clear()
            ->findOneByIdErpOrderTotals($idErpOrderTotals);

        if ($erpOrderTotals === null) {
            return;
        }

        $erpOrderTotals->delete();
    }
}
