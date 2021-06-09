<?php

namespace FondOfOryx\Glue\SplittableCheckoutRestApi\Processor\Expander;

use Generated\Shared\Transfer\RestSplittableCheckoutRequestTransfer;
use Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface;

interface RestSplittableCheckoutRequestExpanderInterface
{
    /**
     * @param \Generated\Shared\Transfer\RestSplittableCheckoutRequestTransfer $restSplittableCheckoutRequestTransfer
     * @param \Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface $restRequest
     *
     * @return \Generated\Shared\Transfer\RestSplittableCheckoutRequestTransfer
     */
    public function expand(
        RestSplittableCheckoutRequestTransfer $restSplittableCheckoutRequestTransfer,
        RestRequestInterface $restRequest
    ): RestSplittableCheckoutRequestTransfer;
}
