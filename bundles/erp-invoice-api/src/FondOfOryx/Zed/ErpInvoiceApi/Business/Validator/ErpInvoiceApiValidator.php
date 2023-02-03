<?php

namespace FondOfOryx\Zed\ErpInvoiceApi\Business\Validator;

use Generated\Shared\Transfer\ApiRequestTransfer;

class ErpInvoiceApiValidator implements ErpInvoiceApiValidatorInterface
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
