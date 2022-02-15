<?php

namespace FondOfOryx\Zed\ErpDeliveryNote\Persistence;

use Generated\Shared\Transfer\ErpDeliveryNoteAddressTransfer;
use Generated\Shared\Transfer\ErpDeliveryNoteExpenseCollectionTransfer;
use Generated\Shared\Transfer\ErpDeliveryNoteExpenseTransfer;
use Generated\Shared\Transfer\ErpDeliveryNoteItemCollectionTransfer;
use Generated\Shared\Transfer\ErpDeliveryNoteItemTransfer;
use Generated\Shared\Transfer\ErpDeliveryNoteTransfer;

interface ErpDeliveryNoteRepositoryInterface
{
    /**
     * @param int $idErpDeliveryNote
     *
     * @return \Generated\Shared\Transfer\ErpDeliveryNoteTransfer|null
     */
    public function findErpDeliveryNoteByIdErpDeliveryNote(int $idErpDeliveryNote): ?ErpDeliveryNoteTransfer;

    /**
     * @param string $erpDeliveryNoteExternalReference
     *
     * @return \Generated\Shared\Transfer\ErpDeliveryNoteTransfer|null
     */
    public function findErpDeliveryNoteByExternalReference(string $erpDeliveryNoteExternalReference): ?ErpDeliveryNoteTransfer;

    /**
     * @param int $idErpDeliveryNote
     *
     * @return \Generated\Shared\Transfer\ErpDeliveryNoteItemCollectionTransfer
     */
    public function findErpDeliveryNoteItemsByIdErpDeliveryNote(int $idErpDeliveryNote): ErpDeliveryNoteItemCollectionTransfer;

    /**
     * @param int $idErpDeliveryNoteItem
     *
     * @return \Generated\Shared\Transfer\ErpDeliveryNoteItemTransfer|null
     */
    public function findErpDeliveryNoteItemByIdErpDeliveryNoteItem(int $idErpDeliveryNoteItem): ?ErpDeliveryNoteItemTransfer;

    /**
     * @param int $idErpDeliveryNote
     *
     * @return \Generated\Shared\Transfer\ErpDeliveryNoteExpenseCollectionTransfer
     */
    public function findErpDeliveryNoteExpensesByIdErpDeliveryNote(int $idErpDeliveryNote): ErpDeliveryNoteExpenseCollectionTransfer;

    /**
     * @param int $idErpDeliveryNoteExpense
     *
     * @return \Generated\Shared\Transfer\ErpDeliveryNoteExpenseTransfer|null
     */
    public function findErpDeliveryNoteExpenseByIdErpDeliveryNoteExpense(int $idErpDeliveryNoteExpense): ?ErpDeliveryNoteExpenseTransfer;

    /**
     * @param int $idErpDeliveryNoteAddress
     *
     * @return \Generated\Shared\Transfer\ErpDeliveryNoteAddressTransfer|null
     */
    public function findErpDeliveryNoteAddressByIdErpDeliveryNoteAddress(int $idErpDeliveryNoteAddress): ?ErpDeliveryNoteAddressTransfer;
}
