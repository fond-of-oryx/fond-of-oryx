<?php

namespace FondOfOryx\Glue\DocumentsRestApi\Plugin\GlueApplicationExtension;

use FondOfOryx\Glue\DocumentsRestApi\DocumentsRestApiConfig;
use Generated\Shared\Transfer\DocumentRestRequestTransfer;
use Spryker\Glue\GlueApplicationExtension\Dependency\Plugin\ResourceRouteCollectionInterface;
use Spryker\Glue\GlueApplicationExtension\Dependency\Plugin\ResourceRoutePluginInterface;
use Spryker\Glue\Kernel\AbstractPlugin;

class DocumentsResourceRoutePlugin extends AbstractPlugin implements ResourceRoutePluginInterface
{
    /**
     * @param \Spryker\Glue\GlueApplicationExtension\Dependency\Plugin\ResourceRouteCollectionInterface $resourceRouteCollection
     *
     * @return \Spryker\Glue\GlueApplicationExtension\Dependency\Plugin\ResourceRouteCollectionInterface
     */
    public function configure(ResourceRouteCollectionInterface $resourceRouteCollection): ResourceRouteCollectionInterface
    {
        return $resourceRouteCollection
            ->addGet('get');
    }

    /**
     * @return string
     */
    public function getResourceType(): string
    {
        return DocumentsRestApiConfig::RESOURCE_DOCUMENTS_API;
    }

    /**
     * @return string
     */
    public function getController(): string
    {
        return DocumentsRestApiConfig::CONTROLLER_RESOURCE_DOCUMENTS_API;
    }

    /**
     * @return string
     */
    public function getResourceAttributesClassName(): string
    {
        return DocumentRestRequestTransfer::class;
    }
}
