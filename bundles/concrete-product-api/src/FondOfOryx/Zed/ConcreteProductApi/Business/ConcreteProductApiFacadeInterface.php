<?php

namespace FondOfOryx\Zed\ConcreteProductApi\Business;

use Generated\Shared\Transfer\ApiCollectionTransfer;
use Generated\Shared\Transfer\ApiDataTransfer;
use Generated\Shared\Transfer\ApiItemTransfer;
use Generated\Shared\Transfer\ApiRequestTransfer;

interface ConcreteProductApiFacadeInterface
{
    /**
     * Specification:
     * - Validate api data.
     *
     * @param \Generated\Shared\Transfer\ApiDataTransfer $apiDataTransfer
     *
     * @return array
     */
    public function validate(ApiDataTransfer $apiDataTransfer): array;

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
    public function findConditionalProducts(ApiRequestTransfer $apiRequestTransfer): ApiCollectionTransfer;
}
