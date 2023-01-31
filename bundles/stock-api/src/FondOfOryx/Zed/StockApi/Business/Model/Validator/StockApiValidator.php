<?php

namespace FondOfOryx\Zed\StockApi\Business\Model\Validator;

use Generated\Shared\Transfer\ApiRequestTransfer;

class StockApiValidator implements StockApiValidatorInterface
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
