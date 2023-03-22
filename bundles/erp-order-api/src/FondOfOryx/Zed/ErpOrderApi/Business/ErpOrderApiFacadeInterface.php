<?php

namespace FondOfOryx\Zed\ErpOrderApi\Business;

use Generated\Shared\Transfer\ApiCollectionTransfer;
use Generated\Shared\Transfer\ApiDataTransfer;
use Generated\Shared\Transfer\ApiItemTransfer;
use Generated\Shared\Transfer\ApiRequestTransfer;

interface ErpOrderApiFacadeInterface
{
    /**
     * Specification:
     * - Create new erp order
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\ApiDataTransfer $apiDataTransfer
     *
     * @return \Generated\Shared\Transfer\ApiItemTransfer
     */
    public function createErpOrder(ApiDataTransfer $apiDataTransfer): ApiItemTransfer;

    /**
     * Specification:
     * - Finds erp order by id.
     * - Throws HttpNotFoundException if not found.
     * - Update erp order data.
     *
     * @api
     *
     * @param int $idErpOrder
     * @param \Generated\Shared\Transfer\ApiDataTransfer $apiDataTransfer
     *
     * @return \Generated\Shared\Transfer\ApiItemTransfer
     */
    public function updateErpOrder(int $idErpOrder, ApiDataTransfer $apiDataTransfer): ApiItemTransfer;

    /**
     * Specification:
     *  - Finds erp order by id erp order.
     *  - Throws HttpNotFoundException if not found.
     *
     * @api
     *
     * @param int $idErpOrder
     *
     * @return \Generated\Shared\Transfer\ApiItemTransfer
     */
    public function getErpOrder(int $idErpOrder): ApiItemTransfer;

    /**
     * Specification:
     *  - Finds erp orders by filter transfer, including sort, conditions and pagination.
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\ApiRequestTransfer $apiRequestTransfer
     *
     * @return \Generated\Shared\Transfer\ApiCollectionTransfer
     */
    public function findErpOrders(ApiRequestTransfer $apiRequestTransfer): ApiCollectionTransfer;

    /**
     * Specification:
     *  - Finds erp order by id erp order.
     *  - Throws HttpNotFoundException if not found.
     *  - Deletes erp order
     *
     * @api
     *
     * @param int $idErpOrder
     *
     * @return \Generated\Shared\Transfer\ApiItemTransfer
     */
    public function deleteErpOrder(int $idErpOrder): ApiItemTransfer;

    /**
     * Specification:
     * - Validate erp order api data.
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\ApiRequestTransfer $apiRequestTransfer
     *
     * @return array<\Generated\Shared\Transfer\ApiValidationErrorTransfer>
     */
    public function validateErpOrder(ApiRequestTransfer $apiRequestTransfer): array;
}
