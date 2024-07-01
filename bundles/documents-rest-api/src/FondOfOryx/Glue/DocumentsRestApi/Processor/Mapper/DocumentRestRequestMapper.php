<?php

namespace FondOfOryx\Glue\DocumentsRestApi\Processor\Mapper;

use FondOfOryx\Glue\DocumentsRestApi\Processor\Expander\DocumentRestRequestExpanderInterface;
use Generated\Shared\Transfer\DocumentRestRequestTransfer;
use Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface;

class DocumentRestRequestMapper implements DocumentRestRequestMapperInterface
{
    /**
     * @var \FondOfOryx\Glue\DocumentsRestApi\Processor\Expander\DocumentRestRequestExpanderInterface
     */
    protected DocumentRestRequestExpanderInterface $documentRestRequestExpander;

    /**
     * @param \FondOfOryx\Glue\DocumentsRestApi\Processor\Expander\DocumentRestRequestExpanderInterface $documentRestRequestExpander
     */
    public function __construct(
        DocumentRestRequestExpanderInterface $documentRestRequestExpander
    ) {
        $this->documentRestRequestExpander = $documentRestRequestExpander;
    }

    /**
     * @param \Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface $restRequest
     *
     * @return \Generated\Shared\Transfer\DocumentRestRequestTransfer
     */
    public function fromRestRequest(RestRequestInterface $restRequest): DocumentRestRequestTransfer
    {
        return $this->documentRestRequestExpander->expand($restRequest, new DocumentRestRequestTransfer());
    }
}
