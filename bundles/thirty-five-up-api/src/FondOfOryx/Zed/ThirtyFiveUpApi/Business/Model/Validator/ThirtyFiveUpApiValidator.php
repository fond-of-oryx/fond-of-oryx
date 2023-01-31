<?php

namespace FondOfOryx\Zed\ThirtyFiveUpApi\Business\Model\Validator;

use Generated\Shared\Transfer\ApiRequestTransfer;

class ThirtyFiveUpApiValidator implements ThirtyFiveUpApiValidatorInterface
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
