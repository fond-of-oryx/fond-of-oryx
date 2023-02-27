<?php

namespace FondOfOryx\Zed\ErpDeliveryNote\Persistence;

use Generated\Shared\Transfer\ErpDeliveryNoteAddressTransfer;
use Generated\Shared\Transfer\ErpDeliveryNoteExpenseTransfer;
use Generated\Shared\Transfer\ErpDeliveryNoteItemTransfer;
use Generated\Shared\Transfer\ErpDeliveryNoteTrackingTransfer;
use Generated\Shared\Transfer\ErpDeliveryNoteTransfer;

interface ErpDeliveryNoteEntityManagerInterface
{
    /**
     * @param \Generated\Shared\Transfer\ErpDeliveryNoteTransfer $erpDeliveryNoteTransfer
     *
     * @throws \Exception
     *
     * @return \Generated\Shared\Transfer\ErpDeliveryNoteTransfer
     */
    public function createErpDeliveryNote(ErpDeliveryNoteTransfer $erpDeliveryNoteTransfer): ErpDeliveryNoteTransfer;

    /**
     * @param \Generated\Shared\Transfer\ErpDeliveryNoteAddressTransfer $deliveryNoteAddressTransfer
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return \Generated\Shared\Transfer\ErpDeliveryNoteAddressTransfer
     */
    public function createErpDeliveryNoteAddress(ErpDeliveryNoteAddressTransfer $deliveryNoteAddressTransfer): ErpDeliveryNoteAddressTransfer;

    /**
     * @param \Generated\Shared\Transfer\ErpDeliveryNoteItemTransfer $itemTransfer
     *
     * @throws \Exception
     *
     * @return \Generated\Shared\Transfer\ErpDeliveryNoteItemTransfer
     */
    public function createErpDeliveryNoteItem(ErpDeliveryNoteItemTransfer $itemTransfer): ErpDeliveryNoteItemTransfer;

    /**
     * @param \Generated\Shared\Transfer\ErpDeliveryNoteExpenseTransfer $itemTransfer
     *
     * @return \Generated\Shared\Transfer\ErpDeliveryNoteExpenseTransfer
     */
    public function createErpDeliveryNoteExpense(ErpDeliveryNoteExpenseTransfer $itemTransfer): ErpDeliveryNoteExpenseTransfer;

    /**
     * @param \Generated\Shared\Transfer\ErpDeliveryNoteTrackingTransfer $trackingTransfer
     *
     * @throws \Propel\Runtime\Exception\PropelException
     * @throws \Spryker\Shared\Kernel\Transfer\Exception\RequiredTransferPropertyException
     *
     * @return \Generated\Shared\Transfer\ErpDeliveryNoteTrackingTransfer
     */
    public function createErpDeliveryNoteTracking(ErpDeliveryNoteTrackingTransfer $trackingTransfer): ErpDeliveryNoteTrackingTransfer;

    /**
     * @param \Generated\Shared\Transfer\ErpDeliveryNoteTransfer $erpDeliveryNoteTransfer
     *
     * @throws \Exception
     *
     * @return \Generated\Shared\Transfer\ErpDeliveryNoteTransfer
     */
    public function updateErpDeliveryNote(ErpDeliveryNoteTransfer $erpDeliveryNoteTransfer): ErpDeliveryNoteTransfer;

    /**
     * @param \Generated\Shared\Transfer\ErpDeliveryNoteItemTransfer $deliveryNoteItemTransfer
     *
     * @throws \Propel\Runtime\Exception\PropelException
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     *
     * @return \Generated\Shared\Transfer\ErpDeliveryNoteItemTransfer
     */
    public function updateErpDeliveryNoteItem(ErpDeliveryNoteItemTransfer $deliveryNoteItemTransfer): ErpDeliveryNoteItemTransfer;

    /**
     * @param \Generated\Shared\Transfer\ErpDeliveryNoteExpenseTransfer $deliveryNoteExpenseTransfer
     *
     * @return \Generated\Shared\Transfer\ErpDeliveryNoteExpenseTransfer
     */
    public function updateErpDeliveryNoteExpense(ErpDeliveryNoteExpenseTransfer $deliveryNoteExpenseTransfer): ErpDeliveryNoteExpenseTransfer;

    /**
     * @param \Generated\Shared\Transfer\ErpDeliveryNoteTrackingTransfer $deliveryNoteTrackingTransfer
     *
     * @return \Generated\Shared\Transfer\ErpDeliveryNoteTrackingTransfer
     */
    public function updateErpDeliveryNoteTracking(ErpDeliveryNoteTrackingTransfer $deliveryNoteTrackingTransfer): ErpDeliveryNoteTrackingTransfer;

    /**
     * @param int $idTracking
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return void
     */
    public function deleteTrackingToItemRelationsByIdTracking(int $idTracking): void;

    /**
     * @param string $trackingNumber
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return void
     */
    public function deleteTrackingToItemRelationsByTrackingNumber(string $trackingNumber): void;

    /**
     * @param \Generated\Shared\Transfer\ErpDeliveryNoteAddressTransfer $erpDeliveryNoteAddressTransfer
     *
     * @return \Generated\Shared\Transfer\ErpDeliveryNoteAddressTransfer
     */
    public function updateErpDeliveryNoteAddress(ErpDeliveryNoteAddressTransfer $erpDeliveryNoteAddressTransfer): ErpDeliveryNoteAddressTransfer;

    /**
     * @param int $idErpDeliveryNote
     *
     * @return void
     */
    public function deleteErpDeliveryNoteByIdErpDeliveryNote(int $idErpDeliveryNote): void;

    /**
     * @param int $idErpDeliveryNoteItem
     *
     * @return void
     */
    public function deleteErpDeliveryNoteItemByIdErpDeliveryNoteItem(int $idErpDeliveryNoteItem): void;

    /**
     * @param int $idErpDeliveryNoteExpense
     *
     * @return void
     */
    public function deleteErpDeliveryNoteExpenseByIdErpDeliveryNoteExpense(int $idErpDeliveryNoteExpense): void;

    /**
     * @param int $idErpDeliveryNoteTracking
     *
     * @return void
     */
    public function deleteErpDeliveryNoteTrackingByIdErpDeliveryNoteTracking(int $idErpDeliveryNoteTracking): void;

    /**
     * @param int $idErpDeliveryNoteTracking
     *
     * @return void
     */
    public function deleteErpDeliveryNoteTrackingRelationsByIdErpDeliveryNoteTracking(int $idErpDeliveryNoteTracking): void;

    /**
     * @param int $idErpDeliveryNoteAddress
     *
     * @return void
     */
    public function deleteErpDeliveryNoteAddressByIdErpDeliveryNoteAddress(int $idErpDeliveryNoteAddress): void;
}
