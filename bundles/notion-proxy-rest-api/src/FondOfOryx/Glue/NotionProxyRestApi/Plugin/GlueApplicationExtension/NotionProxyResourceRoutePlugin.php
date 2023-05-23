<?php

namespace FondOfOryx\Glue\NotionProxyRestApi\Plugin\GlueApplicationExtension;

use FondOfOryx\Glue\NotionProxyRestApi\NotionProxyRestApiConfig;
use Generated\Shared\Transfer\RestNotionProxyRequestAttributesTransfer;
use Spryker\Glue\GlueApplicationExtension\Dependency\Plugin\ResourceRouteCollectionInterface;
use Spryker\Glue\GlueApplicationExtension\Dependency\Plugin\ResourceRoutePluginInterface;
use Spryker\Glue\Kernel\AbstractPlugin;

class NotionProxyResourceRoutePlugin extends AbstractPlugin implements ResourceRoutePluginInterface
{
    /**
     * @param \Spryker\Glue\GlueApplicationExtension\Dependency\Plugin\ResourceRouteCollectionInterface $resourceRouteCollection
     *
     * @return \Spryker\Glue\GlueApplicationExtension\Dependency\Plugin\ResourceRouteCollectionInterface
     */
    public function configure(
        ResourceRouteCollectionInterface $resourceRouteCollection
    ): ResourceRouteCollectionInterface {
        $resourceRouteCollection->addPost('post');

        return $resourceRouteCollection;
    }

    /**
     * @return string
     */
    public function getResourceType(): string
    {
        return NotionProxyRestApiConfig::RESOURCE_NOTION_PROXY;
    }

    /**
     * @return string
     */
    public function getController(): string
    {
        return NotionProxyRestApiConfig::CONTROLLER_RESOURCE_NOTION_PROXY;
    }

    /**
     * @return string
     */
    public function getResourceAttributesClassName(): string
    {
        return RestNotionProxyRequestAttributesTransfer::class;
    }
}
