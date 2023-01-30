<?php

namespace FondOfOryx\Zed\CompanyApi\Business\Model\Validator;

use Generated\Shared\Transfer\ApiRequestTransfer;

interface CompanyApiValidatorInterface
{
    /**
     * @param \Generated\Shared\Transfer\ApiRequestTransfer $apiRequestTransfer
     *
     * @return array<\Generated\Shared\Transfer\ApiValidationErrorTransfer>
     */
    public function validate(ApiRequestTransfer $apiRequestTransfer): array;
}
