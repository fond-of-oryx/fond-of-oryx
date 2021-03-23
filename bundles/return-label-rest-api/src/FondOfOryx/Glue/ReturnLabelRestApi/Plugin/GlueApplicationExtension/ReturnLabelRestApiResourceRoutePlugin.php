<?php

namespace FondOfOryx\Glue\ReturnLabelRestApi\Plugin\GlueApplicationExtension;

use FondOfOryx\Glue\ReturnLabelRestApi\ReturnLabelRestApiConfig;
use Generated\Shared\Transfer\RestReturnLabelRequestAttributesTransfer;
use Spryker\Glue\GlueApplicationExtension\Dependency\Plugin\ResourceRouteCollectionInterface;
use Spryker\Glue\GlueApplicationExtension\Dependency\Plugin\ResourceRoutePluginInterface;
use Spryker\Glue\Kernel\AbstractPlugin;

class ReturnLabelRestApiResourceRoutePlugin extends AbstractPlugin implements ResourceRoutePluginInterface
{

    /**
     * @param \Spryker\Glue\GlueApplicationExtension\Dependency\Plugin\ResourceRouteCollectionInterface $resourceRouteCollection
     *
     * @return \Spryker\Glue\GlueApplicationExtension\Dependency\Plugin\ResourceRouteCollectionInterface
     * @api
     *
     * Specification:
     *  - Configuration for resource routing, how http methods map to controller actions, is action is protected, also possible
     * to add additional contextual data for action for later access when processing controller action.
     *
     */
    public function configure(ResourceRouteCollectionInterface $resourceRouteCollection): ResourceRouteCollectionInterface
    {
        $resourceRouteCollection
            ->addPost(ReturnLabelRestApiConfig::ACTION_RETURN_LABEL_REST_API_POST, true)
            ->addGet(ReturnLabelRestApiConfig::ACTION_RETURN_LABEL_REST_API_GET, true);

        return $resourceRouteCollection;
    }

    /**
     * @return string
     * @api
     *
     * Specification:
     *  - Resource name this plugins handles, must be plural string. This name also is matched with request path where resource
     * is provided.
     *
     */
    public function getResourceType(): string
    {
        return ReturnLabelRestApiConfig::RESOURCE_RETURN_LABEL_REST_API;
    }

    /**
     * @return string
     * @api
     *
     * Specification:
     *  - Module controller name, separated by dashes. cart-items-resource would point to CartItemsResourceController
     *
     */
    public function getController(): string
    {
        return ReturnLabelRestApiConfig::CONTROLLER_RETURN_LABEL_REST_API;
    }

    /**
     * @return string
     * @api
     *
     * Specification:
     *  - This method should return FQCN to transfer object. This object will be automatically populated from POST/PATCH
     * requests, and passed to REST controller actions as first argument. It is also used when creating JSONAPI resource objects.
     *
     */
    public function getResourceAttributesClassName(): string
    {
        return RestReturnLabelRequestAttributesTransfer::class;
    }
}
