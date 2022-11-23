<?php

namespace FondOfOryx\Glue\ProductListsRestApi\Plugin\GlueApplicationExtension;

use FondOfOryx\Glue\ProductListsRestApi\ProductListsRestApiConfig;
use Generated\Shared\Transfer\RestProductListsAttributesTransfer;
use Spryker\Glue\GlueApplicationExtension\Dependency\Plugin\ResourceRouteCollectionInterface;
use Spryker\Glue\GlueApplicationExtension\Dependency\Plugin\ResourceRoutePluginInterface;
use Spryker\Glue\Kernel\AbstractPlugin;

class ProductListsResourceRoutePlugin extends AbstractPlugin implements ResourceRoutePluginInterface
{
    /**
     * @param \Spryker\Glue\GlueApplicationExtension\Dependency\Plugin\ResourceRouteCollectionInterface $resourceRouteCollection
     *
     * @return \Spryker\Glue\GlueApplicationExtension\Dependency\Plugin\ResourceRouteCollectionInterface
     */
    public function configure(ResourceRouteCollectionInterface $resourceRouteCollection): ResourceRouteCollectionInterface
    {
        return $resourceRouteCollection->addPatch('patch');
    }

    /**
     * @return string
     */
    public function getResourceType(): string
    {
        return ProductListsRestApiConfig::RESOURCE_PRODUCT_LISTS;
    }

    /**
     * @return string
     */
    public function getController(): string
    {
        return ProductListsRestApiConfig::CONTROLLER_RESOURCE_PRODUCT_LISTS;
    }

    /**
     * @return string
     */
    public function getResourceAttributesClassName(): string
    {
        return RestProductListsAttributesTransfer::class;
    }
}
