<?php

namespace FondOfOryx\Zed\InvoiceApi\Business\Model\Validator;

use Generated\Shared\Transfer\ApiDataTransfer;

class InvoiceApiValidator implements InvoiceApiValidatorInterface
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
