<?php

namespace FondOfOryx\Glue\BusinessOnBehalfRestApi\Processor\BusinessOnBehalf;

use Generated\Shared\Transfer\RestBusinessOnBehalfRequestAttributesTransfer;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface;
use Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface;

interface BusinessOnBehalfProcessorInterface
{
    /**
     * @param \Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface $restRequest
     * @param \Generated\Shared\Transfer\RestBusinessOnBehalfRequestAttributesTransfer $restBusinessOnBehalfRequestAttributesTransfer
     *
     * @return \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface
     */
    public function setDefaultCompanyUser(
        RestRequestInterface $restRequest,
        RestBusinessOnBehalfRequestAttributesTransfer $restBusinessOnBehalfRequestAttributesTransfer
    ): RestResponseInterface;
}
