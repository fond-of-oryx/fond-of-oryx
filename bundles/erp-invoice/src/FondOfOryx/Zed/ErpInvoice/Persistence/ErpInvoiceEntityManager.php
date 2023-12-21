<?php

namespace FondOfOryx\Zed\ErpInvoice\Persistence;

use DateTime;
use Exception;
use Generated\Shared\Transfer\ErpInvoiceAddressTransfer;
use Generated\Shared\Transfer\ErpInvoiceAmountTransfer;
use Generated\Shared\Transfer\ErpInvoiceExpenseTransfer;
use Generated\Shared\Transfer\ErpInvoiceItemTransfer;
use Generated\Shared\Transfer\ErpInvoiceTransfer;
use Orm\Zed\ErpInvoice\Persistence\FooErpInvoice;
use Orm\Zed\ErpInvoice\Persistence\FooErpInvoiceAddress;
use Orm\Zed\ErpInvoice\Persistence\FooErpInvoiceAmount;
use Orm\Zed\ErpInvoice\Persistence\FooErpInvoiceExpense;
use Orm\Zed\ErpInvoice\Persistence\FooErpInvoiceItem;
use Spryker\Zed\Kernel\Persistence\AbstractEntityManager;

/**
 * @method \FondOfOryx\Zed\ErpInvoice\Persistence\ErpInvoicePersistenceFactory getFactory()
 */
class ErpInvoiceEntityManager extends AbstractEntityManager implements ErpInvoiceEntityManagerInterface
{
    /**
     * @param \Generated\Shared\Transfer\ErpInvoiceTransfer $erpInvoiceTransfer
     *
     * @throws \Exception
     *
     * @return \Generated\Shared\Transfer\ErpInvoiceTransfer
     */
    public function createErpInvoice(ErpInvoiceTransfer $erpInvoiceTransfer): ErpInvoiceTransfer
    {
        if ($erpInvoiceTransfer->getIdErpInvoice() !== null) {
            throw new Exception('Use "updateErpInvoice" function instead of "createErpInvoice" if you already have an id!');
        }

        $erpInvoiceTransfer
            ->requireInvoiceItems()
            ->requireBillingAddress()
            ->requireShippingAddress();

        $now = new DateTime();
        $entity = new FooErpInvoice();
        $entity->fromArray($erpInvoiceTransfer->toArray());
        $entity
            ->setFkCompanyBusinessUnit($erpInvoiceTransfer->getFkCompanyBusinessUnit() ?: $erpInvoiceTransfer->getCompanyBusinessUnit()->getIdCompanyBusinessUnit())
            ->setCreatedAt($now)
            ->setUpdatedAt($now)
            ->save();

        return $this->getFactory()
            ->createEntityToTransferMapper()
            ->fromErpInvoiceToTransfer($entity, $erpInvoiceTransfer);
    }

    /**
     * @param \Generated\Shared\Transfer\ErpInvoiceAddressTransfer $invoiceAddressTransfer
     *
     * @return \Generated\Shared\Transfer\ErpInvoiceAddressTransfer
     */
    public function createErpInvoiceAddress(ErpInvoiceAddressTransfer $invoiceAddressTransfer): ErpInvoiceAddressTransfer
    {
        $invoiceAddressTransfer
            ->requireName1()
            ->requireName2()
            ->requireAddress1()
            ->requireCity()
            ->requireZipCode();

        $entity = new FooErpInvoiceAddress();
        $entity->fromArray($invoiceAddressTransfer->toArray());
        $entity->save();

        return $this->getFactory()->createEntityToTransferMapper()->fromErpInvoiceAddressToTransfer($entity);
    }

    /**
     * @param \Generated\Shared\Transfer\ErpInvoiceAmountTransfer $invoiceAmountTransfer
     *
     * @return \Generated\Shared\Transfer\ErpInvoiceAmountTransfer
     */
    public function createErpInvoiceAmount(ErpInvoiceAmountTransfer $invoiceAmountTransfer): ErpInvoiceAmountTransfer
    {
        $invoiceAmountTransfer
            ->requireValue()
            ->requireTax();

        $entity = new FooErpInvoiceAmount();
        $entity->fromArray($invoiceAmountTransfer->toArray());
        $entity->save();

        return $this->getFactory()->createEntityToTransferMapper()->fromErpInvoiceAmountToTransfer($entity);
    }

    /**
     * @param \Generated\Shared\Transfer\ErpInvoiceItemTransfer $itemTransfer
     *
     * @return \Generated\Shared\Transfer\ErpInvoiceItemTransfer
     */
    public function createErpInvoiceItem(ErpInvoiceItemTransfer $itemTransfer): ErpInvoiceItemTransfer
    {
        $itemTransfer
            ->requireFkErpInvoice()
            ->requireSku()
            ->requireName()
            ->setIdErpInvoiceItem(null);

        $now = new DateTime();

        $entity = new FooErpInvoiceItem();
        $entity->fromArray($itemTransfer->toArray());
        $entity
            ->setCreatedAt($now)
            ->setUpdatedAt($now)
            ->save();

        return $this->getFactory()->createEntityToTransferMapper()->fromEprInvoiceItemToTransfer(
            $entity,
            $itemTransfer,
        );
    }

    /**
     * @param \Generated\Shared\Transfer\ErpInvoiceExpenseTransfer $itemTransfer
     *
     * @return \Generated\Shared\Transfer\ErpInvoiceExpenseTransfer
     */
    public function createErpInvoiceExpense(ErpInvoiceExpenseTransfer $itemTransfer): ErpInvoiceExpenseTransfer
    {
        $itemTransfer
            ->requireFkErpInvoice()
            ->requireName();

        $now = new DateTime();

        $entity = new FooErpInvoiceExpense();
        $entity->fromArray($itemTransfer->toArray());
        $entity
            ->setCreatedAt($now)
            ->setUpdatedAt($now)
            ->save();

        return $this->getFactory()->createEntityToTransferMapper()->fromEprInvoiceExpenseToTransfer(
            $entity,
            $itemTransfer,
        );
    }

    /**
     * @param \Generated\Shared\Transfer\ErpInvoiceTransfer $erpInvoiceTransfer
     *
     * @throws \Exception
     *
     * @return \Generated\Shared\Transfer\ErpInvoiceTransfer
     */
    public function updateErpInvoice(ErpInvoiceTransfer $erpInvoiceTransfer): ErpInvoiceTransfer
    {
        $erpInvoiceTransfer->requireIdErpInvoice();

        $query = $this->getFactory()->createErpInvoiceQuery();

        $entity = $query->findOneByIdErpInvoice($erpInvoiceTransfer->getIdErpInvoice());

        if ($entity === null) {
            throw new Exception(sprintf(
                'Erp invoice with id %s not found',
                $erpInvoiceTransfer->getIdErpInvoice(),
            ));
        }
        $createdAt = $entity->getCreatedAt();
        $entity->fromArray($erpInvoiceTransfer->toArray());

        $entity
            ->setFkCompanyBusinessUnit($erpInvoiceTransfer->getFkCompanyBusinessUnit() ?: $erpInvoiceTransfer->getCompanyBusinessUnit()->getIdCompanyBusinessUnit())
            ->setIdErpInvoice($entity->getIdErpInvoice())
            ->setCreatedAt($createdAt)
            ->setUpdatedAt(new DateTime())
            ->save();

        return $this->getFactory()
            ->createEntityToTransferMapper()
            ->fromErpInvoiceToTransfer($entity, $erpInvoiceTransfer);
    }

    /**
     * @param \Generated\Shared\Transfer\ErpInvoiceItemTransfer $invoiceItemTransfer
     *
     * @return \Generated\Shared\Transfer\ErpInvoiceItemTransfer
     */
    public function updateErpInvoiceItem(ErpInvoiceItemTransfer $invoiceItemTransfer): ErpInvoiceItemTransfer
    {
        $invoiceItemTransfer
            ->requireIdErpInvoiceItem()
            ->requireFkErpInvoice()
            ->requireSku()
            ->requireName();

        $entity = $this->findOrCreateErpInvoiceItem($invoiceItemTransfer->getFkErpInvoice(), $invoiceItemTransfer->getSku());
        $createdAt = $entity->getCreatedAt();
        $updatedAt = new DateTime();
        $entity->fromArray($invoiceItemTransfer->modifiedToArray());

        $entity
            ->setCreatedAt($createdAt)
            ->setUpdatedAt($updatedAt)
            ->save();

        return $this->getFactory()->createEntityToTransferMapper()->fromEprInvoiceItemToTransfer($entity);
    }

    /**
     * @param \Generated\Shared\Transfer\ErpInvoiceExpenseTransfer $invoiceExpenseTransfer
     *
     * @return \Generated\Shared\Transfer\ErpInvoiceExpenseTransfer
     */
    public function updateErpInvoiceExpense(ErpInvoiceExpenseTransfer $invoiceExpenseTransfer): ErpInvoiceExpenseTransfer
    {
        $invoiceExpenseTransfer
            ->requireIdErpInvoiceExpense()
            ->requireFkErpInvoice()
            ->requireName();

        $entity = $this->findOrCreateErpInvoiceExpense($invoiceExpenseTransfer->getFkErpInvoice(), $invoiceExpenseTransfer->getName());
        $createdAt = $entity->getCreatedAt();
        $updatedAt = new DateTime();
        $entity->fromArray($invoiceExpenseTransfer->modifiedToArray());

        $entity
            ->setCreatedAt($createdAt)
            ->setUpdatedAt($updatedAt)
            ->save();

        return $this->getFactory()->createEntityToTransferMapper()->fromEprInvoiceExpenseToTransfer($entity);
    }

    /**
     * @param int $idErpInvoice
     *
     * @return void
     */
    public function deleteErpInvoiceByIdErpInvoice(int $idErpInvoice): void
    {
        $invoice = $this->getFactory()->createErpInvoiceQuery()->findOneByIdErpInvoice($idErpInvoice);
        $items = $invoice->getFooErpInvoiceItems();

        foreach ($items as $item) {
            $item->delete();
        }

        $expenses = $invoice->getFooErpInvoiceExpenses();

        foreach ($expenses as $expense) {
            $expense->delete();
        }

        $addressIds = [
            $invoice->getFkBillingAddress(),
            $invoice->getFkShippingAddress(),
        ];

        $invoice->delete();

        $invoicesWithBilling = $this->getFactory()->createErpInvoiceQuery()->filterByFkBillingAddress_In($addressIds)->find();
        if (count($invoicesWithBilling) === 0 || empty($invoicesWithBilling->getData()) === true) {
            $this->getFactory()->createErpInvoiceAddressQuery()
                ->findOneByIdErpInvoiceAddress($addressIds[0])
                ->delete();
        }

        $invoicesWithShipping = $this->getFactory()->createErpInvoiceQuery()->filterByFkShippingAddress_In($addressIds)->find();
        if (count($invoicesWithShipping) === 0 || empty($invoicesWithShipping->getData()) === true) {
            $this->getFactory()->createErpInvoiceAddressQuery()
                ->findOneByIdErpInvoiceAddress($addressIds[1])
                ->delete();
        }
    }

    /**
     * @param int $idErpInvoiceItem
     *
     * @return void
     */
    public function deleteErpInvoiceItemByIdErpInvoiceItem(int $idErpInvoiceItem): void
    {
        $invoiceItem = $this->getFactory()->createErpInvoiceItemQuery()->findOneByIdErpInvoiceItem($idErpInvoiceItem);
        if ($invoiceItem === null) {
            return;
        }
        $invoiceItem->delete();
    }

    /**
     * @param int $idErpInvoiceExpense
     *
     * @return void
     */
    public function deleteErpInvoiceExpenseByIdErpInvoiceExpense(int $idErpInvoiceExpense): void
    {
        $invoiceExpense = $this->getFactory()->createErpInvoiceExpenseQuery()->findOneByIdErpInvoiceExpense($idErpInvoiceExpense);
        if ($invoiceExpense === null) {
            return;
        }
        $invoiceExpense->delete();
    }

    /**
     * @param int $idErpInvoiceAddress
     *
     * @return void
     */
    public function deleteErpInvoiceAddressByIdErpInvoiceAddress(int $idErpInvoiceAddress): void
    {
        $invoiceAddress = $this->getFactory()->createErpInvoiceAddressQuery()->findOneByIdErpInvoiceAddress($idErpInvoiceAddress);
        if ($invoiceAddress === null) {
            return;
        }
        $invoiceAddress->delete();
    }

    /**
     * @param \Generated\Shared\Transfer\ErpInvoiceAddressTransfer $erpInvoiceAddressTransfer
     *
     * @throws \Exception
     *
     * @return \Generated\Shared\Transfer\ErpInvoiceAddressTransfer
     */
    public function updateErpInvoiceAddress(ErpInvoiceAddressTransfer $erpInvoiceAddressTransfer): ErpInvoiceAddressTransfer
    {
        $erpInvoiceAddressTransfer->requireIdErpInvoiceAddress();

        $query = $this->getFactory()->createErpInvoiceAddressQuery();

        $entity = $query->findOneByIdErpInvoiceAddress($erpInvoiceAddressTransfer->getIdErpInvoiceAddress());

        if ($entity === null) {
            throw new Exception(sprintf(
                'Erp invoice address with id %s not found',
                $erpInvoiceAddressTransfer->getIdErpInvoiceAddress(),
            ));
        }
        $id = $entity->getIdErpInvoiceAddress();
        $createdAt = $entity->getCreatedAt();
        $updatedAt = new DateTime();
        $entity->fromArray($erpInvoiceAddressTransfer->toArray());
        $entity
            ->setIdErpInvoiceAddress($id)
            ->setCreatedAt($createdAt)
            ->setUpdatedAt($updatedAt)
            ->save();

        return $this->getFactory()->createEntityToTransferMapper()->fromErpInvoiceAddressToTransfer($entity);
    }

    /**
     * @param \Generated\Shared\Transfer\ErpInvoiceAmountTransfer $erpInvoiceAmountTransfer
     *
     * @throws \Exception
     *
     * @return \Generated\Shared\Transfer\ErpInvoiceAmountTransfer
     */
    public function updateErpInvoiceAmount(ErpInvoiceAmountTransfer $erpInvoiceAmountTransfer): ErpInvoiceAmountTransfer
    {
        $erpInvoiceAmountTransfer->requireIdErpInvoiceAmount();

        $query = $this->getFactory()->createErpInvoiceAmountQuery();

        $entity = $query->findOneByIdErpInvoiceAmount($erpInvoiceAmountTransfer->getIdErpInvoiceAmount());

        if ($entity === null) {
            throw new Exception(sprintf(
                'Erp invoice total with id %s not found',
                $erpInvoiceAmountTransfer->getIdErpInvoiceAmount(),
            ));
        }
        $id = $entity->getIdErpInvoiceAmount();
        $entity->fromArray($erpInvoiceAmountTransfer->toArray());
        $entity
            ->setIdErpInvoiceAmount($id)
            ->save();

        return $this->getFactory()->createEntityToTransferMapper()->fromErpInvoiceAmountToTransfer($entity);
    }

    /**
     * @param int $idErpInvoice
     * @param string $sku
     *
     * @return \Orm\Zed\ErpInvoice\Persistence\FooErpInvoiceItem
     */
    protected function findOrCreateErpInvoiceItem(int $idErpInvoice, string $sku): FooErpInvoiceItem
    {
        return $this->getFactory()->createErpInvoiceItemQuery()
            ->filterByFkErpInvoice($idErpInvoice)
            ->filterBySku($sku)
            ->findOneOrCreate();
    }

    /**
     * @param int $idErpInvoice
     * @param string $name
     *
     * @return \Orm\Zed\ErpInvoice\Persistence\FooErpInvoiceExpense
     */
    protected function findOrCreateErpInvoiceExpense(int $idErpInvoice, string $name): FooErpInvoiceExpense
    {
        return $this->getFactory()->createErpInvoiceExpenseQuery()
            ->filterByFkErpInvoice($idErpInvoice)
            ->filterByName($name)
            ->findOneOrCreate();
    }
}
