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
        $returnLabelAddressTransfer
            ->setCompany('')
            ->setName($companyUnitAddressTransfer->getName1().' '.$companyUnitAddressTransfer->getName2())
            ->setAddress1($companyUnitAddressTransfer->setAddress1())
            ->setAddress2($companyUnitAddressTransfer->setAddress2())
            ->setAddress3($companyUnitAddressTransfer->setAddress3())
            ->setZip($companyUnitAddressTransfer->getZipCode())
            ->setCity($companyUnitAddressTransfer->getCity())
            ->setCountry($companyUnitAddressTransfer->getCountry());
    }
}
