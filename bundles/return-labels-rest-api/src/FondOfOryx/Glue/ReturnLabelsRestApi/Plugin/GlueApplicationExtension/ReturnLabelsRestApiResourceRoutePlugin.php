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
     * @api
     *
     * Specification:
     *  - Configuration for resource routing, how http methods map to controller actions, is action is protected, also possible
     * to add additional contextual data for action for later access when processing controller action.
     *
     * @param \Spryker\Glue\GlueApplicationExtension\Dependency\Plugin\ResourceRouteCollectionInterface $resourceRouteCollection
     *
     * @return \Spryker\Glue\GlueApplicationExtension\Dependency\Plugin\ResourceRouteCollectionInterface
     */
    public function configure(ResourceRouteCollectionInterface $resourceRouteCollection): ResourceRouteCollectionInterface
    {
        $resourceRouteCollection->addGet(ReturnLabelsRestApiConfig::ACTION_RETURN_LABELS_REST_API_GET, true);

        return $resourceRouteCollection;
    }

    /**
     * @api
     *
     * Specification:
     *  - Resource name this plugins handles, must be plural string. This name also is matched with request path where resource
     * is provided.
     *
     * @return string
     */
    public function getResourceType(): string
    {
        return ReturnLabelsRestApiConfig::RESOURCE_RETURN_LABELS_REST_API;
    }

    /**
     * @api
     *
     * Specification:
     *  - Module controller name, separated by dashes. cart-items-resource would point to CartItemsResourceController
     *
     * @return string
     */
    public function getController(): string
    {
        return ReturnLabelsRestApiConfig::CONTROLLER_RETURN_LABELS_REST_API;
    }

    /**
     * @api
     *
     * Specification:
     *  - This method should return FQCN to transfer object. This object will be automatically populated from POST/PATCH
     * requests, and passed to REST controller actions as first argument. It is also used when creating JSONAPI resource objects.
     *
     * @return string
     */
    public function getResourceAttributesClassName(): string
    {
        return RestReturnLabelRequestAttributesTransfer::class;
    }
}
