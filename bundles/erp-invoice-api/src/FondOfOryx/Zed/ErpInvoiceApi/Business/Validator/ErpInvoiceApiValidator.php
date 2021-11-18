<?php

namespace FondOfOryx\Zed\ErpInvoiceApi\Business\Validator;

use Generated\Shared\Transfer\ApiDataTransfer;

class ErpInvoiceApiValidator implements ErpInvoiceApiValidatorInterface
{
    /**
     * @param \Generated\Shared\Transfer\ApiDataTransfer $apiDataTransfer
     *
     * @return array<string>
     */
    public function validate(ApiDataTransfer $apiDataTransfer): array
    {
        return [];
    }
}
