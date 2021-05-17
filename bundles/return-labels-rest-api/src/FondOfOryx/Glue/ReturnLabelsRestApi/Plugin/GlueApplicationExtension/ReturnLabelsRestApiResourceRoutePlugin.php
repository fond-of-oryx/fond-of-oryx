<?php

namespace FondOfOryx\Glue\ReturnLabelsRestApi\Plugin\GlueApplicationExtension;

use FondOfOryx\Glue\ReturnLabelsRestApi\ReturnLabelsRestApiConfig;
use Generated\Shared\Transfer\RestReturnLabelRequestAttributesTransfer;
use Spryker\Glue\GlueApplicationExtension\Dependency\Plugin\ResourceRouteCollectionInterface;
use Spryker\Glue\GlueApplicationExtension\Dependency\Plugin\ResourceRoutePluginInterface;
use Spryker\Glue\Kernel\AbstractPlugin;

class ReturnLabelsRestApiResourceRoutePlugin extends AbstractPlugin implements ResourceRoutePluginInterface
{
    /**
     * @param \Spryker\Glue\GlueApplicationExtension\Dependency\Plugin\ResourceRouteCollectionInterface $resourceRouteCollection
     *
     * @return \Spryker\Glue\GlueApplicationExtension\Dependency\Plugin\ResourceRouteCollectionInterface
     */
    public function configure(ResourceRouteCollectionInterface $resourceRouteCollection): ResourceRouteCollectionInterface
    {
        $resourceRouteCollection->addPost('post', true);

        return $resourceRouteCollection;
    }

    /**
     * @return string
     */
    public function getResourceType(): string
    {
        return ReturnLabelsRestApiConfig::RESOURCE_RETURN_LABELS;
    }

    /**
     * @return string
     */
    public function getController(): string
    {
        return ReturnLabelsRestApiConfig::CONTROLLER_RETURN_LABELS;
    }

    /**
     * @return string
     */
    public function getResourceAttributesClassName(): string
    {
        return RestReturnLabelRequestAttributesTransfer::class;
    }
}
