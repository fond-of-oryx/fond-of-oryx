<?php

namespace FondOfOryx\Zed\ErpDeliveryNoteApi\Business\Validator;

use Generated\Shared\Transfer\ApiRequestTransfer;

interface ErpDeliveryNoteApiValidatorInterface
{
    /**
     * @param \Generated\Shared\Transfer\ApiRequestTransfer $apiRequestTransfer
     *
     * @return array<\Generated\Shared\Transfer\ApiValidationErrorTransfer>
     */
    public function validate(ApiRequestTransfer $apiRequestTransfer): array;
}
