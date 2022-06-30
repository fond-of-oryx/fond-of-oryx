<?php

namespace FondOfOryx\Zed\SplittableCheckoutRestApiCompanyUnitAddressConnector\Business\Mapper;

use Generated\Shared\Transfer\AddressTransfer;
use Generated\Shared\Transfer\CompanyUnitAddressTransfer;

class AddressMapper implements AddressMapperInterface
{
    /**
     * @param \Generated\Shared\Transfer\CompanyUnitAddressTransfer $companyUnitAddressTransfer
     *
     * @return \Generated\Shared\Transfer\AddressTransfer
     */
    public function fromCompanyUnitAddressTransfer(
        CompanyUnitAddressTransfer $companyUnitAddressTransfer
    ): AddressTransfer {
        $data = $companyUnitAddressTransfer->toArray();

        if (isset($data['company'])) {
            unset($data['company']);
        }

        return (new AddressTransfer())
            ->fromArray($data, true)
            ->setFirstName($companyUnitAddressTransfer->getName1())
            ->setLastName($companyUnitAddressTransfer->getName2() ?? '');
    }
}
