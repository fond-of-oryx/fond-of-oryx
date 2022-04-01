<?php

namespace FondOfOryx\Zed\GiftCardApi\Business\Model\Validator;

use Generated\Shared\Transfer\ApiDataTransfer;

class GiftCardApiValidator implements GiftCardApiValidatorInterface
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
