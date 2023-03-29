<?php

namespace FondOfOryx\Glue\BusinessOnBehalfRestApi\Plugin\GlueApplicationExtension;

use FondOfOryx\Glue\BusinessOnBehalfRestApi\BusinessOnBehalfRestApiConfig;
use Generated\Shared\Transfer\RestBusinessOnBehalfRequestAttributesTransfer;
use Spryker\Glue\GlueApplicationExtension\Dependency\Plugin\ResourceRouteCollectionInterface;
use Spryker\Glue\GlueApplicationExtension\Dependency\Plugin\ResourceRoutePluginInterface;
use Spryker\Glue\Kernel\AbstractPlugin;

class BusinessOnBehalfResourceRoutePlugin extends AbstractPlugin implements ResourceRoutePluginInterface
{
    /**
     * @param \Spryker\Glue\GlueApplicationExtension\Dependency\Plugin\ResourceRouteCollectionInterface $resourceRouteCollection
     *
     * @return \Spryker\Glue\GlueApplicationExtension\Dependency\Plugin\ResourceRouteCollectionInterface
     */
    public function configure(ResourceRouteCollectionInterface $resourceRouteCollection): ResourceRouteCollectionInterface
    {
        $resourceRouteCollection->addPost('post');

        return $resourceRouteCollection;
    }

    /**
     * @return string
     */
    public function getResourceType(): string
    {
        return BusinessOnBehalfRestApiConfig::RESOURCE_BUSINESS_ON_BEHALF;
    }

    /**
     * @return string
     */
    public function getController(): string
    {
        return BusinessOnBehalfRestApiConfig::CONTROLLER_BUSINESS_ON_BEHALF;
    }

    /**
     * @return string
     */
    public function getResourceAttributesClassName(): string
    {
        return RestBusinessOnBehalfRequestAttributesTransfer::class;
    }
}
