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
     * @param RestRequestInterface $restRequest
     *
     * @return RestResponseInterface
     */
    public function postAction(
        RestRequestInterface $restRequest,
        RestReturnLabelRequestAttributesTransfer $restReturnLabelRequestAttributesTransfer
    ): RestResponseInterface {
        var_dump($restRequest->getRestUser()->getNaturalIdentifier());
        var_dump($restRequest->getRestUser()->getSurrogateIdentifier());
        var_dump($restReturnLabelRequestAttributesTransfer->getCompanyUnitAddressUuid());

        $this->getFactory()
            ->createReturnLabelProcessor()
            ->getReturnLabel($restRequest, $restReturnLabelRequestAttributesTransfer);

        die();
    }
}
