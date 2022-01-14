<?php

namespace FondOfOryx\Zed\StockApi\Business\Model\Validator;

use Generated\Shared\Transfer\ApiDataTransfer;

class StockApiValidator implements StockApiValidatorInterface
{
    /**
     * @param \Generated\Shared\Transfer\ApiDataTransfer $apiDataTransfer
     *
     * @return array<\Generated\Shared\Transfer\ApiValidationErrorTransfer>
     */
    public function validate(ApiDataTransfer $apiDataTransfer): array
    {
        return [];
    }
}
