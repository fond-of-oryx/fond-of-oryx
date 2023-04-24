<?php

namespace FondOfOryx\Client\RepresentativeCompanyUserRestApi\Zed;

use Generated\Shared\Transfer\RestRepresentationOfSalesRequestTransfer;
use Generated\Shared\Transfer\RestRepresentationOfSalesResponseTransfer;

interface RepresentativeCompanyUserRestApiStubInterface
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
