<?php

namespace FondOfOryx\Glue\SplittableCheckoutRestApi\Processor\Customer;

use Generated\Shared\Transfer\RestCustomerTransfer;
use Generated\Shared\Transfer\RestSplittableCheckoutRequestAttributesTransfer;
use Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface;

interface CustomerMapperInterface
{
    /**
     * @param \Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface $restRequest
     * @param \Generated\Shared\Transfer\RestSplittableCheckoutRequestAttributesTransfer $restSplittableCheckoutRequestAttributesTransfer
     *
     * @return \Generated\Shared\Transfer\RestCustomerTransfer
     */
    public function mapRestCustomerTransferFromRestSplittableCheckoutRequest(
        RestRequestInterface $restRequest,
        RestSplittableCheckoutRequestAttributesTransfer $restSplittableCheckoutRequestAttributesTransfer
    ): RestCustomerTransfer;
}
