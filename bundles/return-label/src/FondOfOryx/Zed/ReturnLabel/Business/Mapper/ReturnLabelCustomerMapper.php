<?php


namespace FondOfOryx\Zed\ReturnLabel\Business\Mapper;


use Generated\Shared\Transfer\CompanyBusinessUnitTransfer;
use Generated\Shared\Transfer\CompanyUnitAddressTransfer;
use Generated\Shared\Transfer\ReturnLabelAddressTransfer;
use Generated\Shared\Transfer\ReturnLabelCustomerTransfer;

class ReturnLabelCustomerMapper implements ReturnLabelCustomerMapperInterface
{
    /**
     * @var ReturnLabelAddressMapperInterface
     */
    protected $returnLabelAddressMapper;

    /**
     * @param ReturnLabelAddressMapperInterface $returnLabelAddressMapper
     */
    public function __construct(ReturnLabelAddressMapperInterface $returnLabelAddressMapper)
    {
        $this->returnLabelAddressMapper = $returnLabelAddressMapper;
    }

    /**
     * @param CompanyBusinessUnitTransfer $companyBusinessUnitTransfer
     * @param ReturnLabelCustomerTransfer $returnLabelCustomerTransfer
     *
     * @return ReturnLabelCustomerTransfer
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
     * @param CompanyUnitAddressTransfer $companyUnitAddressTransfer
     * @param ReturnLabelCustomerTransfer $returnLabelCustomerTransfer
     *
     * @return ReturnLabelCustomerTransfer
     */
    public function mapCompanyUnitAddressToReturnLabelCustomer(
        CompanyUnitAddressTransfer $companyUnitAddressTransfer,
        ReturnLabelCustomerTransfer $returnLabelCustomerTransfer
    ): ReturnLabelCustomerTransfer
    {
        return $returnLabelCustomerTransfer->setAddress($this->returnLabelAddressMapper
            ->mapCompanyUnitAddressToReturnLabelAddress(
                $companyUnitAddressTransfer,
                new ReturnLabelAddressTransfer()
            )
        );
    }
}
