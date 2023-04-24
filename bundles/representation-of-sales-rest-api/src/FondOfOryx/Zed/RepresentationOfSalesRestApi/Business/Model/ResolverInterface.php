<?php

namespace FondOfOryx\Zed\RepresentationOfSalesRestApi\Business\Model;

use Generated\Shared\Transfer\RestRepresentationOfSalesOriginatorRequestTransfer;
use Generated\Shared\Transfer\RestRepresentationOfSalesOriginatorResponseTransfer;

interface ResolverInterface
{
    /**
     * @param \Generated\Shared\Transfer\RestRepresentationOfSalesOriginatorRequestTransfer $restRepresentationOfSalesOriginatorRequestTransfer
     *
     * @return \Generated\Shared\Transfer\RestRepresentationOfSalesOriginatorResponseTransfer
     */
    public function resolveOriginator(RestRepresentationOfSalesOriginatorRequestTransfer $restRepresentationOfSalesOriginatorRequestTransfer): RestRepresentationOfSalesOriginatorResponseTransfer;
}