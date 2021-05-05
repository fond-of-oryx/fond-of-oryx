<?php

namespace FondOfOryx\Glue\SplittableTotalsRestApi\Plugin\GlueApplicationExtension;

use FondOfOryx\Glue\SplittableTotalsRestApi\SplittableTotalsRestApiConfig;
use Generated\Shared\Transfer\RestSplittableTotalsRequestAttributesTransfer;
use Spryker\Glue\GlueApplicationExtension\Dependency\Plugin\ResourceRouteCollectionInterface;
use Spryker\Glue\GlueApplicationExtension\Dependency\Plugin\ResourceRoutePluginInterface;
use Spryker\Glue\Kernel\AbstractPlugin;

class SplittableTotalsRestApiResourceRoutePlugin extends AbstractPlugin implements ResourceRoutePluginInterface
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
        return SplittableTotalsRestApiConfig::RESOURCE_SPLITTABLE_TOTALS;
    }

    /**
     * @return string
     */
    public function getController(): string
    {
        return SplittableTotalsRestApiConfig::CONTROLLER_SPLITTABLE_TOTALS;
    }

    /**
     * @return string
     */
    public function getResourceAttributesClassName(): string
    {
        return RestSplittableTotalsRequestAttributesTransfer::class;
    }
}
