<?php

namespace FondOfOryx\Glue\ErpDeliveryNotePageSearchRestApi\Plugin\GlueApplicationExtension;

use FondOfOryx\Glue\ErpDeliveryNotePageSearchRestApi\ErpDeliveryNotePageSearchRestApiConfig;
use Generated\Shared\Transfer\RestErpDeliveryNotePageSearchRequestAttributesTransfer;
use Spryker\Glue\GlueApplicationExtension\Dependency\Plugin\ResourceRouteCollectionInterface;
use Spryker\Glue\GlueApplicationExtension\Dependency\Plugin\ResourceRoutePluginInterface;
use Spryker\Glue\Kernel\AbstractPlugin;

class ErpDeliveryNotePageSearchRestApiResourceRoutePlugin extends AbstractPlugin implements ResourceRoutePluginInterface
{
    /**
     * @param \Spryker\Glue\GlueApplicationExtension\Dependency\Plugin\ResourceRouteCollectionInterface $resourceRouteCollection
     *
     * @return \Spryker\Glue\GlueApplicationExtension\Dependency\Plugin\ResourceRouteCollectionInterface
     */
    public function configure(ResourceRouteCollectionInterface $resourceRouteCollection): ResourceRouteCollectionInterface
    {
        $resourceRouteCollection
            ->addGet(ErpDeliveryNotePageSearchRestApiConfig::ACTION_ERP_DELIVERY_NOTE_PAGE_SEARCH_REST_API_GET);

        return $resourceRouteCollection;
    }

    /**
     * @return string
     */
    public function getResourceType(): string
    {
        return ErpDeliveryNotePageSearchRestApiConfig::RESOURCE_ERP_DELIVERY_NOTE_PAGE_SEARCH_REST_API;
    }

    /**
     * @return string
     */
    public function getController(): string
    {
        return ErpDeliveryNotePageSearchRestApiConfig::CONTROLLER_ERP_DELIVERY_NOTE_PAGE_SEARCH_REST_API;
    }

    /**
     * @return string
     */
    public function getResourceAttributesClassName(): string
    {
        return RestErpDeliveryNotePageSearchRequestAttributesTransfer::class;
    }
}
