<?php

namespace FondOfOryx\Zed\CustomerApi\Business\Validator;

use Generated\Shared\Transfer\ApiRequestTransfer;

interface ApiRequestValidatorInterface
{
    /**
     * @param \Generated\Shared\Transfer\ApiRequestTransfer $apiRequestTransfer
     *
     * @return array<\Generated\Shared\Transfer\ApiValidationErrorTransfer>
     */
    public function validate(ApiRequestTransfer $apiRequestTransfer): array;
}
