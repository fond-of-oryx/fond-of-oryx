<?php

namespace FondOfOryx\Zed\GiftCardApi\Business\Model\Validator;

use Generated\Shared\Transfer\ApiDataTransfer;

interface GiftCardApiValidatorInterface
{
    /**
     * @param \Generated\Shared\Transfer\ApiDataTransfer $apiDataTransfer
     *
     * @throws \Spryker\Zed\Api\Business\Exception\ApiValidationException
     *
     * @return array
     */
    public function validate(ApiDataTransfer $apiDataTransfer): array;
}
