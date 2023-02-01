<?php

namespace FondOfOryx\Zed\GiftCardApi\Business\Model\Validator;

use Generated\Shared\Transfer\ApiRequestTransfer;

class GiftCardApiValidator implements GiftCardApiValidatorInterface
{
    /**
     * @param \Generated\Shared\Transfer\ApiRequestTransfer $apiRequestTransfer
     *
     * @return array<\Generated\Shared\Transfer\ApiValidationErrorTransfer>
     */
    public function validate(ApiRequestTransfer $apiRequestTransfer): array
    {
        return [];
    }
}
