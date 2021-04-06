<?php

namespace FondOfOryx\Zed\ReturnLabelsRestApi\Business\Reader;

use FondOfOryx\Zed\ReturnLabelsRestApi\Dependency\ReturnLabelsRestApiToCompanyUserFacadeInterface;
use FondOfOryx\Zed\ReturnLabelsRestApi\Dependency\ReturnLabelsRestApiToCustomerFacadeInterface;
use FondOfOryx\Zed\ReturnLabelsRestApi\Persistence\ReturnLabelsRestApiRepositoryInterface;
use Generated\Shared\Transfer\CompanyUnitAddressResponseTransfer;
use Generated\Shared\Transfer\CompanyUserCollectionTransfer;
use Generated\Shared\Transfer\ReturnLabelsRestApiTransfer;

class CompanyUnitAddressReader implements CompanyUnitAddressReaderInterface
{
    /**
     * @var \FondOfOryx\Zed\ReturnLabelsRestApi\Dependency\ReturnLabelsRestApiToCustomerFacadeInterface
     */
    protected $customerFacade;

    /**
     * @var \FondOfOryx\Zed\ReturnLabelsRestApi\Dependency\ReturnLabelsRestApiToCompanyUserFacadeInterface
     */
    protected $companyUserFacade;

    /**
     * @var \FondOfOryx\Zed\ReturnLabelsRestApi\Persistence\ReturnLabelsRestApiRepositoryInterface
     */
    protected $repository;

    /**
     * @param \FondOfOryx\Zed\ReturnLabelsRestApi\Persistence\ReturnLabelsRestApiRepositoryInterface $companyUnitAddressRepository
     */
    public function __construct(
        ReturnLabelsRestApiToCustomerFacadeInterface $customerFacade,
        ReturnLabelsRestApiToCompanyUserFacadeInterface $companyUserFacade,
        ReturnLabelsRestApiRepositoryInterface $repository
    ) {
        $this->customerFacade = $customerFacade;
        $this->companyUserFacade = $companyUserFacade;
        $this->repository = $repository;
    }

    /**
     * @param \Generated\Shared\Transfer\ReturnLabelsRestApiTransfer $returnLabelsRestApiTransfer
     *
     * @return \Generated\Shared\Transfer\CompanyUnitAddressResponseTransfer
     */
    public function findCompanyUnitAddressByExternalReference(
        ReturnLabelsRestApiTransfer $returnLabelsRestApiTransfer
    ): CompanyUnitAddressResponseTransfer {
        $companyUnitAddressResponseTransfer = new CompanyUnitAddressResponseTransfer();

        $customerResponseTransfer = $this->customerFacade
            ->findCustomerByReference($returnLabelsRestApiTransfer->getCustomerReference());

        if ($customerResponseTransfer->getCustomerTransfer() === null) {
            return $companyUnitAddressResponseTransfer->setIsSuccessful(false);
        }

        $companyUserCollectionTransfer = $this->companyUserFacade
            ->getActiveCompanyUsersByCustomerReference($customerResponseTransfer->getCustomerTransfer());

        if ($companyUserCollectionTransfer->getCompanyUsers()->count() === 0) {
            return $companyUnitAddressResponseTransfer->setIsSuccessful(false);
        }

        if (!in_array($returnLabelsRestApiTransfer->getCompanyUserReference(), $this->getCompanyUserReferenceCollection($companyUserCollectionTransfer))) {
            return $companyUnitAddressResponseTransfer->setIsSuccessful(false);
        }

        $companyUnitAddressTransfer = $this->repository
            ->findCompanyUnitAddressByExternalReferenceAndCompanyIds(
                $returnLabelsRestApiTransfer->getCompanyUnitAddressExternalReference(),
                $this->getCompanyIds($companyUserCollectionTransfer)
            );

        if ($companyUnitAddressTransfer === null) {
            return $companyUnitAddressResponseTransfer->setIsSuccessful(false);
        }

        return $companyUnitAddressResponseTransfer
            ->setIsSuccessful(true)
            ->setCompanyUnitAddressTransfer($companyUnitAddressTransfer);
    }

    /**
     * @param \Generated\Shared\Transfer\CompanyUserCollectionTransfer $companyUserCollectionTransfer
     *
     * @return array
     */
    protected function getCompanyUserReferenceCollection(CompanyUserCollectionTransfer $companyUserCollectionTransfer): array
    {
        $collection = [];

        foreach ($companyUserCollectionTransfer->getCompanyUsers() as $companyUserTransfer) {
            $collection[] = $companyUserTransfer->getCompanyUserReference();
        }

        return $collection;
    }

    /**
     * @param \Generated\Shared\Transfer\CompanyUserTransfer[] $companyUsersTransfer
     *
     * @return array
     */
    protected function getCompanyIds(CompanyUserCollectionTransfer $companyUserCollectionTransfer): array
    {
        $collection = [];

        foreach ($companyUserCollectionTransfer->getCompanyUsers() as $companyUserTransfer) {
            $collection[] = $companyUserTransfer->getFkCompany();
        }

        return $collection;
    }
}
