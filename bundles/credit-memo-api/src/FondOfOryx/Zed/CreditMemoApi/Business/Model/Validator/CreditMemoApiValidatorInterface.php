<?php

namespace FondOfOryx\Zed\CreditMemoApi\Business\Model\Validator;

use Generated\Shared\Transfer\ApiDataTransfer;

interface CreditMemoApiValidatorInterface
{
    /**
     * @param \Generated\Shared\Transfer\ApiDataTransfer $apiDataTransfer
     *
     * @throws \Spryker\Zed\Api\Business\Exception\ApiValidationException
     *
     * @return array
     */
    public function validate(ApiDataTransfer $apiDataTransfer): array;
}
