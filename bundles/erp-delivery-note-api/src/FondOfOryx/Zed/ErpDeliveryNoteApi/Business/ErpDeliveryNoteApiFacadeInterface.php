<?php

namespace FondOfOryx\Zed\ErpDeliveryNoteApi\Business;

use Generated\Shared\Transfer\ApiCollectionTransfer;
use Generated\Shared\Transfer\ApiDataTransfer;
use Generated\Shared\Transfer\ApiItemTransfer;
use Generated\Shared\Transfer\ApiRequestTransfer;

interface ErpDeliveryNoteApiFacadeInterface
{
    /**
     * Specification:
     * - Create new erp delivery note
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\ApiDataTransfer $apiDataTransfer
     *
     * @return \Generated\Shared\Transfer\ApiItemTransfer
     */
    public function createErpDeliveryNote(ApiDataTransfer $apiDataTransfer): ApiItemTransfer;

    /**
     * Specification:
     * - Finds erp delivery note by id.
     * - Throws HttpNotFoundException if not found.
     * - Update erp delivery note data.
     *
     * @api
     *
     * @param int $idErpDeliveryNote
     * @param \Generated\Shared\Transfer\ApiDataTransfer $apiDataTransfer
     *
     * @return \Generated\Shared\Transfer\ApiItemTransfer
     */
    public function updateErpDeliveryNote(int $idErpDeliveryNote, ApiDataTransfer $apiDataTransfer): ApiItemTransfer;

    /**
     * Specification:
     *  - Finds erp delivery note by id erp delivery note.
     *  - Throws HttpNotFoundException if not found.
     *
     * @api
     *
     * @param int $idErpDeliveryNote
     *
     * @return \Generated\Shared\Transfer\ApiItemTransfer
     */
    public function getErpDeliveryNote(int $idErpDeliveryNote): ApiItemTransfer;

    /**
     * Specification:
     *  - Finds erp delivery notes by filter transfer, including sort, conditions and pagination.
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\ApiRequestTransfer $apiRequestTransfer
     *
     * @return \Generated\Shared\Transfer\ApiCollectionTransfer
     */
    public function findErpDeliveryNotes(ApiRequestTransfer $apiRequestTransfer): ApiCollectionTransfer;

    /**
     * Specification:
     *  - Finds erp delivery note by id erp delivery note.
     *  - Throws HttpNotFoundException if not found.
     *  - Deletes erp delivery note
     *
     * @api
     *
     * @param int $idErpDeliveryNote
     *
     * @return \Generated\Shared\Transfer\ApiItemTransfer
     */
    public function deleteErpDeliveryNote(int $idErpDeliveryNote): ApiItemTransfer;

    /**
     * Specification:
     * - Validate erp delivery note api data.
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\ApiDataTransfer $apiDataTransfer
     *
     * @return array
     */
    public function validateErpDeliveryNote(ApiDataTransfer $apiDataTransfer): array;
}
