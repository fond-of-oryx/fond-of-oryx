<?php

namespace FondOfOryx\Zed\ErpInvoice\Persistence\Propel\Mapper;

use Generated\Shared\Transfer\ErpInvoiceAddressTransfer;
use Generated\Shared\Transfer\ErpInvoiceAmountTransfer;
use Generated\Shared\Transfer\ErpInvoiceItemTransfer;
use Generated\Shared\Transfer\ErpInvoiceTransfer;
use Orm\Zed\ErpInvoice\Persistence\FooErpInvoice;
use Orm\Zed\ErpInvoice\Persistence\FooErpInvoiceAddress;
use Orm\Zed\ErpInvoice\Persistence\FooErpInvoiceAmount;
use Orm\Zed\ErpInvoice\Persistence\FooErpInvoiceItem;

interface EntityToTransferMapperInterface
{
    /**
     * @param \Orm\Zed\ErpInvoice\Persistence\FooErpInvoiceItem $invoiceItem
     * @param \Generated\Shared\Transfer\ErpInvoiceItemTransfer|null $invoiceItemTransfer
     *
     * @return \Generated\Shared\Transfer\ErpInvoiceItemTransfer
     */
    public function fromEprInvoiceItemToTransfer(
        FooErpInvoiceItem $invoiceItem,
        ?ErpInvoiceItemTransfer $invoiceItemTransfer = null
    ): ErpInvoiceItemTransfer;

    /**
     * @param \Orm\Zed\ErpInvoice\Persistence\FooErpInvoice $erpInvoice
     * @param \Generated\Shared\Transfer\ErpInvoiceTransfer|null $erpInvoiceTransfer
     *
     * @return \Generated\Shared\Transfer\ErpInvoiceTransfer
     */
    public function fromErpInvoiceToTransfer(
        FooErpInvoice $erpInvoice,
        ?ErpInvoiceTransfer $erpInvoiceTransfer = null
    ): ErpInvoiceTransfer;

    /**
     * @param \Orm\Zed\ErpInvoice\Persistence\FooErpInvoiceAddress $erpInvoiceAddress
     * @param \Generated\Shared\Transfer\ErpInvoiceAddressTransfer|null $erpInvoiceAddressTransfer
     *
     * @throws \Exception
     *
     * @return \Generated\Shared\Transfer\ErpInvoiceAddressTransfer
     */
    public function fromErpInvoiceAddressToTransfer(
        FooErpInvoiceAddress $erpInvoiceAddress,
        ?ErpInvoiceAddressTransfer $erpInvoiceAddressTransfer = null
    ): ErpInvoiceAddressTransfer;

    /**
     * @param \Orm\Zed\ErpInvoice\Persistence\FooErpInvoiceAmount $erpInvoiceTotal
     * @param \Generated\Shared\Transfer\ErpInvoiceAmountTransfer|null $erpInvoiceTotalTransfer
     *
     * @return \Generated\Shared\Transfer\ErpInvoiceAmountTransfer
     */
    public function fromErpInvoiceAmountToTransfer(
        FooErpInvoiceAmount $erpInvoiceTotal,
        ?ErpInvoiceAmountTransfer $erpInvoiceTotalTransfer = null
    ): ErpInvoiceAmountTransfer;
}
