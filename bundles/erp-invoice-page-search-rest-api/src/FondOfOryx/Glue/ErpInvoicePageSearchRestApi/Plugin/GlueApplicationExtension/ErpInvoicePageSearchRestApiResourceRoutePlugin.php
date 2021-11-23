<?php

namespace FondOfOryx\Glue\ErpInvoicePageSearchRestApi\Plugin\GlueApplicationExtension;

use FondOfOryx\Glue\ErpInvoicePageSearchRestApi\ErpInvoicePageSearchRestApiConfig;
use Generated\Shared\Transfer\RestErpInvoicePageSearchRequestAttributesTransfer;
use Spryker\Glue\GlueApplicationExtension\Dependency\Plugin\ResourceRouteCollectionInterface;
use Spryker\Glue\GlueApplicationExtension\Dependency\Plugin\ResourceRoutePluginInterface;
use Spryker\Glue\Kernel\AbstractPlugin;

class ErpInvoicePageSearchRestApiResourceRoutePlugin extends AbstractPlugin implements ResourceRoutePluginInterface
{
    /**
     * @param \Spryker\Glue\GlueApplicationExtension\Dependency\Plugin\ResourceRouteCollectionInterface $resourceRouteCollection
     *
     * @return \Spryker\Glue\GlueApplicationExtension\Dependency\Plugin\ResourceRouteCollectionInterface
     */
    public function configure(ResourceRouteCollectionInterface $resourceRouteCollection): ResourceRouteCollectionInterface
    {
        $resourceRouteCollection
            ->addGet(ErpInvoicePageSearchRestApiConfig::ACTION_ERP_INVOICE_PAGE_SEARCH_REST_API_GET);

        return $resourceRouteCollection;
    }

    /**
     * @return string
     */
    public function getResourceType(): string
    {
        return ErpInvoicePageSearchRestApiConfig::RESOURCE_ERP_INVOICE_PAGE_SEARCH_REST_API;
    }

    /**
     * @return string
     */
    public function getController(): string
    {
        return ErpInvoicePageSearchRestApiConfig::CONTROLLER_ERP_INVOICE_PAGE_SEARCH_REST_API;
    }

    /**
     * @return string
     */
    public function getResourceAttributesClassName(): string
    {
        return RestErpInvoicePageSearchRequestAttributesTransfer::class;
    }
}
