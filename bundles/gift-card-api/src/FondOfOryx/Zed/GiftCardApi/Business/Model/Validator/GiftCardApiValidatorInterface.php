<?php

namespace FondOfOryx\Zed\GiftCardApi\Business\Model\Validator;

use Generated\Shared\Transfer\ApiRequestTransfer;

interface GiftCardApiValidatorInterface
{
    /**
     * @param \Generated\Shared\Transfer\ApiRequestTransfer $apiRequestTransfer
     *
     * @throws \Spryker\Zed\Api\Business\Exception\ApiValidationException
     *
     * @return array<\Generated\Shared\Transfer\ApiValidationErrorTransfer>
     */
    public function validate(ApiRequestTransfer $apiRequestTransfer): array;
}
