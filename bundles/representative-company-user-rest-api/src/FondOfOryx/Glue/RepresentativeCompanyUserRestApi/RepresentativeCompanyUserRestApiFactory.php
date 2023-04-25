<?php

namespace FondOfOryx\Glue\RepresentativeCompanyUserRestApi;

use FondOfOryx\Glue\RepresentativeCompanyUserRestApi\Dependency\Client\RepresentativeCompanyUserRestApiToRepresentativeCompanyUserRestApiPermissionInterface;
use FondOfOryx\Glue\RepresentativeCompanyUserRestApi\Processor\Builder\RestResponseBuilder;
use FondOfOryx\Glue\RepresentativeCompanyUserRestApi\Processor\Builder\RestResponseBuilderInterface;
use FondOfOryx\Glue\RepresentativeCompanyUserRestApi\Processor\Manager\RepresentationManager;
use FondOfOryx\Glue\RepresentativeCompanyUserRestApi\Processor\Manager\RepresentationManagerInterface;
use FondOfOryx\Glue\RepresentativeCompanyUserRestApi\Processor\Mapper\PermissionRequestMapper;
use FondOfOryx\Glue\RepresentativeCompanyUserRestApi\Processor\Mapper\PermissionRequestMapperInterface;
use FondOfOryx\Glue\RepresentativeCompanyUserRestApi\Processor\Mapper\RepresentationMapper;
use FondOfOryx\Glue\RepresentativeCompanyUserRestApi\Processor\Mapper\RepresentationMapperInterface;
use FondOfOryx\Glue\RepresentativeCompanyUserRestApi\Processor\Permission\PermissionChecker;
use FondOfOryx\Glue\RepresentativeCompanyUserRestApi\Processor\Permission\PermissionCheckerInterface;
use Spryker\Glue\Kernel\AbstractFactory;

/**
 * @method \FondOfOryx\Client\RepresentativeCompanyUserRestApi\RepresentativeCompanyUserRestApiClient getClient()
 * @method \FondOfOryx\Glue\RepresentativeCompanyUserRestApi\RepresentativeCompanyUserRestApiConfig getConfig()
 */
class RepresentativeCompanyUserRestApiFactory extends AbstractFactory
{
    /**
     * @return \FondOfOryx\Glue\RepresentativeCompanyUserRestApi\Processor\Manager\RepresentationManagerInterface
     */
    public function createRepresentationManager(): RepresentationManagerInterface
    {
        return new RepresentationManager(
            $this->getClient(),
            $this->createRepresentationMapper(),
            $this->createRestResponseBuilder(),
            $this->createPermissionChecker(),
        );
    }

    /**
     * @return \FondOfOryx\Glue\RepresentativeCompanyUserRestApi\Processor\Mapper\RepresentationMapperInterface
     */
    public function createRepresentationMapper(): RepresentationMapperInterface
    {
        return new RepresentationMapper();
    }

    /**
     * @return \FondOfOryx\Glue\RepresentativeCompanyUserRestApi\Processor\Mapper\PermissionRequestMapperInterface
     */
    public function createPermissionRequestMapper(): PermissionRequestMapperInterface
    {
        return new PermissionRequestMapper();
    }

    /**
     * @return \FondOfOryx\Glue\RepresentativeCompanyUserRestApi\Processor\Permission\PermissionCheckerInterface
     */
    public function createPermissionChecker(): PermissionCheckerInterface
    {
        return new PermissionChecker(
            $this->getRepresentativeCompanyUserRestApiPermissionClient(),
            $this->createPermissionRequestMapper(),
        );
    }

    /**
     * @return \FondOfOryx\Glue\RepresentativeCompanyUserRestApi\Processor\Builder\RestResponseBuilderInterface
     */
    public function createRestResponseBuilder(): RestResponseBuilderInterface
    {
        return new RestResponseBuilder($this->getResourceBuilder());
    }

    /**
     * @return \FondOfOryx\Glue\RepresentativeCompanyUserRestApi\Dependency\Client\RepresentativeCompanyUserRestApiToRepresentativeCompanyUserRestApiPermissionInterface
     */
    public function getRepresentativeCompanyUserRestApiPermissionClient(): RepresentativeCompanyUserRestApiToRepresentativeCompanyUserRestApiPermissionInterface
    {
        return $this->getProvidedDependency(RepresentativeCompanyUserRestApiDependencyProvider::CLIENT_REPRESENTATIVE_COMPANY_USER_PERMISSION);
    }
}
