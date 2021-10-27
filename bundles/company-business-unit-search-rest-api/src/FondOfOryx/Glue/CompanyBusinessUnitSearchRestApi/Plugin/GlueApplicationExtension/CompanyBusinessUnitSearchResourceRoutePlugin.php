<?php

namespace FondOfOryx\Glue\CompanyBusinessUnitSearchRestApi\Plugin\GlueApplicationExtension;

use FondOfOryx\Glue\CompanyBusinessUnitSearchRestApi\CompanyBusinessUnitSearchRestApiConfig;
use Generated\Shared\Transfer\RestCompanyBusinessUnitSearchAttributesTransfer;
use Spryker\Glue\GlueApplicationExtension\Dependency\Plugin\ResourceRouteCollectionInterface;
use Spryker\Glue\GlueApplicationExtension\Dependency\Plugin\ResourceRoutePluginInterface;
use Spryker\Glue\Kernel\AbstractPlugin;

class CompanyBusinessUnitSearchResourceRoutePlugin extends AbstractPlugin implements ResourceRoutePluginInterface
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
        return CompanyBusinessUnitSearchRestApiConfig::RESOURCE_COMPANY_BUSINESS_UNIT_SEARCH;
    }

    /**
     * @return string
     */
    public function getController(): string
    {
        return CompanyBusinessUnitSearchRestApiConfig::CONTROLLER_RESOURCE_COMPANY_BUSINESS_UNIT_SEARCH;
    }

    /**
     * @return string
     */
    public function getResourceAttributesClassName(): string
    {
        return RestCompanyBusinessUnitSearchAttributesTransfer::class;
    }
}
