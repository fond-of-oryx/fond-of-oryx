<?php

namespace FondOfOryx\Zed\ErpInvoice\Persistence;

use Generated\Shared\Transfer\ErpInvoiceAddressTransfer;
use Generated\Shared\Transfer\ErpInvoiceAmountTransfer;
use Generated\Shared\Transfer\ErpInvoiceItemCollectionTransfer;
use Generated\Shared\Transfer\ErpInvoiceItemTransfer;
use Generated\Shared\Transfer\ErpInvoiceTransfer;

interface ErpInvoiceRepositoryInterface
{
    /**
     * @param int $idErpInvoice
     *
     * @return \Generated\Shared\Transfer\ErpInvoiceTransfer|null
     */
    public function findErpInvoiceByIdErpInvoice(int $idErpInvoice): ?ErpInvoiceTransfer;

    /**
     * @param string $erpInvoiceExternalReference
     *
     * @return \Generated\Shared\Transfer\ErpInvoiceTransfer|null
     */
    public function findErpInvoiceByExternalReference(string $erpInvoiceExternalReference): ?ErpInvoiceTransfer;

    /**
     * @param int $idErpInvoice
     *
     * @return \Generated\Shared\Transfer\ErpInvoiceItemCollectionTransfer
     */
    public function findErpInvoiceItemsByIdErpInvoice(int $idErpInvoice): ErpInvoiceItemCollectionTransfer;

    /**
     * @param int $idErpInvoiceItem
     *
     * @return \Generated\Shared\Transfer\ErpInvoiceItemTransfer|null
     */
    public function findErpInvoiceItemByIdErpInvoiceItem(int $idErpInvoiceItem): ?ErpInvoiceItemTransfer;

    /**
     * @param int $idErpInvoiceAddress
     *
     * @return \Generated\Shared\Transfer\ErpInvoiceAddressTransfer|null
     */
    public function findErpInvoiceAddressByIdErpInvoiceAddress(int $idErpInvoiceAddress): ?ErpInvoiceAddressTransfer;

    /**
     * @param int $idErpInvoiceAmount
     *
     * @return \Generated\Shared\Transfer\ErpInvoiceAmountTransfer|null
     */
    public function findErpInvoiceAmountByIdErpInvoiceAmount(int $idErpInvoiceAmount): ?ErpInvoiceAmountTransfer;
}
