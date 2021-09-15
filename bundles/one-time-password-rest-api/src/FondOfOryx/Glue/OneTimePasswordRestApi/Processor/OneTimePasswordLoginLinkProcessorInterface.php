<?php

namespace FondOfOryx\Glue\OneTimePasswordRestApi\Processor;

use Generated\Shared\Transfer\RestOneTimePasswordLoginLinkRequestAttributesTransfer;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface;
use Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface;

interface OneTimePasswordLoginLinkProcessorInterface
{
    /**
     * @param \Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface $restRequest
     * @param \Generated\Shared\Transfer\RestOneTimePasswordLoginLinkRequestAttributesTransfer $oneTimePasswordLoignLinkRequestTransfer
     *
     * @return \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface
     */
    public function requestOneTimePasswordEmail(
        RestRequestInterface $restRequest,
        RestOneTimePasswordLoginLinkRequestAttributesTransfer $oneTimePasswordLoignLinkRequestTransfer
    ): RestResponseInterface;
}
