<?php

namespace FondOfOryx\Zed\ReturnLabel\Business\Mapper;

use Generated\Shared\Transfer\CompanyUnitAddressTransfer;
use Generated\Shared\Transfer\ReturnLabelAddressTransfer;

class ReturnLabelAddressMapper implements ReturnLabelAddressMapperInterface
{
    /**
     * @param CompanyUnitAddressTransfer $companyUnitAddressTransfer
     * @param ReturnLabelAddressTransfer $returnLabelAddressTransfer
     *
     * @return ReturnLabelAddressTransfer
     */
    public function mapCompanyUnitAddressToReturnLabelAddress(
        CompanyUnitAddressTransfer $companyUnitAddressTransfer,
        ReturnLabelAddressTransfer $returnLabelAddressTransfer
    ): ReturnLabelAddressTransfer
    {
        return $returnLabelAddressTransfer
            ->setCompany('')
            ->setName($companyUnitAddressTransfer->getName1().' '.$companyUnitAddressTransfer->getName2())
            ->setAddress1($companyUnitAddressTransfer->getAddress1())
            ->setAddress2($companyUnitAddressTransfer->getAddress2())
            ->setAddress3($companyUnitAddressTransfer->getAddress3())
            ->setZip($companyUnitAddressTransfer->getZipCode())
            ->setCity($companyUnitAddressTransfer->getCity())
            ->setCountry($companyUnitAddressTransfer->getCountry());
    }
}
