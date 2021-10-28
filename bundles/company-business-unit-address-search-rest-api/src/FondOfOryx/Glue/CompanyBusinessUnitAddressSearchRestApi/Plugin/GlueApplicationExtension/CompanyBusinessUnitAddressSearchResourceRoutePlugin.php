<?php

namespace FondOfOryx\Glue\CompanyBusinessUnitAddressSearchRestApi\Plugin\GlueApplicationExtension;

use FondOfOryx\Glue\CompanyBusinessUnitAddressSearchRestApi\CompanyBusinessUnitAddressSearchRestApiConfig;
use Generated\Shared\Transfer\RestCompanyBusinessUnitAddressSearchAttributesTransfer;
use Spryker\Glue\GlueApplicationExtension\Dependency\Plugin\ResourceRouteCollectionInterface;
use Spryker\Glue\GlueApplicationExtension\Dependency\Plugin\ResourceRoutePluginInterface;
use Spryker\Glue\Kernel\AbstractPlugin;

class CompanyBusinessUnitAddressSearchResourceRoutePlugin extends AbstractPlugin implements ResourceRoutePluginInterface
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
        return CompanyBusinessUnitAddressSearchRestApiConfig::RESOURCE_COMPANY_BUSINESS_UNIT_ADDRESS_SEARCH;
    }

    /**
     * @return string
     */
    public function getController(): string
    {
        return CompanyBusinessUnitAddressSearchRestApiConfig::CONTROLLER_RESOURCE_COMPANY_BUSINESS_UNIT_ADDRESS_SEARCH;
    }

    /**
     * @return string
     */
    public function getResourceAttributesClassName(): string
    {
        return RestCompanyBusinessUnitAddressSearchAttributesTransfer::class;
    }
}
