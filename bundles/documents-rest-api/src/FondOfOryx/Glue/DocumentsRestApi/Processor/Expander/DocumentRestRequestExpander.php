<?php

namespace FondOfOryx\Glue\DocumentsRestApi\Processor\Expander;

use Generated\Shared\Transfer\DocumentRestRequestTransfer;
use Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface;

class DocumentRestRequestExpander implements DocumentRestRequestExpanderInterface
{
    /**
     * @var array<\FondOfOryx\Glue\DocumentsRestApi\Dependency\Plugin\DocumentRestRequestExpanderPluginInterface>
     */
    protected array $documentRestRequestExpanderPlugins;

    /**
     * @param array<\FondOfOryx\Glue\DocumentsRestApi\Dependency\Plugin\DocumentRestRequestExpanderPluginInterface> $documentRestRequestExpanderPlugins
     */
    public function __construct(array $documentRestRequestExpanderPlugins)
    {
        $this->documentRestRequestExpanderPlugins = $documentRestRequestExpanderPlugins;
    }

    /**
     * @param \Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface $restRequest
     * @param \Generated\Shared\Transfer\DocumentRestRequestTransfer $documentRestRequestTransfer
     *
     * @return \Generated\Shared\Transfer\DocumentRestRequestTransfer
     */
    public function expand(RestRequestInterface $restRequest, DocumentRestRequestTransfer $documentRestRequestTransfer): DocumentRestRequestTransfer
    {
        foreach ($this->documentRestRequestExpanderPlugins as $documentRestRequestExpanderPlugin) {
            $documentRestRequestExpanderPlugin->expand($restRequest, $documentRestRequestTransfer);
        }

        return $documentRestRequestTransfer;
    }
}
