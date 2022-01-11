<?php

namespace FondOfOryx\Zed\InvoiceApi\Business\Model\Validator;

use Generated\Shared\Transfer\ApiDataTransfer;

interface InvoiceApiValidatorInterface
{
    /**
     * @param \Generated\Shared\Transfer\ApiDataTransfer $apiDataTransfer
     *
     * @throws \Spryker\Zed\Api\Business\Exception\ApiValidationException
     *
     * @return array
     */
    public function validate(ApiDataTransfer $apiDataTransfer): array;
}
