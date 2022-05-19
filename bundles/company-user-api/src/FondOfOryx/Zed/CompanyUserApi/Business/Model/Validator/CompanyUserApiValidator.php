<?php

namespace FondOfOryx\Zed\CompanyUserApi\Business\Model\Validator;

use Generated\Shared\Transfer\ApiDataTransfer;

class CompanyUserApiValidator implements CompanyUserApiValidatorInterface
{
    /**
     * @param \Generated\Shared\Transfer\ApiDataTransfer $apiDataTransfer
     *
     * @return array
     */
    public function validate(ApiDataTransfer $apiDataTransfer): array
    {
        return [];
    }
}
