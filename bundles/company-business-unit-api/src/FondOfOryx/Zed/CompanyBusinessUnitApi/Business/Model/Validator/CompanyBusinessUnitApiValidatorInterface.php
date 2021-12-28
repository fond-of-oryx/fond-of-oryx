<?php

namespace FondOfOryx\Zed\CompanyBusinessUnitApi\Business\Model\Validator;

use Generated\Shared\Transfer\ApiDataTransfer;

interface CompanyBusinessUnitApiValidatorInterface
{
    /**
     * @param \Generated\Shared\Transfer\ApiDataTransfer $apiDataTransfer
     *
     * @return array
     */
    public function validate(ApiDataTransfer $apiDataTransfer): array;
}
