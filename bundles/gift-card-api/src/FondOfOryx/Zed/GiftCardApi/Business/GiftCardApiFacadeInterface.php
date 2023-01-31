<?php

namespace FondOfOryx\Zed\GiftCardApi\Business;

use Generated\Shared\Transfer\ApiCollectionTransfer;
use Generated\Shared\Transfer\ApiRequestTransfer;

/**
 * @method \FondOfOryx\Zed\GiftCardApi\Business\GiftCardApiBusinessFactory getFactory()
 */
interface GiftCardApiFacadeInterface
{
    /**
     * Specification:
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\ApiRequestTransfer $apiRequestTransfer
     *
     * @return \Generated\Shared\Transfer\ApiCollectionTransfer
     */
    public function findGiftCard(ApiRequestTransfer $apiRequestTransfer): ApiCollectionTransfer;

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
