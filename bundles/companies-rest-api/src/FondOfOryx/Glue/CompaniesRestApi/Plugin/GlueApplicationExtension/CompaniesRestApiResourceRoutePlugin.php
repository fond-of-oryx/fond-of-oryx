<?php

namespace FondOfOryx\Glue\CompaniesRestApi\Plugin\GlueApplicationExtension;

use FondOfOryx\Glue\CompaniesRestApi\CompaniesRestApiConfig;
use Generated\Shared\Transfer\RestCompaniesRestApiAttributesTransfer;
use Spryker\Glue\GlueApplicationExtension\Dependency\Plugin\ResourceRouteCollectionInterface;
use Spryker\Glue\GlueApplicationExtension\Dependency\Plugin\ResourceRoutePluginInterface;
use Spryker\Glue\Kernel\AbstractPlugin;

class CompaniesRestApiResourceRoutePlugin extends AbstractPlugin implements ResourceRoutePluginInterface
{
    /**
     * @param \Spryker\Glue\GlueApplicationExtension\Dependency\Plugin\ResourceRouteCollectionInterface $resourceRouteCollection
     *
     * @return \Spryker\Glue\GlueApplicationExtension\Dependency\Plugin\ResourceRouteCollectionInterface
     */
    public function configure(ResourceRouteCollectionInterface $resourceRouteCollection): ResourceRouteCollectionInterface
    {
        return $resourceRouteCollection->addDelete('delete');
    }

    /**
     * @return string
     */
    public function getResourceType(): string
    {
        return CompaniesRestApiConfig::RESOURCE_COMPANIES_REST_API;
    }

    /**
     * @return string
     */
    public function getController(): string
    {
        return CompaniesRestApiConfig::CONTROLLER_RESOURCE_COMPANIES_REST_API;
    }

    /**
     * @return string
     */
    public function getResourceAttributesClassName(): string
    {
        return RestCompaniesRestApiAttributesTransfer::class;
    }
}
