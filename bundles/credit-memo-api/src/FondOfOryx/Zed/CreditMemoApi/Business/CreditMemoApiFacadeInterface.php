<?php

namespace FondOfOryx\Zed\CreditMemoApi\Business;

use Generated\Shared\Transfer\ApiDataTransfer;
use Generated\Shared\Transfer\ApiItemTransfer;

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
     * @param \Generated\Shared\Transfer\ApiDataTransfer $apiDataTransfer
     *
     * @return array
     */
    public function validate(ApiDataTransfer $apiDataTransfer): array;
}
