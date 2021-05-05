<?php

namespace FondOfOryx\Zed\ReturnLabel\Business\Mapper;

use Generated\Shared\Transfer\CompanyBusinessUnitTransfer;
use Generated\Shared\Transfer\CompanyUnitAddressTransfer;
use Generated\Shared\Transfer\ReturnLabelAddressTransfer;
use Generated\Shared\Transfer\ReturnLabelCustomerTransfer;

class ReturnLabelCustomerMapper implements ReturnLabelCustomerMapperInterface
{
    /**
     * @var \FondOfOryx\Zed\ReturnLabel\Business\Mapper\ReturnLabelAddressMapperInterface
     */
    protected $returnLabelAddressMapper;

    /**
     * @param \FondOfOryx\Zed\ReturnLabel\Business\Mapper\ReturnLabelAddressMapperInterface $returnLabelAddressMapper
     */
    public function __construct(ReturnLabelAddressMapperInterface $returnLabelAddressMapper)
    {
        $this->returnLabelAddressMapper = $returnLabelAddressMapper;
    }

    /**
     * @param \Generated\Shared\Transfer\CompanyBusinessUnitTransfer $companyBusinessUnitTransfer
     * @param \Generated\Shared\Transfer\ReturnLabelCustomerTransfer $returnLabelCustomerTransfer
     *
     * @return \Generated\Shared\Transfer\ReturnLabelCustomerTransfer
     */
    public function mapCompanyBusinessUnitToReturnLabelCustomer(
        CompanyBusinessUnitTransfer $companyBusinessUnitTransfer,
        ReturnLabelCustomerTransfer $returnLabelCustomerTransfer
    ): ReturnLabelCustomerTransfer {
        return $returnLabelCustomerTransfer
            ->setReceiverId('deu')
            ->setCustomerReference($companyBusinessUnitTransfer->getCompany()->getDebtorNumber())
            ->setEmail($companyBusinessUnitTransfer->getEmail())
            ->setPhone($companyBusinessUnitTransfer->getPhone());
    }

    /**
     * @param \Generated\Shared\Transfer\CompanyUnitAddressTransfer $companyUnitAddressTransfer
     * @param \Generated\Shared\Transfer\ReturnLabelCustomerTransfer $returnLabelCustomerTransfer
     *
     * @return \Generated\Shared\Transfer\ReturnLabelCustomerTransfer
     */
    public function mapCompanyUnitAddressToReturnLabelCustomer(
        CompanyUnitAddressTransfer $companyUnitAddressTransfer,
        ReturnLabelCustomerTransfer $returnLabelCustomerTransfer
    ): ReturnLabelCustomerTransfer {
        return $returnLabelCustomerTransfer->setAddress($this->returnLabelAddressMapper
            ->mapCompanyUnitAddressToReturnLabelAddress(
                $companyUnitAddressTransfer,
                new ReturnLabelAddressTransfer()
            ));
    }
}
