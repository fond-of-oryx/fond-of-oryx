<?php

namespace FondOfOryx\Zed\CreditMemoApi\Business\Model\Validator;

use Generated\Shared\Transfer\ApiDataTransfer;

class CreditMemoApiValidator implements CreditMemoApiValidatorInterface
{
    /**
     * @param \Generated\Shared\Transfer\ApiDataTransfer $apiDataTransfer
     *
     * @return array
     */
    public function validate(ApiDataTransfer $apiDataTransfer): array
    {
        return [];
    }
}
