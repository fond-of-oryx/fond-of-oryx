<?php

namespace FondOfOryx\Client\RepresentationOfSalesRestApi;

use Generated\Shared\Transfer\RestRepresentationOfSalesRequestTransfer;
use Generated\Shared\Transfer\RestRepresentationOfSalesResponseTransfer;

interface RepresentationOfSalesRestApiClientInterface
{
    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\RestRepresentationOfSalesRequestTransfer $restRepresentationOfSalesRequestTransfer
     *
     * @return \Generated\Shared\Transfer\RestRepresentationOfSalesResponseTransfer
     */
    public function addRepresentation(RestRepresentationOfSalesRequestTransfer $restRepresentationOfSalesRequestTransfer): RestRepresentationOfSalesResponseTransfer;
}
