<?php

namespace FondOfOryx\Zed\CreditMemoApi\Business;

use Generated\Shared\Transfer\ApiDataTransfer;
use Generated\Shared\Transfer\ApiItemTransfer;
use Generated\Shared\Transfer\ApiRequestTransfer;

/**
 * @method \FondOfOryx\Zed\CreditMemoApi\Business\CreditMemoApiBusinessFactory getFactory()
 */
interface CreditMemoApiFacadeInterface
{
    /**
     * Specification:
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\ApiDataTransfer $apiDataTransfer
     *
     * @return \Generated\Shared\Transfer\ApiItemTransfer
     */
    public function addCreditMemo(ApiDataTransfer $apiDataTransfer): ApiItemTransfer;

    /**
     * Specification:
     * - Validates the given API data and returns an array of errors if necessary.
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\ApiRequestTransfer $apiRequestTransfer
     *
     * @return array<\Generated\Shared\Transfer\ApiValidationErrorTransfer>
     */
    public function validate(ApiRequestTransfer $apiRequestTransfer): array;
}
