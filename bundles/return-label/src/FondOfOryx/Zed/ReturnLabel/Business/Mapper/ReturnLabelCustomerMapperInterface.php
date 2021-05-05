<?php

namespace FondOfOryx\Zed\ReturnLabel\Business\Mapper;

use Generated\Shared\Transfer\CompanyBusinessUnitTransfer;
use Generated\Shared\Transfer\CompanyUnitAddressTransfer;
use Generated\Shared\Transfer\ReturnLabelCustomerTransfer;

interface ReturnLabelCustomerMapperInterface
{
    /**
     * @param \Generated\Shared\Transfer\CompanyBusinessUnitTransfer $companyBusinessUnitTransfer
     * @param \Generated\Shared\Transfer\ReturnLabelCustomerTransfer $returnLabelCustomerTransfer
     *
     * @return \Generated\Shared\Transfer\ReturnLabelCustomerTransfer
     */
    public function mapCompanyBusinessUnitToReturnLabelCustomer(
        CompanyBusinessUnitTransfer $companyBusinessUnitTransfer,
        ReturnLabelCustomerTransfer $returnLabelCustomerTransfer
    ): ReturnLabelCustomerTransfer;

    /**
     * @param \Generated\Shared\Transfer\CompanyUnitAddressTransfer $companyUnitAddressTransfer
     * @param \Generated\Shared\Transfer\ReturnLabelCustomerTransfer $returnLabelCustomerTransfer
     *
     * @return \Generated\Shared\Transfer\ReturnLabelCustomerTransfer
     */
    public function mapCompanyUnitAddressToReturnLabelCustomer(
        CompanyUnitAddressTransfer $companyUnitAddressTransfer,
        ReturnLabelCustomerTransfer $returnLabelCustomerTransfer
    ): ReturnLabelCustomerTransfer;
}
