<?php

namespace FondOfOryx\Glue\CustomerRegistrationRestApi\Mapper;

use Generated\Shared\Transfer\CustomerRegistrationAttributesTransfer;
use Generated\Shared\Transfer\CustomerRegistrationRequestTransfer;
use Generated\Shared\Transfer\RestCustomerRegistrationRequestAttributesTransfer;

class RequestMapper implements RequestMapperInterface
{
    /**
     * @param \Generated\Shared\Transfer\RestCustomerRegistrationRequestAttributesTransfer $restCustomerRegistrationRequestAttributesTransfer
     *
     * @return \Generated\Shared\Transfer\CustomerRegistrationRequestTransfer
     */
    public function mapRequestAttributesToTransfer(
        RestCustomerRegistrationRequestAttributesTransfer $restCustomerRegistrationRequestAttributesTransfer
    ): CustomerRegistrationRequestTransfer {
        $attributes = (new CustomerRegistrationAttributesTransfer())->fromArray($restCustomerRegistrationRequestAttributesTransfer->toArray(), true);

        return (new CustomerRegistrationRequestTransfer())->setAttributes($attributes);
    }
}
