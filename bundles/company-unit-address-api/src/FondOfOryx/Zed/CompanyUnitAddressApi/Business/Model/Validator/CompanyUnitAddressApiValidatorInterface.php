<?php

namespace FondOfOryx\Zed\CompanyUnitAddressApi\Business\Model\Validator;

use Generated\Shared\Transfer\ApiRequestTransfer;

interface CompanyUnitAddressApiValidatorInterface
{
    /**
     * @param \Generated\Shared\Transfer\ApiRequestTransfer $apiRequestTransfer
     *
     * @return array<\Generated\Shared\Transfer\ApiValidationErrorTransfer>
     */
    public function validate(ApiRequestTransfer $apiRequestTransfer): array;
}
