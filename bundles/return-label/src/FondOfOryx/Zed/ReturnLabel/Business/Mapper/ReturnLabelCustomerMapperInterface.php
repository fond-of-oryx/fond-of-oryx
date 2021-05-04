<?php


namespace FondOfOryx\Zed\ReturnLabel\Business\Mapper;


use Generated\Shared\Transfer\CompanyBusinessUnitTransfer;
use Generated\Shared\Transfer\CompanyUnitAddressTransfer;
use Generated\Shared\Transfer\ReturnLabelCustomerTransfer;

interface ReturnLabelCustomerMapperInterface
{
    /**
     * @param CompanyBusinessUnitTransfer $companyBusinessUnitTransfer
     * @param ReturnLabelCustomerTransfer $returnLabelCustomerTransfer
     *
     * @return ReturnLabelCustomerTransfer
     */
    public function mapCompanyBusinessUnitToReturnLabelCustomer(
        CompanyBusinessUnitTransfer $companyBusinessUnitTransfer,
        ReturnLabelCustomerTransfer $returnLabelCustomerTransfer
    ): ReturnLabelCustomerTransfer;

    /**
     * @param CompanyUnitAddressTransfer $companyUnitAddressTransfer
     * @param ReturnLabelCustomerTransfer $returnLabelCustomerTransfer
     *
     * @return ReturnLabelCustomerTransfer
     */
    public function mapCompanyUnitAddressToReturnLabelCustomer(
        CompanyUnitAddressTransfer $companyUnitAddressTransfer,
        ReturnLabelCustomerTransfer $returnLabelCustomerTransfer
    ): ReturnLabelCustomerTransfer;
}
