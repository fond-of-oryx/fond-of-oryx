<?php

namespace FondOfOryx\Zed\ReturnLabelsRestApi\Business\Reader;

use FondOfOryx\Zed\ReturnLabelsRestApi\Persistence\ReturnLabelsRestApiRepositoryInterface;
use Generated\Shared\Transfer\CompanyUnitAddressResponseTransfer;
use Generated\Shared\Transfer\ReturnLabelsRestApiTransfer;

class CompanyUnitAddressReader implements CompanyUnitAddressReaderInterface
{
    /**
     * @var \FondOfOryx\Zed\ReturnLabelsRestApi\Persistence\ReturnLabelsRestApiRepositoryInterface
     */
    protected $companyUnitAddressRepository;

    /**
     * @param \FondOfOryx\Zed\ReturnLabelsRestApi\Persistence\ReturnLabelsRestApiRepositoryInterface $companyUnitAddressRepository
     */
    public function __construct(ReturnLabelsRestApiRepositoryInterface $companyUnitAddressRepository)
    {
        $this->companyUnitAddressRepository = $companyUnitAddressRepository;
    }

    /**
     * @param \Generated\Shared\Transfer\ReturnLabelsRestApiTransfer $returnLabelsRestApiTransfer
     *
     * @return \Generated\Shared\Transfer\CompanyUnitAddressResponseTransfer
     */
    public function findCompanyUnitAddressByExternalReference(
        ReturnLabelsRestApiTransfer $returnLabelsRestApiTransfer
    ): CompanyUnitAddressResponseTransfer {
        $companyUnitAddressTransfer = $this->companyUnitAddressRepository
            ->findCompanyUnitAddressByExternalReference(
                $returnLabelsRestApiTransfer->getCompanyUnitAddressExternalReference()
            );

        $companyUnitAddressResponseTransfer = new CompanyUnitAddressResponseTransfer();

        if (!$companyUnitAddressTransfer) {
            return $companyUnitAddressResponseTransfer->setIsSuccessful(false);
        }

        return $companyUnitAddressResponseTransfer
            ->setIsSuccessful(true)
            ->setCompanyUnitAddressTransfer($companyUnitAddressTransfer);
    }
}
