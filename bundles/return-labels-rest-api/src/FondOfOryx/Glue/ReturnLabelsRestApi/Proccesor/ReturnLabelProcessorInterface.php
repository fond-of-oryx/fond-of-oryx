<?php

namespace FondOfOryx\Glue\ReturnLabelsRestApi\Proccesor;

use Generated\Shared\Transfer\RestReturnLabelRequestAttributesTransfer;
use Generated\Shared\Transfer\ReturnLabelRestApiResponseTransfer;
use Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface;

interface ReturnLabelProcessorInterface
{
    /**
     * @param RestRequestInterface $restRequest
     * @param RestReturnLabelRequestAttributesTransfer $restReturnLabelRequestAttributesTransfer
     *
     * @return ReturnLabelRestApiResponseTransfer
     */
    public function getReturnLabel(
        RestRequestInterface $restRequest,
        RestReturnLabelRequestAttributesTransfer $restReturnLabelRequestAttributesTransfer
    ): ReturnLabelRestApiResponseTransfer;
}
