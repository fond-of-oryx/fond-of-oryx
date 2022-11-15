<?php

namespace FondOfOryx\Glue\CustomerRegistrationRestApi\Mapper;

use Generated\Shared\Transfer\CustomerRegistrationResponseTransfer;
use Generated\Shared\Transfer\RestCustomerRegistrationResponseTransfer;

class ResponseMapper implements ResponseMapperInterface
{
    /**
     * @param \Generated\Shared\Transfer\CustomerRegistrationResponseTransfer $customerRegistrationResponseTransfer
     *
     * @return \Generated\Shared\Transfer\RestCustomerRegistrationResponseTransfer
     */
    public function mapResponseToRestResponseTransfer(
        CustomerRegistrationResponseTransfer $customerRegistrationResponseTransfer
    ): RestCustomerRegistrationResponseTransfer {
        return (new RestCustomerRegistrationResponseTransfer())->fromArray($customerRegistrationResponseTransfer->toArray(), true);
    }
}
