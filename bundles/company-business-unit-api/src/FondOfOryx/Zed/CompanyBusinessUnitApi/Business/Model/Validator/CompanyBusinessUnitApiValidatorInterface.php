<?php

namespace FondOfOryx\Zed\CompanyBusinessUnitApi\Business\Model\Validator;

use Generated\Shared\Transfer\ApiRequestTransfer;

interface CompanyBusinessUnitApiValidatorInterface
{
    /**
     * @param \Generated\Shared\Transfer\ApiRequestTransfer $apiRequestTransfer
     *
     * @return array<\Generated\Shared\Transfer\ApiValidationErrorTransfer>
     */
    public function validate(ApiRequestTransfer $apiRequestTransfer): array;
}
