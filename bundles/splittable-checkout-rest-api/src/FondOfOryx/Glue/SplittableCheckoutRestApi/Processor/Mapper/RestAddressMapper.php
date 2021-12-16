<?php

namespace FondOfOryx\Glue\SplittableCheckoutRestApi\Processor\Mapper;

use Generated\Shared\Transfer\AddressTransfer;
use Generated\Shared\Transfer\RestAddressTransfer;

class RestAddressMapper implements RestAddressMapperInterface
{
    /**
     * @param \Generated\Shared\Transfer\AddressTransfer $addressTransfer
     *
     * @return \Generated\Shared\Transfer\RestAddressTransfer
     */
    public function fromAddress(AddressTransfer $addressTransfer): RestAddressTransfer
    {
        $restAddressTransfer = (new RestAddressTransfer())->fromArray(
            $addressTransfer->toArray(true),
            true,
        );

        $countryTransfer = $addressTransfer->getCountry();

        if ($countryTransfer === null || $countryTransfer->getName() === null) {
            return $restAddressTransfer;
        }

        return $restAddressTransfer->setCountry($countryTransfer->getName());
    }
}
