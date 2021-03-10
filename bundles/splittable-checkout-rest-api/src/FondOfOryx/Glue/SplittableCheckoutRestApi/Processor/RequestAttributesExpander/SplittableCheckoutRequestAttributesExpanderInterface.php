<?php

namespace FondOfOryx\Glue\SplittableCheckoutRestApi\Processor\RequestAttributesExpander;

use Generated\Shared\Transfer\RestSplittableCheckoutRequestAttributesTransfer;
use Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface;

interface SplittableCheckoutRequestAttributesExpanderInterface
{
    /**
     * @param \Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface $restRequest
     * @param \Generated\Shared\Transfer\RestSplittableCheckoutRequestAttributesTransfer $splittableCheckoutRequestAttributesTransfer
     *
     * @return \Generated\Shared\Transfer\RestSplittableCheckoutRequestAttributesTransfer
     */
    public function expandSplittableCheckoutRequestAttributes(
        RestRequestInterface $restRequest,
        RestSplittableCheckoutRequestAttributesTransfer $splittableCheckoutRequestAttributesTransfer
    ): RestSplittableCheckoutRequestAttributesTransfer;
}
