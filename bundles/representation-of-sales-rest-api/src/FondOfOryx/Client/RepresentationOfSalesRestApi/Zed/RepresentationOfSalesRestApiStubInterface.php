<?php

namespace FondOfOryx\Client\RepresentationOfSalesRestApi\Zed;

use Generated\Shared\Transfer\RestRepresentationOfSalesRequestTransfer;
use Generated\Shared\Transfer\RestRepresentationOfSalesResponseTransfer;

interface RepresentationOfSalesRestApiStubInterface
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
