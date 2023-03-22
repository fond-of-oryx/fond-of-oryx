<?php

namespace FondOfOryx\Zed\ConcreteProductApi\Business\Validator;

use Generated\Shared\Transfer\ApiRequestTransfer;

class ConcreteProductApiValidator implements ConcreteProductApiValidatorInterface
{
    /**
     * @param \Generated\Shared\Transfer\ApiRequestTransfer $apiRequestTransfer
     *
     * @return array<\Generated\Shared\Transfer\ApiValidationErrorTransfer>
     */
    public function validate(ApiRequestTransfer $apiRequestTransfer): array
    {
        return [];
    }
}
