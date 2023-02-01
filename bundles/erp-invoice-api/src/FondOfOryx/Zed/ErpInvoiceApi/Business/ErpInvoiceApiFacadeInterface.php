<?php

namespace FondOfOryx\Zed\ErpInvoiceApi\Business;

use Generated\Shared\Transfer\ApiCollectionTransfer;
use Generated\Shared\Transfer\ApiDataTransfer;
use Generated\Shared\Transfer\ApiItemTransfer;
use Generated\Shared\Transfer\ApiRequestTransfer;

interface ErpInvoiceApiFacadeInterface
{
    /**
     * Specification:
     * - Create new erp invoice
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\ApiDataTransfer $apiDataTransfer
     *
     * @return \Generated\Shared\Transfer\ApiItemTransfer
     */
    public function createErpInvoice(ApiDataTransfer $apiDataTransfer): ApiItemTransfer;

    /**
     * Specification:
     * - Finds erp invoice by id.
     * - Throws HttpNotFoundException if not found.
     * - Update erp invoice data.
     *
     * @api
     *
     * @param int $idErpInvoice
     * @param \Generated\Shared\Transfer\ApiDataTransfer $apiDataTransfer
     *
     * @return \Generated\Shared\Transfer\ApiItemTransfer
     */
    public function updateErpInvoice(int $idErpInvoice, ApiDataTransfer $apiDataTransfer): ApiItemTransfer;

    /**
     * Specification:
     *  - Finds erp invoice by id erp invoice.
     *  - Throws HttpNotFoundException if not found.
     *
     * @api
     *
     * @param int $idErpInvoice
     *
     * @return \Generated\Shared\Transfer\ApiItemTransfer
     */
    public function getErpInvoice(int $idErpInvoice): ApiItemTransfer;

    /**
     * Specification:
     *  - Finds erp invoices by filter transfer, including sort, conditions and pagination.
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\ApiRequestTransfer $apiRequestTransfer
     *
     * @return \Generated\Shared\Transfer\ApiCollectionTransfer
     */
    public function findErpInvoices(ApiRequestTransfer $apiRequestTransfer): ApiCollectionTransfer;

    /**
     * Specification:
     *  - Finds erp invoice by id erp invoice.
     *  - Throws HttpNotFoundException if not found.
     *  - Deletes erp invoice
     *
     * @api
     *
     * @param int $idErpInvoice
     *
     * @return \Generated\Shared\Transfer\ApiItemTransfer
     */
    public function deleteErpInvoice(int $idErpInvoice): ApiItemTransfer;

    /**
     * Specification:
     * - Validate erp invoice api data.
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\ApiRequestTransfer $apiRequestTransfer
     *
     * @return array<\Generated\Shared\Transfer\ApiValidationErrorTransfer>
     */
    public function validateErpInvoice(ApiRequestTransfer $apiRequestTransfer): array;
}
