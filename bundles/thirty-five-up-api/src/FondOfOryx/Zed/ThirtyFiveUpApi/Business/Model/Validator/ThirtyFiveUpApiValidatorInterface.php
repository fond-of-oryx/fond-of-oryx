<?php

namespace FondOfOryx\Zed\ThirtyFiveUpApi\Business\Model\Validator;

use Generated\Shared\Transfer\ApiRequestTransfer;

interface ThirtyFiveUpApiValidatorInterface
{
    /**
     * @param \Generated\Shared\Transfer\ApiRequestTransfer $apiRequestTransfer
     *
     * @return array<\Generated\Shared\Transfer\ApiValidationErrorTransfer>
     */
    public function validate(ApiRequestTransfer $apiRequestTransfer): array;
}
