<?php

namespace FondOfOryx\Zed\CompanyApi\Business\Model\Validator;

use Generated\Shared\Transfer\ApiDataTransfer;

interface CompanyApiValidatorInterface
{
    /**
     * @param \Generated\Shared\Transfer\ApiDataTransfer $apiDataTransfer
     *
     * @return array
     */
    public function validate(ApiDataTransfer $apiDataTransfer): array;
}
