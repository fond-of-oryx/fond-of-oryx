<?php

namespace FondOfOryx\Zed\InvoiceApi\Business\Model\Validator;

use Generated\Shared\Transfer\ApiRequestTransfer;

interface InvoiceApiValidatorInterface
{
 /**
  * @param \Generated\Shared\Transfer\ApiRequestTransfer $apiRequestTransfer
  *
  * @return array<\Generated\Shared\Transfer\ApiValidationErrorTransfer>
  */
    public function validate(ApiRequestTransfer $apiRequestTransfer): array;
}
