<?php

namespace FondOfOryx\Glue\ErpOrderPageSearchRestApi\Plugin\GlueApplicationExtension;

use FondOfOryx\Glue\ErpOrderPageSearchRestApi\ErpOrderPageSearchRestApiConfig;
use Generated\Shared\Transfer\RestErpOrderPageSearchRequestAttributesTransfer;
use Spryker\Glue\GlueApplicationExtension\Dependency\Plugin\ResourceRouteCollectionInterface;
use Spryker\Glue\GlueApplicationExtension\Dependency\Plugin\ResourceRoutePluginInterface;
use Spryker\Glue\Kernel\AbstractPlugin;

class ErpOrderPageSearchRestApiResourceRoutePlugin extends AbstractPlugin implements ResourceRoutePluginInterface
{
    /**
     * @param \Spryker\Glue\GlueApplicationExtension\Dependency\Plugin\ResourceRouteCollectionInterface $resourceRouteCollection
     *
     * @return \Spryker\Glue\GlueApplicationExtension\Dependency\Plugin\ResourceRouteCollectionInterface
     */
    public function configure(ResourceRouteCollectionInterface $resourceRouteCollection): ResourceRouteCollectionInterface
    {
        $resourceRouteCollection
            ->addGet(ErpOrderPageSearchRestApiConfig::ACTION_ERP_ORDER_PAGE_SEARCH_REST_API_GET);

        return $resourceRouteCollection;
    }

    /**
     * @return string
     */
    public function getResourceType(): string
    {
        return ErpOrderPageSearchRestApiConfig::RESOURCE_ERP_ORDER_PAGE_SEARCH_REST_API;
    }

    /**
     * @return string
     */
    public function getController(): string
    {
        return ErpOrderPageSearchRestApiConfig::CONTROLLER_ERP_ORDER_PAGE_SEARCH_REST_API;
    }

    /**
     * @return string
     */
    public function getResourceAttributesClassName(): string
    {
        return RestErpOrderPageSearchRequestAttributesTransfer::class;
    }
}
