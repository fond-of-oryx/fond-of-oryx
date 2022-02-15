<?php

namespace FondOfOryx\Zed\ErpDeliveryNoteApi\Business\Validator;

use Generated\Shared\Transfer\ApiDataTransfer;

class ErpDeliveryNoteApiValidator implements ErpDeliveryNoteApiValidatorInterface
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
