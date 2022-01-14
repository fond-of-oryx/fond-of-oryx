<?php

namespace FondOfOryx\Zed\StockApi\Business\Model\Validator;

use Generated\Shared\Transfer\ApiDataTransfer;

interface StockApiValidatorInterface
{
    /**
     * @param \Generated\Shared\Transfer\ApiDataTransfer $apiDataTransfer
     *
     * @throws \Spryker\Zed\Api\Business\Exception\ApiValidationException
     *
     * @return array<\Generated\Shared\Transfer\ApiValidationErrorTransfer>
     */
    public function validate(ApiDataTransfer $apiDataTransfer): array;
}
