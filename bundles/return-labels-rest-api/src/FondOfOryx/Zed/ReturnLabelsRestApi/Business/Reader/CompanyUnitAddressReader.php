<?php

namespace FondOfOryx\Zed\ReturnLabelsRestApi\Business\Reader;

use FondOfOryx\Zed\ReturnLabelsRestApi\Persistence\ReturnLabelsRestApiRepositoryInterface;
use Generated\Shared\Transfer\CompanyUnitAddressResponseTransfer;
use Generated\Shared\Transfer\CompanyUnitAddressTransfer;
use Generated\Shared\Transfer\ReturnLabelsRestApiTransfer;

class CompanyUnitAddressReader implements CompanyUnitAddressReaderInterface
{
    /**
     * @var ReturnLabelsRestApiCompanyUnitAddressRepositoryInterface
     */
    protected $companyUnitAddressRepository;

    /**
     * @param ReturnLabelsRestApiRepositoryInterface $companyUnitAddressRepository
     */
    public function __construct(ReturnLabelsRestApiRepositoryInterface $companyUnitAddressRepository)
    {
        $this->companyUnitAddressRepository = $companyUnitAddressRepository;
    }

    /**
     * @param ReturnLabelsRestApiTransfer $returnLabelsRestApiTransfer
     *
     * @return \Generated\Shared\Transfer\CompanyUnitAddressResponseTransfer
     */
    public function findCompanyUnitAddressByExternalReference(
        ReturnLabelsRestApiTransfer $returnLabelsRestApiTransfer
    ): CompanyUnitAddressResponseTransfer {
        $companyUnitAddressTransfer = $this->companyUnitAddressRepository
            ->findCompanyUnitAddressByExternalReference(
                $returnLabelsRestApiTransfer->getCompanyUnitAddressExternalReference()
            )
        ;

        $companyUnitAddressResponseTransfer = new CompanyUnitAddressResponseTransfer();

        if (!$companyUnitAddressTransfer) {
            return $companyUnitAddressResponseTransfer->setIsSuccessful(false);
        }

        return $companyUnitAddressResponseTransfer
            ->setIsSuccessful(true)
            ->setCompanyUnitAddressTransfer($companyUnitAddressTransfer);
    }
}
