<?php

namespace FondOfOryx\Zed\ErpInvoiceApi\Business\Validator;

use Generated\Shared\Transfer\ApiRequestTransfer;

interface ErpInvoiceApiValidatorInterface
{
    /**
     * @param \Generated\Shared\Transfer\ApiRequestTransfer $apiRequestTransfer
     *
     * @return array<\Generated\Shared\Transfer\ApiValidationErrorTransfer>
     */
    public function validate(ApiRequestTransfer $apiRequestTransfer): array;
}
