<?php

namespace FondOfOryx\Glue\CompanySearchRestApi\Plugin\GlueApplicationExtension;

use FondOfOryx\Glue\CompanySearchRestApi\CompanySearchRestApiConfig;
use Generated\Shared\Transfer\RestCompanySearchAttributesTransfer;
use Spryker\Glue\GlueApplicationExtension\Dependency\Plugin\ResourceRouteCollectionInterface;
use Spryker\Glue\GlueApplicationExtension\Dependency\Plugin\ResourceRoutePluginInterface;
use Spryker\Glue\Kernel\AbstractPlugin;

class CompanySearchResourceRoutePlugin extends AbstractPlugin implements ResourceRoutePluginInterface
{
    /**
     * @param \Spryker\Glue\GlueApplicationExtension\Dependency\Plugin\ResourceRouteCollectionInterface $resourceRouteCollection
     *
     * @return \Spryker\Glue\GlueApplicationExtension\Dependency\Plugin\ResourceRouteCollectionInterface
     */
    public function configure(ResourceRouteCollectionInterface $resourceRouteCollection): ResourceRouteCollectionInterface
    {
        return $resourceRouteCollection->addGet('get');
    }

    /**
     * @return string
     */
    public function getResourceType(): string
    {
        return CompanySearchRestApiConfig::RESOURCE_COMPANY_SEARCH;
    }

    /**
     * @return string
     */
    public function getController(): string
    {
        return CompanySearchRestApiConfig::CONTROLLER_RESOURCE_COMPANY_SEARCH;
    }

    /**
     * @return string
     */
    public function getResourceAttributesClassName(): string
    {
        return RestCompanySearchAttributesTransfer::class;
    }
}
