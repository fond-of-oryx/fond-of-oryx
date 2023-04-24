<?php

namespace FondOfOryx\Zed\RepresentationOfSalesRestApi\Dependency\Facade;

use Generated\Shared\Transfer\RepresentationOfSalesTransfer;

interface RepresentationOfSalesRestApiToRepresentationOfSalesFacadeInterface
{
    /**
     * @param \Generated\Shared\Transfer\RepresentationOfSalesTransfer $representationOfSalesTransfer
     *
     * @return \Generated\Shared\Transfer\RepresentationOfSalesTransfer
     */
    public function addRepresentationOfSales(RepresentationOfSalesTransfer $representationOfSalesTransfer): RepresentationOfSalesTransfer;
}
