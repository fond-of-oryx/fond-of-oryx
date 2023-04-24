<?php

namespace FondOfOryx\Zed\RepresentationOfSalesRestApi\Business;

use Generated\Shared\Transfer\RestRepresentationOfSalesRequestTransfer;
use Generated\Shared\Transfer\RestRepresentationOfSalesResponseTransfer;

interface RepresentationOfSalesRestApiFacadeInterface
{
    /**
     * @param \Generated\Shared\Transfer\RestRepresentationOfSalesRequestTransfer $restRepresentationOfSalesRequestTransfer
     *
     * @return \Generated\Shared\Transfer\RestRepresentationOfSalesResponseTransfer
     */
    public function addRepresentation(RestRepresentationOfSalesRequestTransfer $restRepresentationOfSalesRequestTransfer): RestRepresentationOfSalesResponseTransfer;
}
