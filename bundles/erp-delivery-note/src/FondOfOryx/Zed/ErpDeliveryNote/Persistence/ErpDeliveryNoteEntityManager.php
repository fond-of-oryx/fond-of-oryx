<?php

namespace FondOfOryx\Zed\ErpDeliveryNote\Persistence;

use DateTime;
use Exception;
use Generated\Shared\Transfer\ErpDeliveryNoteAddressTransfer;
use Generated\Shared\Transfer\ErpDeliveryNoteExpenseTransfer;
use Generated\Shared\Transfer\ErpDeliveryNoteItemTransfer;
use Generated\Shared\Transfer\ErpDeliveryNoteTrackingTransfer;
use Generated\Shared\Transfer\ErpDeliveryNoteTransfer;
use Orm\Zed\ErpDeliveryNote\Persistence\FooErpDeliveryNote;
use Orm\Zed\ErpDeliveryNote\Persistence\FooErpDeliveryNoteAddress;
use Orm\Zed\ErpDeliveryNote\Persistence\FooErpDeliveryNoteExpense;
use Orm\Zed\ErpDeliveryNote\Persistence\FooErpDeliveryNoteItem;
use Orm\Zed\ErpDeliveryNote\Persistence\FooErpDeliveryNoteTracking;
use Orm\Zed\ErpDeliveryNote\Persistence\FooErpDeliveryNoteTrackingToItem;
use Spryker\Zed\Kernel\Persistence\AbstractEntityManager;

/**
 * @method \FondOfOryx\Zed\ErpDeliveryNote\Persistence\ErpDeliveryNotePersistenceFactory getFactory()
 */
class ErpDeliveryNoteEntityManager extends AbstractEntityManager implements ErpDeliveryNoteEntityManagerInterface
{
    /**
     * @param \Generated\Shared\Transfer\ErpDeliveryNoteTransfer $erpDeliveryNoteTransfer
     *
     * @return \Generated\Shared\Transfer\ErpDeliveryNoteTransfer
     * @throws \Exception
     *
     */
    public function createErpDeliveryNote(ErpDeliveryNoteTransfer $erpDeliveryNoteTransfer): ErpDeliveryNoteTransfer
    {
        if ($erpDeliveryNoteTransfer->getIdErpDeliveryNote() !== null) {
            throw new Exception('Use "updateErpDeliveryNote" function instead of "createErpDeliveryNote" if you already have an id!');
        }

        $erpDeliveryNoteTransfer
            ->requireDeliveryNoteItems()
            ->requireBillingAddress()
            ->requireShippingAddress();

        $now = new DateTime();
        $entity = new FooErpDeliveryNote();
        $entity->fromArray($erpDeliveryNoteTransfer->toArray());
        $entity
            ->setFkCompanyBusinessUnit($erpDeliveryNoteTransfer->getFkCompanyBusinessUnit() ?: $erpDeliveryNoteTransfer->getCompanyBusinessUnit()->getIdCompanyBusinessUnit())
            ->setCreatedAt($now)
            ->setUpdatedAt($now)
            ->save();

        return $this->getFactory()
            ->createEntityToTransferMapper()
            ->fromErpDeliveryNoteToTransfer($entity, $erpDeliveryNoteTransfer);
    }

    /**
     * @param \Generated\Shared\Transfer\ErpDeliveryNoteAddressTransfer $deliveryNoteAddressTransfer
     *
     * @return \Generated\Shared\Transfer\ErpDeliveryNoteAddressTransfer
     */
    public function createErpDeliveryNoteAddress(ErpDeliveryNoteAddressTransfer $deliveryNoteAddressTransfer): ErpDeliveryNoteAddressTransfer
    {
        $deliveryNoteAddressTransfer
            ->requireName1()
            ->requireName2()
            ->requireAddress1()
            ->requireCity()
            ->requireZipCode();

        $entity = new FooErpDeliveryNoteAddress();
        $entity->fromArray($deliveryNoteAddressTransfer->toArray());
        $entity->save();

        return $this->getFactory()->createEntityToTransferMapper()->fromErpDeliveryNoteAddressToTransfer($entity);
    }

    /**
     * @param \Generated\Shared\Transfer\ErpDeliveryNoteItemTransfer $itemTransfer
     *
     * @return \Generated\Shared\Transfer\ErpDeliveryNoteItemTransfer
     */
    public function createErpDeliveryNoteItem(ErpDeliveryNoteItemTransfer $itemTransfer): ErpDeliveryNoteItemTransfer
    {
        $itemTransfer
            ->requireFkErpDeliveryNote()
            ->requireSku()
            ->requireName();

        $now = new DateTime();

        $entity = new FooErpDeliveryNoteItem();
        $entity->fromArray($itemTransfer->toArray());
        $entity
            ->setCreatedAt($now)
            ->setUpdatedAt($now)
            ->save();

        return $this->getFactory()->createEntityToTransferMapper()->fromErpDeliveryNoteItemToTransfer(
            $entity,
            $itemTransfer,
        );
    }

    /**
     * @param \Generated\Shared\Transfer\ErpDeliveryNoteExpenseTransfer $itemTransfer
     *
     * @return \Generated\Shared\Transfer\ErpDeliveryNoteExpenseTransfer
     */
    public function createErpDeliveryNoteExpense(ErpDeliveryNoteExpenseTransfer $itemTransfer): ErpDeliveryNoteExpenseTransfer
    {
        $itemTransfer
            ->requireFkErpDeliveryNote()
            ->requireName();

        $now = new DateTime();

        $entity = new FooErpDeliveryNoteExpense();
        $entity->fromArray($itemTransfer->toArray());
        $entity
            ->setCreatedAt($now)
            ->setUpdatedAt($now)
            ->save();

        return $this->getFactory()->createEntityToTransferMapper()->fromErpDeliveryNoteExpenseToTransfer(
            $entity,
            $itemTransfer,
        );
    }

    /**
     * @param \Generated\Shared\Transfer\ErpDeliveryNoteTrackingTransfer $trackingTransfer
     *
     * @return \Generated\Shared\Transfer\ErpDeliveryNoteTrackingTransfer
     * @throws \Propel\Runtime\Exception\PropelException
     * @throws \Spryker\Shared\Kernel\Transfer\Exception\RequiredTransferPropertyException
     */
    public function createErpDeliveryNoteTracking(ErpDeliveryNoteTrackingTransfer $trackingTransfer): ErpDeliveryNoteTrackingTransfer
    {
        $trackingTransfer
            ->requireFkErpDeliveryNote()
            ->requireTrackingNumber();

        $now = new DateTime();

        $entity = new FooErpDeliveryNoteTracking();
        $entity->fromArray($trackingTransfer->toArray());
        $entity
            ->setCreatedAt($now)
            ->setUpdatedAt($now)
            ->save();

        $this->addItemTrackingRelations($trackingTransfer, $entity);

        return $this->getFactory()->createEntityToTransferMapper()->fromErpDeliveryNoteTrackingToTransfer(
            $entity,
            $trackingTransfer,
        );
    }

    /**
     * @param \Generated\Shared\Transfer\ErpDeliveryNoteTransfer $erpDeliveryNoteTransfer
     *
     * @return \Generated\Shared\Transfer\ErpDeliveryNoteTransfer
     * @throws \Exception
     *
     */
    public function updateErpDeliveryNote(ErpDeliveryNoteTransfer $erpDeliveryNoteTransfer): ErpDeliveryNoteTransfer
    {
        $erpDeliveryNoteTransfer->requireIdErpDeliveryNote();

        $query = $this->getFactory()->createErpDeliveryNoteQuery();

        $entity = $query->findOneByIdErpDeliveryNote($erpDeliveryNoteTransfer->getIdErpDeliveryNote());

        if ($entity === null) {
            throw new Exception(sprintf(
                'Erp deliveryNote with id %s not found',
                $erpDeliveryNoteTransfer->getIdErpDeliveryNote(),
            ));
        }
        $createdAt = $entity->getCreatedAt();
        $entity->fromArray($erpDeliveryNoteTransfer->toArray());

        $entity
            ->setFkCompanyBusinessUnit($erpDeliveryNoteTransfer->getFkCompanyBusinessUnit() ?: $erpDeliveryNoteTransfer->getCompanyBusinessUnit()->getIdCompanyBusinessUnit())
            ->setIdErpDeliveryNote($entity->getIdErpDeliveryNote())
            ->setCreatedAt($createdAt)
            ->setUpdatedAt(new DateTime())
            ->save();

        return $this->getFactory()
            ->createEntityToTransferMapper()
            ->fromErpDeliveryNoteToTransfer($entity, $erpDeliveryNoteTransfer);
    }

    /**
     * @param \Generated\Shared\Transfer\ErpDeliveryNoteItemTransfer $deliveryNoteItemTransfer
     *
     * @return \Generated\Shared\Transfer\ErpDeliveryNoteItemTransfer
     */
    public function updateErpDeliveryNoteItem(ErpDeliveryNoteItemTransfer $deliveryNoteItemTransfer): ErpDeliveryNoteItemTransfer
    {
        $deliveryNoteItemTransfer
            ->requireIdErpDeliveryNoteItem()
            ->requireFkErpDeliveryNote()
            ->requireSku()
            ->requireName();

        $entity = $this->findOrCreateErpDeliveryNoteItem($deliveryNoteItemTransfer->getFkErpDeliveryNote(), $deliveryNoteItemTransfer->getSku());
        $createdAt = $entity->getCreatedAt();
        $updatedAt = new DateTime();
        $entity->fromArray($deliveryNoteItemTransfer->modifiedToArray());

        $entity
            ->setCreatedAt($createdAt)
            ->setUpdatedAt($updatedAt)
            ->save();

        return $this->getFactory()->createEntityToTransferMapper()->fromErpDeliveryNoteItemToTransfer($entity);
    }

    /**
     * @param \Generated\Shared\Transfer\ErpDeliveryNoteExpenseTransfer $deliveryNoteExpenseTransfer
     *
     * @return \Generated\Shared\Transfer\ErpDeliveryNoteExpenseTransfer
     */
    public function updateErpDeliveryNoteExpense(ErpDeliveryNoteExpenseTransfer $deliveryNoteExpenseTransfer): ErpDeliveryNoteExpenseTransfer
    {
        $deliveryNoteExpenseTransfer
            ->requireIdErpDeliveryNoteExpense()
            ->requireFkErpDeliveryNote()
            ->requireName();

        $entity = $this->findOrCreateErpDeliveryNoteExpense($deliveryNoteExpenseTransfer->getFkErpDeliveryNote(), $deliveryNoteExpenseTransfer->getName());
        $createdAt = $entity->getCreatedAt();
        $updatedAt = new DateTime();
        $entity->fromArray($deliveryNoteExpenseTransfer->modifiedToArray());

        $entity
            ->setCreatedAt($createdAt)
            ->setUpdatedAt($updatedAt)
            ->save();

        return $this->getFactory()->createEntityToTransferMapper()->fromErpDeliveryNoteExpenseToTransfer($entity);
    }

    /**
     * @param \Generated\Shared\Transfer\ErpDeliveryNoteTrackingTransfer $deliveryNoteTrackingTransfer
     *
     * @return \Generated\Shared\Transfer\ErpDeliveryNoteTrackingTransfer
     */
    public function updateErpDeliveryNoteTracking(ErpDeliveryNoteTrackingTransfer $deliveryNoteTrackingTransfer): ErpDeliveryNoteTrackingTransfer
    {
        $deliveryNoteTrackingTransfer
            ->requireIdErpDeliveryNoteTracking()
            ->requireFkErpDeliveryNote()
            ->requireTrackingNumber()
            ->requireErpDeliveryNoteItems()
            ->requireQuantity();

        $entity = $this->findOrCreateErpDeliveryNoteTracking($deliveryNoteTrackingTransfer->getFkErpDeliveryNote(), $deliveryNoteTrackingTransfer->getTrackingNumber());
        $createdAt = $entity->getCreatedAt();
        $updatedAt = new DateTime();
        $entity->fromArray($deliveryNoteTrackingTransfer->modifiedToArray());

        $entity
            ->setCreatedAt($createdAt)
            ->setUpdatedAt($updatedAt)
            ->save();

        $this->deleteTrackingToItemRelationsByIdTracking($entity->getIdErpDeliveryNoteTracking());
        $this->addItemTrackingRelations($deliveryNoteTrackingTransfer, $entity);

        return $this->getFactory()->createEntityToTransferMapper()->fromErpDeliveryNoteTrackingToTransfer($entity);
    }

    /**
     * @param int $idTracking
     *
     * @return void
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function deleteTrackingToItemRelationsByIdTracking(int $idTracking): void
    {
        $relations = $this->getFactory()->createErpDeliveryNoteTrackingToItemQuery()->findByFkErpDeliveryNoteTracking($idTracking);
        foreach ($relations as $relation) {
            $relation->delete();
        }
    }

    /**
     * @param string $trackingNumber
     *
     * @return void
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function deleteTrackingToItemRelationsByTrackingNumber(string $trackingNumber): void
    {
        $tracking = $this->getFactory()->createErpDeliveryNoteTrackingQuery()->findOneByTrackingNumber($trackingNumber);
        if ($tracking !== null) {
            $this->deleteTrackingToItemRelationsByIdTracking($tracking->getIdErpDeliveryNoteTracking());
        }
    }

    /**
     * @param int $idErpDeliveryNote
     *
     * @return void
     */
    public function deleteErpDeliveryNoteByIdErpDeliveryNote(int $idErpDeliveryNote): void
    {
        $deliveryNote = $this->getFactory()->createErpDeliveryNoteQuery()->findOneByIdErpDeliveryNote($idErpDeliveryNote);
        $items = $deliveryNote->getFooErpDeliveryNoteItems();

        foreach ($items as $item) {
            $item->delete();
        }
        $addressIds = [
            $deliveryNote->getFkBillingAddress(),
            $deliveryNote->getFkShippingAddress(),
        ];

        $deliveryNote->delete();

        $deliveryNotesWithBilling = $this->getFactory()->createErpDeliveryNoteQuery()->filterByFkBillingAddress_In($addressIds)->find();
        if (count($deliveryNotesWithBilling) === 0 || empty($deliveryNotesWithBilling->getData()) === true) {
            $this->getFactory()->createErpDeliveryNoteAddressQuery()
                ->findOneByIdErpDeliveryNoteAddress($addressIds[0])
                ->delete();
        }

        $deliveryNotesWithShipping = $this->getFactory()->createErpDeliveryNoteQuery()->filterByFkShippingAddress_In($addressIds)->find();
        if (count($deliveryNotesWithShipping) === 0 || empty($deliveryNotesWithShipping->getData()) === true) {
            $this->getFactory()->createErpDeliveryNoteAddressQuery()
                ->findOneByIdErpDeliveryNoteAddress($addressIds[1])
                ->delete();
        }
    }

    /**
     * @param int $idErpDeliveryNoteItem
     *
     * @return void
     */
    public function deleteErpDeliveryNoteItemByIdErpDeliveryNoteItem(int $idErpDeliveryNoteItem): void
    {
        $deliveryNoteItem = $this->getFactory()->createErpDeliveryNoteItemQuery()->findOneByIdErpDeliveryNoteItem($idErpDeliveryNoteItem);
        if ($deliveryNoteItem === null) {
            return;
        }
        $deliveryNoteItem->delete();
    }

    /**
     * @param int $idErpDeliveryNoteExpense
     *
     * @return void
     */
    public function deleteErpDeliveryNoteExpenseByIdErpDeliveryNoteExpense(int $idErpDeliveryNoteExpense): void
    {
        $deliveryNoteExpense = $this->getFactory()->createErpDeliveryNoteExpenseQuery()->findOneByIdErpDeliveryNoteExpense($idErpDeliveryNoteExpense);
        if ($deliveryNoteExpense === null) {
            return;
        }
        $deliveryNoteExpense->delete();
    }

    /**
     * @param int $idErpDeliveryNoteAddress
     *
     * @return void
     */
    public function deleteErpDeliveryNoteAddressByIdErpDeliveryNoteAddress(int $idErpDeliveryNoteAddress): void
    {
        $deliveryNoteAddress = $this->getFactory()->createErpDeliveryNoteAddressQuery()->findOneByIdErpDeliveryNoteAddress($idErpDeliveryNoteAddress);
        if ($deliveryNoteAddress === null) {
            return;
        }
        $deliveryNoteAddress->delete();
    }

    /**
     * @param \Generated\Shared\Transfer\ErpDeliveryNoteAddressTransfer $erpDeliveryNoteAddressTransfer
     *
     * @return \Generated\Shared\Transfer\ErpDeliveryNoteAddressTransfer
     * @throws \Exception
     *
     */
    public function updateErpDeliveryNoteAddress(ErpDeliveryNoteAddressTransfer $erpDeliveryNoteAddressTransfer): ErpDeliveryNoteAddressTransfer
    {
        $erpDeliveryNoteAddressTransfer->requireIdErpDeliveryNoteAddress();

        $query = $this->getFactory()->createErpDeliveryNoteAddressQuery();

        $entity = $query->findOneByIdErpDeliveryNoteAddress($erpDeliveryNoteAddressTransfer->getIdErpDeliveryNoteAddress());

        if ($entity === null) {
            throw new Exception(sprintf(
                'Erp deliveryNote address with id %s not found',
                $erpDeliveryNoteAddressTransfer->getIdErpDeliveryNoteAddress(),
            ));
        }
        $id = $entity->getIdErpDeliveryNoteAddress();
        $createdAt = $entity->getCreatedAt();
        $updatedAt = new DateTime();
        $entity->fromArray($erpDeliveryNoteAddressTransfer->toArray());
        $entity
            ->setIdErpDeliveryNoteAddress($id)
            ->setCreatedAt($createdAt)
            ->setUpdatedAt($updatedAt)
            ->save();

        return $this->getFactory()->createEntityToTransferMapper()->fromErpDeliveryNoteAddressToTransfer($entity);
    }

    /**
     * @param int $idErpDeliveryNote
     * @param string $sku
     *
     * @return \Orm\Zed\ErpDeliveryNote\Persistence\FooErpDeliveryNoteItem
     */
    protected function findOrCreateErpDeliveryNoteItem(int $idErpDeliveryNote, string $sku): FooErpDeliveryNoteItem
    {
        return $this->getFactory()->createErpDeliveryNoteItemQuery()
            ->filterByFkErpDeliveryNote($idErpDeliveryNote)
            ->filterBySku($sku)
            ->findOneOrCreate();
    }

    /**
     * @param int $idErpDeliveryNote
     * @param string $name
     *
     * @return \Orm\Zed\ErpDeliveryNote\Persistence\FooErpDeliveryNoteExpense
     */
    protected function findOrCreateErpDeliveryNoteExpense(int $idErpDeliveryNote, string $name): FooErpDeliveryNoteExpense
    {
        return $this->getFactory()->createErpDeliveryNoteExpenseQuery()
            ->filterByFkErpDeliveryNote($idErpDeliveryNote)
            ->filterByName($name)
            ->findOneOrCreate();
    }

    /**
     * @param int $idErpDeliveryNote
     * @param string $trackingNumber
     *
     * @return \Orm\Zed\ErpDeliveryNote\Persistence\FooErpDeliveryNoteTracking
     */
    protected function findOrCreateErpDeliveryNoteTracking(int $idErpDeliveryNote, string $trackingNumber): FooErpDeliveryNoteTracking
    {
        return $this->getFactory()->createErpDeliveryNoteTrackingQuery()
            ->filterByFkErpDeliveryNote($idErpDeliveryNote)
            ->filterByTrackingNumber($trackingNumber)
            ->findOneOrCreate();
    }

    /**
     * @param \Generated\Shared\Transfer\ErpDeliveryNoteTrackingTransfer $trackingTransfer
     * @param \Orm\Zed\ErpDeliveryNote\Persistence\FooErpDeliveryNoteTracking $entity
     *
     * @return void
     * @throws \Propel\Runtime\Exception\PropelException
     */
    protected function addItemTrackingRelations(ErpDeliveryNoteTrackingTransfer $trackingTransfer, FooErpDeliveryNoteTracking $entity): void
    {
        $relations = [];
        $keyPrefix = sprintf('%s-%s-%s', $trackingTransfer->getTrackingNumber(), $entity->getFkErpDeliveryNote(), $entity->getIdErpDeliveryNoteTracking());

        foreach ($trackingTransfer->getItemRelations() as $itemRelation){
            $relation = new FooErpDeliveryNoteTrackingToItem();
            $key = sprintf('%s-%s', $keyPrefix, $itemRelation->getFkErpDeliveryNoteItem());
            $relations[$key] = $relation->fromArray($itemRelation->toArray())
                ->setFkErpDeliveryNoteTracking($entity->getIdErpDeliveryNoteTracking());
        }

        foreach ($trackingTransfer->getErpDeliveryNoteItems() as $itemTransfer) {
            $key = sprintf('%s-%s', $keyPrefix, $itemTransfer->getIdErpDeliveryNoteItem());
            $relation = new FooErpDeliveryNoteTrackingToItem();
            if (array_key_exists($key, $relations)){
                $relation = $relations[$key];
            }
            $relations[$key] = $relation
                ->setFkErpDeliveryNoteItem($itemTransfer->getIdErpDeliveryNoteItem())
                ->setFkErpDeliveryNoteTracking($entity->getIdErpDeliveryNoteTracking());
        }

        foreach ($relations as $relation){
            $relation->save();
        }
    }
}
