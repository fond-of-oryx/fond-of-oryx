<?php

namespace FondOfOryx\Zed\ErpDeliveryNote\Persistence\Propel\Mapper;

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

interface EntityToTransferMapperInterface
{
    /**
     * @param \Orm\Zed\ErpDeliveryNote\Persistence\FooErpDeliveryNoteItem $deliveryNoteItem
     * @param \Generated\Shared\Transfer\ErpDeliveryNoteItemTransfer|null $deliveryNoteItemTransfer
     *
     * @return \Generated\Shared\Transfer\ErpDeliveryNoteItemTransfer
     */
    public function fromErpDeliveryNoteItemToTransfer(
        FooErpDeliveryNoteItem $deliveryNoteItem,
        ?ErpDeliveryNoteItemTransfer $deliveryNoteItemTransfer = null
    ): ErpDeliveryNoteItemTransfer;

    /**
     * @param \Orm\Zed\ErpDeliveryNote\Persistence\FooErpDeliveryNoteExpense $deliveryNoteExpense
     * @param \Generated\Shared\Transfer\ErpDeliveryNoteExpenseTransfer|null $deliveryNoteExpenseTransfer
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return \Generated\Shared\Transfer\ErpDeliveryNoteExpenseTransfer
     */
    public function fromErpDeliveryNoteExpenseToTransfer(
        FooErpDeliveryNoteExpense $deliveryNoteExpense,
        ?ErpDeliveryNoteExpenseTransfer $deliveryNoteExpenseTransfer = null
    ): ErpDeliveryNoteExpenseTransfer;

    /**
     * @param \Orm\Zed\ErpDeliveryNote\Persistence\FooErpDeliveryNoteTracking $deliveryNoteTracking
     * @param \Generated\Shared\Transfer\ErpDeliveryNoteTrackingTransfer|null $erpDeliveryNoteTrackingTransfer
     *
     * @return \Generated\Shared\Transfer\ErpDeliveryNoteTrackingTransfer
     * @throws \Exception
     */
    public function fromErpDeliveryNoteTrackingToTransfer(
        FooErpDeliveryNoteTracking $deliveryNoteTracking,
        ?ErpDeliveryNoteTrackingTransfer $erpDeliveryNoteTrackingTransfer = null
    ): ErpDeliveryNoteTrackingTransfer;

    /**
     * @param \Orm\Zed\ErpDeliveryNote\Persistence\FooErpDeliveryNote $erpDeliveryNote
     * @param \Generated\Shared\Transfer\ErpDeliveryNoteTransfer|null $erpDeliveryNoteTransfer
     *
     * @return \Generated\Shared\Transfer\ErpDeliveryNoteTransfer
     */
    public function fromErpDeliveryNoteToTransfer(
        FooErpDeliveryNote $erpDeliveryNote,
        ?ErpDeliveryNoteTransfer $erpDeliveryNoteTransfer = null
    ): ErpDeliveryNoteTransfer;

    /**
     * @param \Orm\Zed\ErpDeliveryNote\Persistence\FooErpDeliveryNoteAddress $erpDeliveryNoteAddress
     * @param \Generated\Shared\Transfer\ErpDeliveryNoteAddressTransfer|null $erpDeliveryNoteAddressTransfer
     *
     * @throws \Exception
     *
     * @return \Generated\Shared\Transfer\ErpDeliveryNoteAddressTransfer
     */
    public function fromErpDeliveryNoteAddressToTransfer(
        FooErpDeliveryNoteAddress $erpDeliveryNoteAddress,
        ?ErpDeliveryNoteAddressTransfer $erpDeliveryNoteAddressTransfer = null
    ): ErpDeliveryNoteAddressTransfer;
}
