<?php

namespace FondOfOryx\Glue\SplittableCheckoutRestApi\Plugin\GlueApplicationExtension;

use FondOfOryx\Glue\SplittableCheckoutRestApi\SplittableCheckoutRestApiConfig;
use Generated\Shared\Transfer\RestSplittableCheckoutRequestAttributesTransfer;
use Spryker\Glue\GlueApplicationExtension\Dependency\Plugin\ResourceRouteCollectionInterface;
use Spryker\Glue\GlueApplicationExtension\Dependency\Plugin\ResourceRoutePluginInterface;
use Spryker\Glue\Kernel\AbstractPlugin;

class SplittableCheckoutResourceRoutePlugin extends AbstractPlugin implements ResourceRoutePluginInterface
{
    /**
     * @param \Spryker\Glue\GlueApplicationExtension\Dependency\Plugin\ResourceRouteCollectionInterface $resourceRouteCollection
     *
     * @return \Spryker\Glue\GlueApplicationExtension\Dependency\Plugin\ResourceRouteCollectionInterface
     */
    public function configure(ResourceRouteCollectionInterface $resourceRouteCollection): ResourceRouteCollectionInterface
    {
        $resourceRouteCollection
            ->addPost('post', false);

        return $resourceRouteCollection;
    }

    /**
     * @return string
     */
    public function getResourceType(): string
    {
        return SplittableCheckoutRestApiConfig::RESOURCE_SPLITTABLE_CHECKOUT;
    }

    /**
     * @return string
     */
    public function getController(): string
    {
        return SplittableCheckoutRestApiConfig::CONTROLLER_SPLITTABLE_CHECKOUT;
    }

    /**
     * @return string
     */
    public function getResourceAttributesClassName(): string
    {
        return RestSplittableCheckoutRequestAttributesTransfer::class;
    }
}
