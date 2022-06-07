<?php

namespace FondOfOryx\Glue\CartSearchRestApi\Plugin\GlueApplicationExtension;

use FondOfOryx\Glue\CartSearchRestApi\CartSearchRestApiConfig;
use Generated\Shared\Transfer\RestCartSearchAttributesTransfer;
use Spryker\Glue\GlueApplicationExtension\Dependency\Plugin\ResourceRouteCollectionInterface;
use Spryker\Glue\GlueApplicationExtension\Dependency\Plugin\ResourceRoutePluginInterface;
use Spryker\Glue\Kernel\AbstractPlugin;

class CartSearchResourceRoutePlugin extends AbstractPlugin implements ResourceRoutePluginInterface
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
        return CartSearchRestApiConfig::RESOURCE_CART_SEARCH;
    }

    /**
     * @return string
     */
    public function getController(): string
    {
        return CartSearchRestApiConfig::CONTROLLER_RESOURCE_CART_SEARCH;
    }

    /**
     * @return string
     */
    public function getResourceAttributesClassName(): string
    {
        return RestCartSearchAttributesTransfer::class;
    }
}
