<?php

namespace FondOfOryx\Zed\StockProductApi\Business\Model\Validator;

use Generated\Shared\Transfer\ApiDataTransfer;

interface StockProductApiValidatorInterface
{
    /**
     * @param \Generated\Shared\Transfer\ApiDataTransfer $apiDataTransfer
     *
     * @throws \Spryker\Zed\Api\Business\Exception\ApiValidationException
     *
     * @return array
     */
    public function validate(ApiDataTransfer $apiDataTransfer);
}
