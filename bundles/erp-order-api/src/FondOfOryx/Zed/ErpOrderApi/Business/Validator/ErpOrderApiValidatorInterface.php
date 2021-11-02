<?php

namespace FondOfOryx\Zed\ErpOrderApi\Business\Validator;

use Generated\Shared\Transfer\ApiDataTransfer;

interface ErpOrderApiValidatorInterface
{
    /**
     * @param \Generated\Shared\Transfer\ApiDataTransfer $apiDataTransfer
     *
     * @return array<string>
     */
    public function validate(ApiDataTransfer $apiDataTransfer): array;
}
