<?php

namespace FondOfOryx\Glue\DocumentsRestApi\Processor\Expander;

use Generated\Shared\Transfer\DocumentRestRequestTransfer;
use Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface;

class IdExpanderPlugin extends AbstractRequestParameterExpanderPlugin
{
    /**
     * @param \Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface $restRequest
     * @param \Generated\Shared\Transfer\DocumentRestRequestTransfer $documentRestRequestTransfer
     *
     * @return \Generated\Shared\Transfer\DocumentRestRequestTransfer
     */
    public function expand(RestRequestInterface $restRequest, DocumentRestRequestTransfer $documentRestRequestTransfer): DocumentRestRequestTransfer
    {
        return $documentRestRequestTransfer->setId($this->getRequestParameter($restRequest, 'id'));
    }
}
