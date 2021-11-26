<?php

namespace FondOfOryx\Zed\ErpInvoice\Persistence;

use Generated\Shared\Transfer\ErpInvoiceAddressTransfer;
use Generated\Shared\Transfer\ErpInvoiceAmountTransfer;
use Generated\Shared\Transfer\ErpInvoiceExpenseTransfer;
use Generated\Shared\Transfer\ErpInvoiceItemTransfer;
use Generated\Shared\Transfer\ErpInvoiceTransfer;

interface ErpInvoiceEntityManagerInterface
{
    /**
     * @param \Generated\Shared\Transfer\ErpInvoiceTransfer $erpInvoiceTransfer
     *
     * @throws \Exception
     *
     * @return \Generated\Shared\Transfer\ErpInvoiceTransfer
     */
    public function createErpInvoice(ErpInvoiceTransfer $erpInvoiceTransfer): ErpInvoiceTransfer;

    /**
     * @param \Generated\Shared\Transfer\ErpInvoiceAddressTransfer $invoiceAddressTransfer
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return \Generated\Shared\Transfer\ErpInvoiceAddressTransfer
     */
    public function createErpInvoiceAddress(ErpInvoiceAddressTransfer $invoiceAddressTransfer): ErpInvoiceAddressTransfer;

    /**
     * @param \Generated\Shared\Transfer\ErpInvoiceAmountTransfer $invoiceAmountTransfer
     *
     * @return \Generated\Shared\Transfer\ErpInvoiceAmountTransfer
     */
    public function createErpInvoiceAmount(ErpInvoiceAmountTransfer $invoiceAmountTransfer): ErpInvoiceAmountTransfer;

    /**
     * @param \Generated\Shared\Transfer\ErpInvoiceItemTransfer $itemTransfer
     *
     * @throws \Exception
     *
     * @return \Generated\Shared\Transfer\ErpInvoiceItemTransfer
     */
    public function createErpInvoiceItem(ErpInvoiceItemTransfer $itemTransfer): ErpInvoiceItemTransfer;

    /**
     * @param \Generated\Shared\Transfer\ErpInvoiceExpenseTransfer $itemTransfer
     *
     * @return \Generated\Shared\Transfer\ErpInvoiceExpenseTransfer
     */
    public function createErpInvoiceExpense(ErpInvoiceExpenseTransfer $itemTransfer): ErpInvoiceExpenseTransfer;

    /**
     * @param \Generated\Shared\Transfer\ErpInvoiceTransfer $erpInvoiceTransfer
     *
     * @throws \Exception
     *
     * @return \Generated\Shared\Transfer\ErpInvoiceTransfer
     */
    public function updateErpInvoice(ErpInvoiceTransfer $erpInvoiceTransfer): ErpInvoiceTransfer;

    /**
     * @param \Generated\Shared\Transfer\ErpInvoiceItemTransfer $invoiceItemTransfer
     *
     * @throws \Propel\Runtime\Exception\PropelException
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     *
     * @return \Generated\Shared\Transfer\ErpInvoiceItemTransfer
     */
    public function updateErpInvoiceItem(ErpInvoiceItemTransfer $invoiceItemTransfer): ErpInvoiceItemTransfer;

    /**
     * @param \Generated\Shared\Transfer\ErpInvoiceExpenseTransfer $invoiceExpenseTransfer
     *
     * @return \Generated\Shared\Transfer\ErpInvoiceExpenseTransfer
     */
    public function updateErpInvoiceExpense(ErpInvoiceExpenseTransfer $invoiceExpenseTransfer): ErpInvoiceExpenseTransfer;

    /**
     * @param \Generated\Shared\Transfer\ErpInvoiceAddressTransfer $erpInvoiceAddressTransfer
     *
     * @return \Generated\Shared\Transfer\ErpInvoiceAddressTransfer
     */
    public function updateErpInvoiceAddress(ErpInvoiceAddressTransfer $erpInvoiceAddressTransfer): ErpInvoiceAddressTransfer;

    /**
     * @param \Generated\Shared\Transfer\ErpInvoiceAmountTransfer $erpInvoiceAmountTransfer
     *
     * @throws \Exception
     *
     * @return \Generated\Shared\Transfer\ErpInvoiceAmountTransfer
     */
    public function updateErpInvoiceAmount(ErpInvoiceAmountTransfer $erpInvoiceAmountTransfer): ErpInvoiceAmountTransfer;

    /**
     * @param int $idErpInvoice
     *
     * @return void
     */
    public function deleteErpInvoiceByIdErpInvoice(int $idErpInvoice): void;

    /**
     * @param int $idErpInvoiceItem
     *
     * @return void
     */
    public function deleteErpInvoiceItemByIdErpInvoiceItem(int $idErpInvoiceItem): void;

    /**
     * @param int $idErpInvoiceExpense
     *
     * @return void
     */
    public function deleteErpInvoiceExpenseByIdErpInvoiceExpense(int $idErpInvoiceExpense): void;

    /**
     * @param int $idErpInvoiceAddress
     *
     * @return void
     */
    public function deleteErpInvoiceAddressByIdErpInvoiceAddress(int $idErpInvoiceAddress): void;
}
