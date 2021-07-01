<?php

namespace FondOfOryx\Zed\ThirtyFiveUpApi\Business\Model\Validator;

use Generated\Shared\Transfer\ApiDataTransfer;

class ThirtyFiveUpApiValidator implements ThirtyFiveUpApiValidatorInterface
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
