<?php

namespace FondOfOryx\Zed\CompanyUserApi\Business\Model\Validator;

use Generated\Shared\Transfer\ApiRequestTransfer;

interface CompanyUserApiValidatorInterface
{
    /**
     * @param \Generated\Shared\Transfer\ApiRequestTransfer $apiRequestTransfer
     *
     * @return array<\Generated\Shared\Transfer\ApiValidationErrorTransfer>
     */
    public function validate(ApiRequestTransfer $apiRequestTransfer): array;
}
