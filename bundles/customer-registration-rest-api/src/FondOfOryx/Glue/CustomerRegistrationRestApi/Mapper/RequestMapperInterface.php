<?php

namespace FondOfOryx\Glue\CustomerRegistrationRestApi\Mapper;

use Generated\Shared\Transfer\CustomerRegistrationRequestTransfer;
use Generated\Shared\Transfer\RestCustomerRegistrationRequestAttributesTransfer;

interface RequestMapperInterface
{
    /**
     * @param \Generated\Shared\Transfer\RestCustomerRegistrationRequestAttributesTransfer $restCustomerRegistrationRequestAttributesTransfer
     *
     * @return \Generated\Shared\Transfer\CustomerRegistrationRequestTransfer
     */
    public function mapRequestAttributesToTransfer(
        RestCustomerRegistrationRequestAttributesTransfer $restCustomerRegistrationRequestAttributesTransfer
    ): CustomerRegistrationRequestTransfer;
}
