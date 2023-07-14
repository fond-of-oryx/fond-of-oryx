<?php

namespace FondOfOryx\Zed\RepresentativeCompanyUserTradeFairRestApi\Business\Model\Mapper;

use Generated\Shared\Transfer\CustomerTransfer;
use Generated\Shared\Transfer\RepresentativeCompanyUserTradeFairCollectionTransfer;
use Generated\Shared\Transfer\RepresentativeCompanyUserTradeFairTransfer;
use Generated\Shared\Transfer\RestRepresentativeCompanyUserTradeFairCollectionTransfer;
use Generated\Shared\Transfer\RestRepresentativeCompanyUserTradeFairTransfer;
use Generated\Shared\Transfer\RestRepresentativeDistributorTransfer;

class RestDataMapper implements RestDataMapperInterface
{
    /**
     * @param \Generated\Shared\Transfer\RepresentativeCompanyUserTradeFairTransfer $companyUserTransfer
     *
     * @return \Generated\Shared\Transfer\RestRepresentativeCompanyUserTradeFairTransfer
     */
    public function mapResponse(RepresentativeCompanyUserTradeFairTransfer $companyUserTransfer): RestRepresentativeCompanyUserTradeFairTransfer
    {
        return (new RestRepresentativeCompanyUserTradeFairTransfer())
            ->fromArray($companyUserTransfer->toArray(), true)
            ->setDistributor($this->mapRestRepresentativeDistributor($companyUserTransfer->getDistributor()));
    }

    /**
     * @param \Generated\Shared\Transfer\RepresentativeCompanyUserTradeFairCollectionTransfer $companyUserCollectionTransfer
     *
     * @return \Generated\Shared\Transfer\RestRepresentativeCompanyUserTradeFairCollectionTransfer
     */
    public function mapResponseCollection(
        RepresentativeCompanyUserTradeFairCollectionTransfer $companyUserCollectionTransfer
    ): RestRepresentativeCompanyUserTradeFairCollectionTransfer {
        $restResponseCollection = new RestRepresentativeCompanyUserTradeFairCollectionTransfer();

        foreach ($companyUserCollectionTransfer->getRepresentations() as $representation) {
            $restResponseCollection->addRepresentation($this->mapResponse($representation));
        }

        return $restResponseCollection;
    }

    /**
     * @param \Generated\Shared\Transfer\CustomerTransfer|null $customerTransfer
     *
     * @return \Generated\Shared\Transfer\RestRepresentativeDistributorTransfer|null
     */
    protected function mapRestRepresentativeDistributor(?CustomerTransfer $customerTransfer): ?RestRepresentativeDistributorTransfer
    {
        if ($customerTransfer === null) {
            return null;
        }

        return (new RestRepresentativeDistributorTransfer())
            ->fromArray($customerTransfer->toArray(), true);
    }
}
