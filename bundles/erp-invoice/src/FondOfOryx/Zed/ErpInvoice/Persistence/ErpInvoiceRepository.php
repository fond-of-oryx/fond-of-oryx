<?php

namespace FondOfOryx\Zed\ErpInvoice\Persistence;

use Generated\Shared\Transfer\ErpInvoiceAddressTransfer;
use Generated\Shared\Transfer\ErpInvoiceAmountTransfer;
use Generated\Shared\Transfer\ErpInvoiceExpenseCollectionTransfer;
use Generated\Shared\Transfer\ErpInvoiceExpenseTransfer;
use Generated\Shared\Transfer\ErpInvoiceItemCollectionTransfer;
use Generated\Shared\Transfer\ErpInvoiceItemTransfer;
use Generated\Shared\Transfer\ErpInvoiceTransfer;
use Orm\Zed\ErpInvoice\Persistence\FooErpInvoiceAddressQuery;
use Orm\Zed\ErpInvoice\Persistence\FooErpInvoiceAmountQuery;
use Orm\Zed\ErpInvoice\Persistence\FooErpInvoiceExpenseQuery;
use Orm\Zed\ErpInvoice\Persistence\FooErpInvoiceItemQuery;
use Orm\Zed\ErpInvoice\Persistence\FooErpInvoiceQuery;
use Spryker\Zed\Kernel\Persistence\AbstractRepository;

/**
 * @method \FondOfOryx\Zed\ErpInvoice\Persistence\ErpInvoicePersistenceFactory getFactory()
 */
class ErpInvoiceRepository extends AbstractRepository implements ErpInvoiceRepositoryInterface
{
    /**
     * @param int $idErpInvoice
     *
     * @return \Generated\Shared\Transfer\ErpInvoiceTransfer|null
     */
    public function findErpInvoiceByIdErpInvoice(int $idErpInvoice): ?ErpInvoiceTransfer
    {
        $query = $this->getErpInvoiceQuery();
        $invoice = $query->findOneByIdErpInvoice($idErpInvoice);

        if (empty($invoice) || empty($invoice->getIdErpInvoice())) {
            return null;
        }

        return $this->getFactory()->createEntityToTransferMapper()->fromErpInvoiceToTransfer($invoice);
    }

    /**
     * @param string $erpInvoiceExternalReference
     *
     * @return \Generated\Shared\Transfer\ErpInvoiceTransfer|null
     */
    public function findErpInvoiceByExternalReference(string $erpInvoiceExternalReference): ?ErpInvoiceTransfer
    {
        $query = $this->getErpInvoiceQuery();
        $invoice = $query->findOneByExternalReference($erpInvoiceExternalReference);

        if (empty($invoice) || empty($invoice->getIdErpInvoice())) {
            return null;
        }

        return $this->getFactory()->createEntityToTransferMapper()->fromErpInvoiceToTransfer($invoice);
    }

    /**
     * @param int $idErpInvoice
     *
     * @return \Generated\Shared\Transfer\ErpInvoiceItemCollectionTransfer
     */
    public function findErpInvoiceItemsByIdErpInvoice(int $idErpInvoice): ErpInvoiceItemCollectionTransfer
    {
        $query = $this->getErpInvoiceItemQuery();
        $items = $query->findByFkErpInvoice($idErpInvoice);
        $itemCollectionTransfer = new ErpInvoiceItemCollectionTransfer();

        if (empty($items) || empty($items->getData())) {
            return $itemCollectionTransfer;
        }

        foreach ($items->getData() as $item) {
            $itemCollectionTransfer->addItem($this->getFactory()->createEntityToTransferMapper()->fromEprInvoiceItemToTransfer($item));
        }

        return $itemCollectionTransfer;
    }

    /**
     * @param int $idErpInvoiceItem
     *
     * @return \Generated\Shared\Transfer\ErpInvoiceItemTransfer|null
     */
    public function findErpInvoiceItemByIdErpInvoiceItem(int $idErpInvoiceItem): ?ErpInvoiceItemTransfer
    {
        $query = $this->getErpInvoiceItemQuery();
        $item = $query->findOneByIdErpInvoiceItem($idErpInvoiceItem);

        if ($item === null) {
            return null;
        }

        return $this->getFactory()->createEntityToTransferMapper()->fromEprInvoiceItemToTransfer($item);
    }

    /**
     * @param int $idErpInvoice
     *
     * @return \Generated\Shared\Transfer\ErpInvoiceExpenseCollectionTransfer
     */
    public function findErpInvoiceExpensesByIdErpInvoice(int $idErpInvoice): ErpInvoiceExpenseCollectionTransfer
    {
        $query = $this->getErpInvoiceExpenseQuery();
        $items = $query->findByFkErpInvoice($idErpInvoice);
        $itemCollectionTransfer = new ErpInvoiceExpenseCollectionTransfer();

        if (empty($items) || empty($items->getData())) {
            return $itemCollectionTransfer;
        }

        foreach ($items->getData() as $item) {
            $itemCollectionTransfer->addExpense($this->getFactory()->createEntityToTransferMapper()->fromEprInvoiceExpenseToTransfer($item));
        }

        return $itemCollectionTransfer;
    }

    /**
     * @param int $idErpInvoiceExpense
     *
     * @return \Generated\Shared\Transfer\ErpInvoiceExpenseTransfer|null
     */
    public function findErpInvoiceExpenseByIdErpInvoiceExpense(int $idErpInvoiceExpense): ?ErpInvoiceExpenseTransfer
    {
        $query = $this->getErpInvoiceExpenseQuery();
        $item = $query->findOneByIdErpInvoiceExpense($idErpInvoiceExpense);

        if ($item === null) {
            return null;
        }

        return $this->getFactory()->createEntityToTransferMapper()->fromEprInvoiceExpenseToTransfer($item);
    }

    /**
     * @param int $idErpInvoiceAddress
     *
     * @return \Generated\Shared\Transfer\ErpInvoiceAddressTransfer|null
     */
    public function findErpInvoiceAddressByIdErpInvoiceAddress(int $idErpInvoiceAddress): ?ErpInvoiceAddressTransfer
    {
        $query = $this->getErpInvoiceAddressQuery();
        $address = $query->findOneByIdErpInvoiceAddress($idErpInvoiceAddress);

        if (empty($address) || !is_int($address->getIdErpInvoiceAddress())) {
            return null;
        }

        return $this->getFactory()->createEntityToTransferMapper()->fromErpInvoiceAddressToTransfer($address);
    }

    /**
     * @param int $idErpInvoiceAmount
     *
     * @return \Generated\Shared\Transfer\ErpInvoiceAmountTransfer|null
     */
    public function findErpInvoiceAmountByIdErpInvoiceAmount(int $idErpInvoiceAmount): ?ErpInvoiceAmountTransfer
    {
        $query = $this->getErpInvoiceAmountQuery();
        $total = $query->findOneByIdErpInvoiceAmount($idErpInvoiceAmount);

        if (empty($total) || !is_int($total->getIdErpInvoiceAmount())) {
            return null;
        }

        return $this->getFactory()->createEntityToTransferMapper()->fromErpInvoiceAmountToTransfer($total);
    }

    /**
     * @return \Orm\Zed\ErpInvoice\Persistence\FooErpInvoiceQuery
     */
    protected function getErpInvoiceQuery(): FooErpInvoiceQuery
    {
        return $this->getFactory()->createErpInvoiceQuery();
    }

    /**
     * @return \Orm\Zed\ErpInvoice\Persistence\FooErpInvoiceItemQuery
     */
    protected function getErpInvoiceItemQuery(): FooErpInvoiceItemQuery
    {
        return $this->getFactory()->createErpInvoiceItemQuery();
    }

    /**
     * @return \Orm\Zed\ErpInvoice\Persistence\FooErpInvoiceExpenseQuery
     */
    protected function getErpInvoiceExpenseQuery(): FooErpInvoiceExpenseQuery
    {
        return $this->getFactory()->createErpInvoiceExpenseQuery();
    }

    /**
     * @return \Orm\Zed\ErpInvoice\Persistence\FooErpInvoiceAddressQuery
     */
    protected function getErpInvoiceAddressQuery(): FooErpInvoiceAddressQuery
    {
        return $this->getFactory()->createErpInvoiceAddressQuery();
    }

    /**
     * @return \Orm\Zed\ErpInvoice\Persistence\FooErpInvoiceAmountQuery
     */
    protected function getErpInvoiceAmountQuery(): FooErpInvoiceAmountQuery
    {
        return $this->getFactory()->createErpInvoiceAmountQuery();
    }
}
