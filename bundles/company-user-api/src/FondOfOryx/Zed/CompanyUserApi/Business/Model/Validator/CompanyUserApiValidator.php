<?php

namespace FondOfOryx\Zed\CompanyUserApi\Business\Model\Validator;

use Generated\Shared\Transfer\ApiRequestTransfer;

class CompanyUserApiValidator implements CompanyUserApiValidatorInterface
{
    /**
     * @param \Generated\Shared\Transfer\ApiRequestTransfer $apiRequestTransfer
     *
     * @return array<\Generated\Shared\Transfer\ApiValidationErrorTransfer>
     */
    public function validate(ApiRequestTransfer $apiRequestTransfer): array
    {
        return [];
    }
}
