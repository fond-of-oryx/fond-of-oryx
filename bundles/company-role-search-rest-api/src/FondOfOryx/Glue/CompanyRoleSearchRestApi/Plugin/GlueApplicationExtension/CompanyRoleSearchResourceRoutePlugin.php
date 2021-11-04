<?php

namespace FondOfOryx\Glue\CompanyRoleSearchRestApi\Plugin\GlueApplicationExtension;

use FondOfOryx\Glue\CompanyRoleSearchRestApi\CompanyRoleSearchRestApiConfig;
use Generated\Shared\Transfer\RestCompanyRoleSearchAttributesTransfer;
use Spryker\Glue\GlueApplicationExtension\Dependency\Plugin\ResourceRouteCollectionInterface;
use Spryker\Glue\GlueApplicationExtension\Dependency\Plugin\ResourceRoutePluginInterface;
use Spryker\Glue\Kernel\AbstractPlugin;

class CompanyRoleSearchResourceRoutePlugin extends AbstractPlugin implements ResourceRoutePluginInterface
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
        return CompanyRoleSearchRestApiConfig::RESOURCE_COMPANY_ROLE_SEARCH;
    }

    /**
     * @return string
     */
    public function getController(): string
    {
        return CompanyRoleSearchRestApiConfig::CONTROLLER_RESOURCE_COMPANY_ROLE_SEARCH;
    }

    /**
     * @return string
     */
    public function getResourceAttributesClassName(): string
    {
        return RestCompanyRoleSearchAttributesTransfer::class;
    }
}
