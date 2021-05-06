<?php

namespace FondOfOryx\Glue\ReturnLabelsRestApi\Processor\Expander;

use Generated\Shared\Transfer\RestReturnLabelRequestTransfer;
use Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface;

interface RestReturnLabelRequestExpanderInterface
{
    /**
     * @param \Generated\Shared\Transfer\RestReturnLabelRequestTransfer $restReturnLabelRequestTransfer
     * @param \Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface $restRequest
     *
     * @return \Generated\Shared\Transfer\RestReturnLabelRequestTransfer
     */
    public function expand(
        RestReturnLabelRequestTransfer $restReturnLabelRequestTransfer,
        RestRequestInterface $restRequest
    ): RestReturnLabelRequestTransfer;
}
