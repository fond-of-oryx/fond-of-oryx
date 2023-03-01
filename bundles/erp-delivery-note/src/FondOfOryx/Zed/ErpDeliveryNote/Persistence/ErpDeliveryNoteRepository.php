<?php

namespace FondOfOryx\Zed\ErpDeliveryNote\Persistence;

use Generated\Shared\Transfer\ErpDeliveryNoteAddressTransfer;
use Generated\Shared\Transfer\ErpDeliveryNoteExpenseCollectionTransfer;
use Generated\Shared\Transfer\ErpDeliveryNoteExpenseTransfer;
use Generated\Shared\Transfer\ErpDeliveryNoteItemCollectionTransfer;
use Generated\Shared\Transfer\ErpDeliveryNoteItemTransfer;
use Generated\Shared\Transfer\ErpDeliveryNoteTrackingCollectionTransfer;
use Generated\Shared\Transfer\ErpDeliveryNoteTrackingTransfer;
use Generated\Shared\Transfer\ErpDeliveryNoteTransfer;
use Orm\Zed\ErpDeliveryNote\Persistence\FooErpDeliveryNoteAddressQuery;
use Orm\Zed\ErpDeliveryNote\Persistence\FooErpDeliveryNoteExpenseQuery;
use Orm\Zed\ErpDeliveryNote\Persistence\FooErpDeliveryNoteItemQuery;
use Orm\Zed\ErpDeliveryNote\Persistence\FooErpDeliveryNoteQuery;
use Orm\Zed\ErpDeliveryNote\Persistence\FooErpDeliveryNoteTrackingQuery;
use Spryker\Zed\Kernel\Persistence\AbstractRepository;

/**
 * @method \FondOfOryx\Zed\ErpDeliveryNote\Persistence\ErpDeliveryNotePersistenceFactory getFactory()
 */
class ErpDeliveryNoteRepository extends AbstractRepository implements ErpDeliveryNoteRepositoryInterface
{
    /**
     * @param int $idErpDeliveryNote
     *
     * @return \Generated\Shared\Transfer\ErpDeliveryNoteTransfer|null
     */
    public function findErpDeliveryNoteByIdErpDeliveryNote(int $idErpDeliveryNote): ?ErpDeliveryNoteTransfer
    {
        $query = $this->getErpDeliveryNoteQuery();
        $deliveryNote = $query->findOneByIdErpDeliveryNote($idErpDeliveryNote);

        if ($deliveryNote === null) {
            return null;
        }

        return $this->getFactory()->createEntityToTransferMapper()->fromErpDeliveryNoteToTransfer($deliveryNote);
    }

    /**
     * @param string $erpDeliveryNoteExternalReference
     *
     * @return \Generated\Shared\Transfer\ErpDeliveryNoteTransfer|null
     */
    public function findErpDeliveryNoteByExternalReference(string $erpDeliveryNoteExternalReference): ?ErpDeliveryNoteTransfer
    {
        $query = $this->getErpDeliveryNoteQuery();
        $deliveryNote = $query->findOneByExternalReference($erpDeliveryNoteExternalReference);

        if ($deliveryNote === null) {
            return null;
        }

        return $this->getFactory()->createEntityToTransferMapper()->fromErpDeliveryNoteToTransfer($deliveryNote);
    }

    /**
     * @param int $idErpDeliveryNote
     *
     * @return \Generated\Shared\Transfer\ErpDeliveryNoteItemCollectionTransfer
     */
    public function findErpDeliveryNoteItemsByIdErpDeliveryNote(int $idErpDeliveryNote): ErpDeliveryNoteItemCollectionTransfer
    {
        $query = $this->getErpDeliveryNoteItemQuery();
        $items = $query->findByFkErpDeliveryNote($idErpDeliveryNote);
        $itemCollectionTransfer = new ErpDeliveryNoteItemCollectionTransfer();

        if (empty($items->getData())) {
            return $itemCollectionTransfer;
        }

        foreach ($items->getData() as $item) {
            $itemCollectionTransfer->addItem($this->getFactory()->createEntityToTransferMapper()->fromErpDeliveryNoteItemToTransfer($item));
        }

        return $itemCollectionTransfer;
    }

    /**
     * @param int $idErpDeliveryNoteItem
     *
     * @return \Generated\Shared\Transfer\ErpDeliveryNoteItemTransfer|null
     */
    public function findErpDeliveryNoteItemByIdErpDeliveryNoteItem(int $idErpDeliveryNoteItem): ?ErpDeliveryNoteItemTransfer
    {
        $query = $this->getErpDeliveryNoteItemQuery();
        $item = $query->findOneByIdErpDeliveryNoteItem($idErpDeliveryNoteItem);

        if ($item === null) {
            return null;
        }

        return $this->getFactory()->createEntityToTransferMapper()->fromErpDeliveryNoteItemToTransfer($item);
    }

    /**
     * @param int $idErpDeliveryNote
     *
     * @return \Generated\Shared\Transfer\ErpDeliveryNoteExpenseCollectionTransfer
     */
    public function findErpDeliveryNoteExpensesByIdErpDeliveryNote(int $idErpDeliveryNote): ErpDeliveryNoteExpenseCollectionTransfer
    {
        $query = $this->getErpDeliveryNoteExpenseQuery();
        $items = $query->findByFkErpDeliveryNote($idErpDeliveryNote);
        $itemCollectionTransfer = new ErpDeliveryNoteExpenseCollectionTransfer();

        if (empty($items->getData())) {
            return $itemCollectionTransfer;
        }

        foreach ($items->getData() as $item) {
            $itemCollectionTransfer->addExpense($this->getFactory()->createEntityToTransferMapper()->fromErpDeliveryNoteExpenseToTransfer($item));
        }

        return $itemCollectionTransfer;
    }

    /**
     * @param int $idErpDeliveryNoteExpense
     *
     * @return \Generated\Shared\Transfer\ErpDeliveryNoteExpenseTransfer|null
     */
    public function findErpDeliveryNoteExpenseByIdErpDeliveryNoteExpense(int $idErpDeliveryNoteExpense): ?ErpDeliveryNoteExpenseTransfer
    {
        $query = $this->getErpDeliveryNoteExpenseQuery();
        $item = $query->findOneByIdErpDeliveryNoteExpense($idErpDeliveryNoteExpense);

        if ($item === null) {
            return null;
        }

        return $this->getFactory()->createEntityToTransferMapper()->fromErpDeliveryNoteExpenseToTransfer($item);
    }

    /**
     * @param int $idErpDeliveryNoteAddress
     *
     * @return \Generated\Shared\Transfer\ErpDeliveryNoteAddressTransfer|null
     */
    public function findErpDeliveryNoteAddressByIdErpDeliveryNoteAddress(int $idErpDeliveryNoteAddress): ?ErpDeliveryNoteAddressTransfer
    {
        $query = $this->getErpDeliveryNoteAddressQuery();
        $address = $query->findOneByIdErpDeliveryNoteAddress($idErpDeliveryNoteAddress);

        if ($address === null) {
            return null;
        }

        return $this->getFactory()->createEntityToTransferMapper()->fromErpDeliveryNoteAddressToTransfer($address);
    }

    /**
     * @param int $idErpDeliveryNote
     *
     * @return \Generated\Shared\Transfer\ErpDeliveryNoteTrackingCollectionTransfer
     */
    public function findErpDeliveryNoteTrackingByIdErpDeliveryNote(int $idErpDeliveryNote): ErpDeliveryNoteTrackingCollectionTransfer
    {
        $query = $this->getErpDeliveryNoteTrackingQuery();
        $items = $query->findByFkErpDeliveryNote($idErpDeliveryNote);
        $itemCollectionTransfer = new ErpDeliveryNoteTrackingCollectionTransfer();

        if (empty($items->getData())) {
            return $itemCollectionTransfer;
        }

        foreach ($items->getData() as $item) {
            $itemCollectionTransfer->addTracking($this->getFactory()->createEntityToTransferMapper()->fromErpDeliveryNoteTrackingToTransfer($item));
        }

        return $itemCollectionTransfer;
    }

    /**
     * @param int $idErpDeliveryNoteTracking
     *
     * @return \Generated\Shared\Transfer\ErpDeliveryNoteTrackingTransfer|null
     */
    public function findErpDeliveryNoteTrackingByIdErpDeliveryNoteTracking(int $idErpDeliveryNoteTracking): ?ErpDeliveryNoteTrackingTransfer
    {
        $query = $this->getErpDeliveryNoteTrackingQuery();
        $item = $query->findOneByIdErpDeliveryNoteTracking($idErpDeliveryNoteTracking);

        if ($item === null) {
            return null;
        }

        return $this->getFactory()->createEntityToTransferMapper()->fromErpDeliveryNoteTrackingToTransfer($item);
    }

    /**
     * @return \Orm\Zed\ErpDeliveryNote\Persistence\FooErpDeliveryNoteQuery
     */
    protected function getErpDeliveryNoteQuery(): FooErpDeliveryNoteQuery
    {
        return $this->getFactory()->createErpDeliveryNoteQuery();
    }

    /**
     * @return \Orm\Zed\ErpDeliveryNote\Persistence\FooErpDeliveryNoteItemQuery
     */
    protected function getErpDeliveryNoteItemQuery(): FooErpDeliveryNoteItemQuery
    {
        return $this->getFactory()->createErpDeliveryNoteItemQuery();
    }

    /**
     * @return \Orm\Zed\ErpDeliveryNote\Persistence\FooErpDeliveryNoteExpenseQuery
     */
    protected function getErpDeliveryNoteExpenseQuery(): FooErpDeliveryNoteExpenseQuery
    {
        return $this->getFactory()->createErpDeliveryNoteExpenseQuery();
    }

    /**
     * @return \Orm\Zed\ErpDeliveryNote\Persistence\FooErpDeliveryNoteAddressQuery
     */
    protected function getErpDeliveryNoteAddressQuery(): FooErpDeliveryNoteAddressQuery
    {
        return $this->getFactory()->createErpDeliveryNoteAddressQuery();
    }

    /**
     * @return \Orm\Zed\ErpDeliveryNote\Persistence\FooErpDeliveryNoteTrackingQuery
     */
    protected function getErpDeliveryNoteTrackingQuery(): FooErpDeliveryNoteTrackingQuery
    {
        return $this->getFactory()->createErpDeliveryNoteTrackingQuery();
    }
}
