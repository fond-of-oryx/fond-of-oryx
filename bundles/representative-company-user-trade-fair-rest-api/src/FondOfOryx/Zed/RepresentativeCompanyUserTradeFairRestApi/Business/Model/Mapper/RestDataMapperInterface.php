<?php

namespace FondOfOryx\Zed\RepresentativeCompanyUserTradeFairRestApi\Business\Model\Mapper;

use Generated\Shared\Transfer\RepresentativeCompanyUserTradeFairCollectionTransfer;
use Generated\Shared\Transfer\RepresentativeCompanyUserTradeFairTransfer;
use Generated\Shared\Transfer\RestRepresentativeCompanyUserTradeFairCollectionTransfer;
use Generated\Shared\Transfer\RestRepresentativeCompanyUserTradeFairTransfer;

interface RestDataMapperInterface
{
    /**
     * @param \Generated\Shared\Transfer\RepresentativeCompanyUserTradeFairTransfer $companyUserTransfer
     *
     * @return \Generated\Shared\Transfer\RestRepresentativeCompanyUserTradeFairTransfer
     */
    public function mapResponse(RepresentativeCompanyUserTradeFairTransfer $companyUserTransfer): RestRepresentativeCompanyUserTradeFairTransfer;

    /**
     * @param \Generated\Shared\Transfer\RepresentativeCompanyUserTradeFairCollectionTransfer $companyUserCollectionTransfer
     *
     * @return \Generated\Shared\Transfer\RestRepresentativeCompanyUserTradeFairCollectionTransfer
     */
    public function mapResponseCollection(
        RepresentativeCompanyUserTradeFairCollectionTransfer $companyUserCollectionTransfer
    ): RestRepresentativeCompanyUserTradeFairCollectionTransfer;
}
