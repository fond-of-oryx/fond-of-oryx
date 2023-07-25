<?php

namespace FondOfOryx\Zed\RepresentativeCompanyUserRestApi\Business\Model\Mapper;

use ArrayObject;
use Generated\Shared\Transfer\RepresentativeCompanyUserCollectionTransfer;
use Generated\Shared\Transfer\RepresentativeCompanyUserTransfer;
use Generated\Shared\Transfer\RestRepresentativeCompanyUserTransfer;

interface RestDataMapperInterface
{
    /**
     * @param \Generated\Shared\Transfer\RepresentativeCompanyUserTransfer $companyUserTransfer
     *
     * @return \Generated\Shared\Transfer\RestRepresentativeCompanyUserTransfer
     */
    public function mapResponse(RepresentativeCompanyUserTransfer $companyUserTransfer): RestRepresentativeCompanyUserTransfer;

    /**
     * @param \Generated\Shared\Transfer\RepresentativeCompanyUserCollectionTransfer $companyUserCollectionTransfer
     *
     * @return \ArrayObject|\Generated\Shared\Transfer\RestRepresentativeCompanyUserTransfer[]
     */
    public function mapResponseCollection(RepresentativeCompanyUserCollectionTransfer $companyUserCollectionTransfer): ArrayObject;
}
