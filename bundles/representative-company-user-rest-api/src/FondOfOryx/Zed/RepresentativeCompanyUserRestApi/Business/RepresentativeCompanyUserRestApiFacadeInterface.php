<?php

namespace FondOfOryx\Zed\RepresentativeCompanyUserRestApi\Business;

use Generated\Shared\Transfer\RestRepresentationOfSalesRequestTransfer;
use Generated\Shared\Transfer\RestRepresentationOfSalesResponseTransfer;

interface RepresentativeCompanyUserRestApiFacadeInterface
{
    /**
     * @param \Generated\Shared\Transfer\RestRepresentationOfSalesRequestTransfer $restRepresentationOfSalesRequestTransfer
     *
     * @return \Generated\Shared\Transfer\RestRepresentationOfSalesResponseTransfer
     */
    public function addRepresentation(
        RestRepresentationOfSalesRequestTransfer $restRepresentationOfSalesRequestTransfer
    ): RestRepresentationOfSalesResponseTransfer;
}
