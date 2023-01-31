<?php

namespace FondOfOryx\Zed\CreditMemoApi\Business\Model\Validator;

use Generated\Shared\Transfer\ApiRequestTransfer;

class CreditMemoApiValidator implements CreditMemoApiValidatorInterface
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
