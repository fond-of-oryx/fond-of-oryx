<?php

namespace FondOfOryx\Zed\ReturnLabel\Business\Mapper;

use Generated\Shared\Transfer\CompanyUnitAddressTransfer;
use Generated\Shared\Transfer\ReturnLabelAddressTransfer;

class ReturnLabelAddressMapper implements ReturnLabelAddressMapperInterface
{
    /**
     * @param \Generated\Shared\Transfer\CompanyUnitAddressTransfer $companyUnitAddressTransfer
     * @param \Generated\Shared\Transfer\ReturnLabelAddressTransfer $returnLabelAddressTransfer
     *
     * @return \Generated\Shared\Transfer\ReturnLabelAddressTransfer
     */
    public function mapCompanyUnitAddressToReturnLabelAddress(
        CompanyUnitAddressTransfer $companyUnitAddressTransfer,
        ReturnLabelAddressTransfer $returnLabelAddressTransfer
    ): ReturnLabelAddressTransfer {
        return $returnLabelAddressTransfer
            ->setName1($companyUnitAddressTransfer->getName1())
            ->setName2($companyUnitAddressTransfer->getName2())
            ->setAddress1($companyUnitAddressTransfer->getAddress1())
            ->setAddress2($companyUnitAddressTransfer->getAddress2())
            ->setAddress3($companyUnitAddressTransfer->getAddress3())
            ->setZipCode($companyUnitAddressTransfer->getZipCode())
            ->setCity($companyUnitAddressTransfer->getCity())
            ->setCountry($companyUnitAddressTransfer->getCountry());
    }
}
