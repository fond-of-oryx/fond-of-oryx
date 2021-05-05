<?php

namespace FondOfOryx\Zed\ReturnLabel\Business\Mapper;

use Generated\Shared\Transfer\CompanyUnitAddressTransfer;
use Generated\Shared\Transfer\ReturnLabelAddressTransfer;

interface ReturnLabelAddressMapperInterface
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
    ): ReturnLabelAddressTransfer;
}
