<?php

namespace FondOfOryx\Zed\StockApi\Business\Model\Validator;

use Generated\Shared\Transfer\ApiRequestTransfer;

interface StockApiValidatorInterface
{
    /**
     * @param \Generated\Shared\Transfer\ApiRequestTransfer $apiRequestTransfer
     *
     * @return array<\Generated\Shared\Transfer\ApiValidationErrorTransfer>
     */
    public function validate(ApiRequestTransfer $apiRequestTransfer): array;
}
