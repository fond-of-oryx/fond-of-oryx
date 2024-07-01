<?php

namespace FondOfOryx\Glue\DocumentsRestApi\Processor\Expander;

use FondOfOryx\Glue\DocumentsRestApi\Dependency\Plugin\DocumentRestRequestExpanderPluginInterface;
use Generated\Shared\Transfer\DocumentRestRequestTransfer;
use Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface;

class CustomerReferenceExpanderPlugin implements DocumentRestRequestExpanderPluginInterface
{
    /**
     * @param \Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface $restRequest
     * @param \Generated\Shared\Transfer\DocumentRestRequestTransfer $documentRestRequestTransfer
     *
     * @return \Generated\Shared\Transfer\DocumentRestRequestTransfer
     */
    public function expand(RestRequestInterface $restRequest, DocumentRestRequestTransfer $documentRestRequestTransfer): DocumentRestRequestTransfer
    {
        $getUserMethod = 'getUser';

        if (method_exists($restRequest, 'getRestUser')) {
            $getUserMethod = 'getRestUser';
        }

        if ($restRequest->$getUserMethod() === null) {
            return $documentRestRequestTransfer;
        }

        /** @var \Generated\Shared\Transfer\RestUserTransfer|\Spryker\Glue\GlueApplication\Rest\Request\Data\UserInterface $restUser */
        $restUser = $restRequest->$getUserMethod();

        return $documentRestRequestTransfer->setCustomerReference($restUser->getNaturalIdentifier());
    }
}
