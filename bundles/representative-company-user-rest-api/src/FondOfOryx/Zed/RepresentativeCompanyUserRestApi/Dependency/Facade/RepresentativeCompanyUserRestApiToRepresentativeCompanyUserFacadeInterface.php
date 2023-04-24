<?php

namespace FondOfOryx\Zed\RepresentativeCompanyUserRestApi\Dependency\Facade;

use Generated\Shared\Transfer\RepresentationOfSalesTransfer;

interface RepresentativeCompanyUserRestApiToRepresentativeCompanyUserFacadeInterface
{
    /**
     * @param \Generated\Shared\Transfer\RepresentationOfSalesTransfer $representationOfSalesTransfer
     *
     * @return \Generated\Shared\Transfer\RepresentationOfSalesTransfer
     */
    public function addRepresentationOfSales(RepresentationOfSalesTransfer $representationOfSalesTransfer): RepresentationOfSalesTransfer;
}
