<?php

namespace FondOfOryx\Glue\CustomerRegistrationRestApi\Processor\Mapper;

use Generated\Shared\Transfer\CustomerTransfer;
use Generated\Shared\Transfer\RestCustomerRegistrationResponseTransfer;

class CustomerRegistrationResourceMapper implements CustomerRegistrationResourceMapperInterface
{
    /**
     * @param \Generated\Shared\Transfer\CustomerTransfer $customerTransfer
     * @param \Generated\Shared\Transfer\RestCustomerRegistrationResponseTransfer $customerRegistrationResponseTransfer
     *
     * @return \Generated\Shared\Transfer\RestCustomerRegistrationResponseTransfer
     */
    public function mapCustomerTransferToRestCustomerRegistrationResponseTransfer(CustomerTransfer $customerTransfer, RestCustomerRegistrationResponseTransfer $customerRegistrationResponseTransfer): RestCustomerRegistrationResponseTransfer
    {
        return $customerRegistrationResponseTransfer->fromArray($customerTransfer->toArray(), true);
    }
}
