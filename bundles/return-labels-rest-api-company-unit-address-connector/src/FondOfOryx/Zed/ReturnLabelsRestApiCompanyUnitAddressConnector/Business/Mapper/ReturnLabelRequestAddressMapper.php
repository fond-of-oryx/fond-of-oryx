<?php

namespace FondOfOryx\Zed\ReturnLabelsRestApiCompanyUnitAddressConnector\Business\Mapper;

use Generated\Shared\Transfer\CompanyUnitAddressTransfer;
use Generated\Shared\Transfer\ReturnLabelRequestAddressTransfer;

class ReturnLabelRequestAddressMapper implements ReturnLabelRequestAddressMapperInterface
{
    /**
     * @param \Generated\Shared\Transfer\CompanyUnitAddressTransfer $companyUnitAddressTransfer
     *
     * @return \Generated\Shared\Transfer\ReturnLabelRequestAddressTransfer
     */
    public function fromCompanyUnitAddressTransfer(
        CompanyUnitAddressTransfer $companyUnitAddressTransfer
    ): ReturnLabelRequestAddressTransfer {
        $returnLabelRequestAddressTransfer = (new ReturnLabelRequestAddressTransfer())->fromArray(
            $companyUnitAddressTransfer->toArray(),
            true,
        );

        $countryTransfer = $companyUnitAddressTransfer->getCountry();

        if ($countryTransfer === null || $countryTransfer->getName() === null) {
            return $returnLabelRequestAddressTransfer;
        }

        return $returnLabelRequestAddressTransfer->setCountry($countryTransfer->getName());
    }
}
