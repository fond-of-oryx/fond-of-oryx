<?php

namespace FondOfOryx\Zed\ConcreteProductApi\Business\Validator;

use Generated\Shared\Transfer\ApiDataTransfer;

interface ConcreteProductApiValidatorInterface
{
    /**
     * @param \Generated\Shared\Transfer\ApiDataTransfer $apiDataTransfer
     *
     * @return array<string>
     */
    public function validate(ApiDataTransfer $apiDataTransfer): array;
}
