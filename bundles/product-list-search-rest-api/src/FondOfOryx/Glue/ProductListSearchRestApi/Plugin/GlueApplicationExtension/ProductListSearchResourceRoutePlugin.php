<?php

namespace FondOfOryx\Glue\ProductListSearchRestApi\Plugin\GlueApplicationExtension;

use FondOfOryx\Glue\ProductListSearchRestApi\ProductListSearchRestApiConfig;
use Generated\Shared\Transfer\RestProductListSearchAttributesTransfer;
use Spryker\Glue\GlueApplicationExtension\Dependency\Plugin\ResourceRouteCollectionInterface;
use Spryker\Glue\GlueApplicationExtension\Dependency\Plugin\ResourceRoutePluginInterface;
use Spryker\Glue\Kernel\AbstractPlugin;

class ProductListSearchResourceRoutePlugin extends AbstractPlugin implements ResourceRoutePluginInterface
{
    /**
     * @param \Spryker\Glue\GlueApplicationExtension\Dependency\Plugin\ResourceRouteCollectionInterface $resourceRouteCollection
     *
     * @return \Spryker\Glue\GlueApplicationExtension\Dependency\Plugin\ResourceRouteCollectionInterface
     */
    public function configure(ResourceRouteCollectionInterface $resourceRouteCollection): ResourceRouteCollectionInterface
    {
        return $resourceRouteCollection->addGet('get');
    }

    /**
     * @return string
     */
    public function getResourceType(): string
    {
        return ProductListSearchRestApiConfig::RESOURCE_PRODUCT_LIST_SEARCH;
    }

    /**
     * @return string
     */
    public function getController(): string
    {
        return ProductListSearchRestApiConfig::CONTROLLER_RESOURCE_PRODUCT_LIST_SEARCH;
    }

    /**
     * @return string
     */
    public function getResourceAttributesClassName(): string
    {
        return RestProductListSearchAttributesTransfer::class;
    }
}
