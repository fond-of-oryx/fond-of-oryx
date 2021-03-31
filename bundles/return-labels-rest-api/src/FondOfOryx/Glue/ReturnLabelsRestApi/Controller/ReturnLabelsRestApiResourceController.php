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
     * @param \Generated\Shared\Transfer\RestReturnLabelRequestAttributesTransfer $restReturnLabelRequestAttributesTransfer
     *
     * @return \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface
     */
    public function postAction(
        RestRequestInterface $restRequest,
        RestReturnLabelRequestAttributesTransfer $restReturnLabelRequestAttributesTransfer
    ): RestResponseInterface {
        var_dump($restRequest->getRestUser()->getSurrogateIdentifier());
        var_dump($restRequest->getRestUser()->getNaturalIdentifier());
        die();

        return $this->getFactory()
            ->createReturnLabelProcessor()
            ->getReturnLabel($restRequest, $restReturnLabelRequestAttributesTransfer);
    }
}
