<?php

namespace FondOfOryx\Glue\ReturnLabelsRestApi\Controller;

use Generated\Shared\Transfer\RestReturnLabelRequestAttributesTransfer;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface;
use Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface;
use Spryker\Glue\Kernel\Controller\AbstractController;

/**
 * @package FondOfOryx\Glue\ReturnLabelsRestApi\Controller
 * @method \FondOfOryx\Glue\ReturnLabelsRestApi\ReturnLabelsRestApiFactory getFactory()
 */
class ReturnLabelsRestApiResourceController extends AbstractController
{
    /**
     * @param \Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface $restRequest
     *
     * @return \Generated\Shared\Transfer\ReturnLabelRestApiResponseTransfer
     */
    public function postAction(
        RestRequestInterface $restRequest,
        RestReturnLabelRequestAttributesTransfer $restReturnLabelRequestAttributesTransfer
    ): RestResponseInterface {
        return $this->getFactory()
            ->createReturnLabelProcessor()
            ->getReturnLabel($restRequest, $restReturnLabelRequestAttributesTransfer);
    }
}
