<?php

namespace FondOfOryx\Glue\RepresentativeCompanyUserRestApi\Plugin\GlueApplicationExtension;

use FondOfOryx\Glue\RepresentativeCompanyUserRestApi\RepresentativeCompanyUserRestApiConfig;
use Generated\Shared\Transfer\RestRepresentativeCompanyUserAttributesTransfer;
use Spryker\Glue\GlueApplicationExtension\Dependency\Plugin\ResourceRouteCollectionInterface;
use Spryker\Glue\GlueApplicationExtension\Dependency\Plugin\ResourceRoutePluginInterface;
use Spryker\Glue\Kernel\AbstractPlugin;

class RepresentativeCompanyUserRestApiResourceRoutePlugin extends AbstractPlugin implements ResourceRoutePluginInterface
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
        return RepresentativeCompanyUserRestApiConfig::RESOURCE_REPRESENTATIVE_COMPANY_USER_REST_API;
    }

    /**
     * @return string
     */
    public function getController(): string
    {
        return RepresentativeCompanyUserRestApiConfig::CONTROLLER_RESOURCE_REPRESENTATIVE_COMPANY_USER_REST_API;
    }

    /**
     * @return string
     */
    public function getResourceAttributesClassName(): string
    {
        return RestRepresentativeCompanyUserAttributesTransfer::class;
    }
}
