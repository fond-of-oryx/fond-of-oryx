<?php

namespace FondOfOryx\Glue\DocumentsRestApi\Processor\Expander;

use FondOfOryx\Glue\DocumentsRestApi\Dependency\Plugin\DocumentRestRequestExpanderPluginInterface;
use Generated\Shared\Transfer\DocumentRestRequestTransfer;
use Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface;

abstract class AbstractRequestParameterExpanderPlugin implements DocumentRestRequestExpanderPluginInterface
{
    /**
     * @param \Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface $restRequest
     * @param \Generated\Shared\Transfer\DocumentRestRequestTransfer $documentRestRequestTransfer
     *
     * @return \Generated\Shared\Transfer\DocumentRestRequestTransfer
     */
    abstract public function expand(RestRequestInterface $restRequest, DocumentRestRequestTransfer $documentRestRequestTransfer): DocumentRestRequestTransfer;

    /**
     * @param \Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface $restRequest
     * @param string $parameterName
     *
     * @return string|null
     */
    protected function getRequestParameter(RestRequestInterface $restRequest, string $parameterName): ?string
    {
        $requestParameter = $restRequest->getHttpRequest()->query->get($parameterName);

        if ($requestParameter === null) {
            return null;
        }

        return (string)$requestParameter;
    }
}
