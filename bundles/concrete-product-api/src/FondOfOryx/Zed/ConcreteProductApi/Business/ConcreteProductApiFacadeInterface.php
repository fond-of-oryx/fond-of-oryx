<?php

namespace FondOfOryx\Zed\ConcreteProductApi\Business;

use Generated\Shared\Transfer\ApiCollectionTransfer;
use Generated\Shared\Transfer\ApiItemTransfer;
use Generated\Shared\Transfer\ApiRequestTransfer;

interface ConcreteProductApiFacadeInterface
{
    /**
     * Specification:
     * - Validate api data.
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\ApiRequestTransfer $apiRequestTransfer
     *
     * @return array<\Generated\Shared\Transfer\ApiValidationErrorTransfer>
     */
    public function validate(ApiRequestTransfer $apiRequestTransfer): array;

    /**
     * Specification:
     *  - Finds concrete product by product id.
     *  - Throws ConcreteProductNotFoundException if not found.
     *
     * @api
     *
     * @param int $id
     *
     * @return \Generated\Shared\Transfer\ApiItemTransfer
     */
    public function getConcreteProduct(int $id): ApiItemTransfer;

    /**
     * Specification:
     *  - Finds concrete products by filter transfer, including sort, conditions and pagination.
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\ApiRequestTransfer $apiRequestTransfer
     *
     * @return \Generated\Shared\Transfer\ApiCollectionTransfer
     */
    public function findConcreteProducts(ApiRequestTransfer $apiRequestTransfer): ApiCollectionTransfer;
}
