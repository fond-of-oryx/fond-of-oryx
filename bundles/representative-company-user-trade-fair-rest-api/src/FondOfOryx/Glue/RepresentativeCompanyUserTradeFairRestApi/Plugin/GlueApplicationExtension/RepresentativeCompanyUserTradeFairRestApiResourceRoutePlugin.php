<?php

namespace FondOfOryx\Glue\RepresentativeCompanyUserTradeFairRestApi\Plugin\GlueApplicationExtension;

use FondOfOryx\Glue\RepresentativeCompanyUserTradeFairRestApi\RepresentativeCompanyUserTradeFairRestApiConfig;
use Generated\Shared\Transfer\RestRepresentativeCompanyUserTradeFairAttributesTransfer;
use Spryker\Glue\GlueApplicationExtension\Dependency\Plugin\ResourceRouteCollectionInterface;
use Spryker\Glue\GlueApplicationExtension\Dependency\Plugin\ResourceRoutePluginInterface;
use Spryker\Glue\Kernel\AbstractPlugin;

class RepresentativeCompanyUserTradeFairRestApiResourceRoutePlugin extends AbstractPlugin implements ResourceRoutePluginInterface
{
    /**
     * @param \Spryker\Glue\GlueApplicationExtension\Dependency\Plugin\ResourceRouteCollectionInterface $resourceRouteCollection
     *
     * @return \Spryker\Glue\GlueApplicationExtension\Dependency\Plugin\ResourceRouteCollectionInterface
     */
    public function configure(ResourceRouteCollectionInterface $resourceRouteCollection): ResourceRouteCollectionInterface
    {
        return $resourceRouteCollection
            ->addPost('add')
            ->addPatch('patch')
            ->addDelete('delete')
            ->addGet('get');
    }

    /**
     * @return string
     */
    public function getResourceType(): string
    {
        return RepresentativeCompanyUserTradeFairRestApiConfig::RESOURCE_REPRESENTATIVE_COMPANY_USER_TRADE_FAIR_REST_API;
    }

    /**
     * @return string
     */
    public function getController(): string
    {
        return RepresentativeCompanyUserTradeFairRestApiConfig::CONTROLLER_RESOURCE_REPRESENTATIVE_COMPANY_USER_TRADE_FAIR_REST_API;
    }

    /**
     * @return string
     */
    public function getResourceAttributesClassName(): string
    {
        return RestRepresentativeCompanyUserTradeFairAttributesTransfer::class;
    }
}
