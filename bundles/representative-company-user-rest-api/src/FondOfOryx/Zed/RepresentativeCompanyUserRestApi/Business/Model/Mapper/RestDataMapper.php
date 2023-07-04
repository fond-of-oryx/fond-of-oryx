<?php

namespace FondOfOryx\Zed\RepresentativeCompanyUserRestApi\Business\Model\Mapper;

use ArrayObject;
use Generated\Shared\Transfer\CustomerTransfer;
use Generated\Shared\Transfer\RepresentativeCompanyUserCollectionTransfer;
use Generated\Shared\Transfer\RepresentativeCompanyUserTransfer;
use Generated\Shared\Transfer\RestRepresentativeCompanyUserTransfer;
use Generated\Shared\Transfer\RestRepresentativeDistributorTransfer;

class RestDataMapper implements RestDataMapperInterface
{
    /**
     * @param \Generated\Shared\Transfer\RepresentativeCompanyUserTransfer $companyUserTransfer
     *
     * @return \Generated\Shared\Transfer\RestRepresentativeCompanyUserTransfer
     */
    public function mapResponse(RepresentativeCompanyUserTransfer $companyUserTransfer): RestRepresentativeCompanyUserTransfer
    {
        return (new RestRepresentativeCompanyUserTransfer())
            ->fromArray($companyUserTransfer->toArray(), true)
            ->setDistributor($this->mapRestRepresentativeDistributor($companyUserTransfer->getDistributor()))
            ->setRepresentative($this->mapRestRepresentativeDistributor($companyUserTransfer->getRepresentative()))
            ->setOriginator($this->mapRestRepresentativeDistributor($companyUserTransfer->getOriginator()));
    }

    /**
     * @param \Generated\Shared\Transfer\RepresentativeCompanyUserCollectionTransfer $companyUserCollectionTransfer
     *
     * @return \ArrayObject|\Generated\Shared\Transfer\RestRepresentativeCompanyUserTransfer[]
     */
    public function mapResponseCollection(RepresentativeCompanyUserCollectionTransfer $companyUserCollectionTransfer): ArrayObject
    {
        $restResponseCollection = new ArrayObject();

        foreach ($companyUserCollectionTransfer->getRepresentations() as $representation) {
            $restResponseCollection->append($this->mapResponse($representation));
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
