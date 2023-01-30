<?php

namespace FondOfOryx\Zed\ErpOrderApi\Business\Validator;

use Generated\Shared\Transfer\ApiRequestTransfer;

interface ErpOrderApiValidatorInterface
{
    /**
     * @param \Generated\Shared\Transfer\ApiRequestTransfer $apiRequestTransfer
     *
     * @return array<\Generated\Shared\Transfer\ApiValidationErrorTransfer>
     */
    public function validate(ApiRequestTransfer $apiRequestTransfer): array;
}
