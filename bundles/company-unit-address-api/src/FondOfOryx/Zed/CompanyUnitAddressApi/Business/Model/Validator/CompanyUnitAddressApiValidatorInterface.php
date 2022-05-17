<?php

namespace FondOfOryx\Zed\CompanyUnitAddressApi\Business\Model\Validator;

use Generated\Shared\Transfer\ApiDataTransfer;

interface CompanyUnitAddressApiValidatorInterface
{
    /**
     * @param \Generated\Shared\Transfer\ApiDataTransfer $apiDataTransfer
     *
     * @return array
     */
    public function validate(ApiDataTransfer $apiDataTransfer): array;
}
