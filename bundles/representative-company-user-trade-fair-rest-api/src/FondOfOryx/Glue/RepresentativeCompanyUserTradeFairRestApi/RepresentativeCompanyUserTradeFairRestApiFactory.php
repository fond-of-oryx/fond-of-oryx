<?php

namespace FondOfOryx\Glue\RepresentativeCompanyUserTradeFairRestApi;

use FondOfOryx\Glue\RepresentativeCompanyUserTradeFairRestApi\Dependency\Client\RepresentativeCompanyUserTradeFairRestApiToRepresentativeCompanyUserTradeFairRestApiPermissionInterface;
use FondOfOryx\Glue\RepresentativeCompanyUserTradeFairRestApi\Processor\Builder\RestResponseBuilder;
use FondOfOryx\Glue\RepresentativeCompanyUserTradeFairRestApi\Processor\Builder\RestResponseBuilderInterface;
use FondOfOryx\Glue\RepresentativeCompanyUserTradeFairRestApi\Processor\Manager\TradeFairRepresentationManager;
use FondOfOryx\Glue\RepresentativeCompanyUserTradeFairRestApi\Processor\Manager\TradeFairRepresentationManagerInterface;
use FondOfOryx\Glue\RepresentativeCompanyUserTradeFairRestApi\Processor\Mapper\PermissionRequestMapper;
use FondOfOryx\Glue\RepresentativeCompanyUserTradeFairRestApi\Processor\Mapper\PermissionRequestMapperInterface;
use FondOfOryx\Glue\RepresentativeCompanyUserTradeFairRestApi\Processor\Mapper\RepresentationMapper;
use FondOfOryx\Glue\RepresentativeCompanyUserTradeFairRestApi\Processor\Mapper\RepresentationMapperInterface;
use FondOfOryx\Glue\RepresentativeCompanyUserTradeFairRestApi\Processor\Permission\PermissionChecker;
use FondOfOryx\Glue\RepresentativeCompanyUserTradeFairRestApi\Processor\Permission\PermissionCheckerInterface;
use FondOfOryx\Glue\RepresentativeCompanyUserTradeFairRestApi\Processor\Validator\DurationValidator;
use FondOfOryx\Glue\RepresentativeCompanyUserTradeFairRestApi\Processor\Validator\DurationValidatorInterface;
use Spryker\Glue\Kernel\AbstractFactory;

/**
 * @method \FondOfOryx\Client\RepresentativeCompanyUserTradeFairRestApi\RepresentativeCompanyUserTradeFairRestApiClient getClient()
 * @method \FondOfOryx\Glue\RepresentativeCompanyUserTradeFairRestApi\RepresentativeCompanyUserTradeFairRestApiConfig getConfig()
 */
class RepresentativeCompanyUserTradeFairRestApiFactory extends AbstractFactory
{
    /**
     * @return \FondOfOryx\Glue\RepresentativeCompanyUserTradeFairRestApi\Processor\Manager\TradeFairRepresentationManagerInterface
     */
    public function createTradeFairRepresentationManager(): TradeFairRepresentationManagerInterface
    {
        return new TradeFairRepresentationManager(
            $this->getClient(),
            $this->createRepresentationMapper(),
            $this->createRestResponseBuilder(),
            $this->createPermissionChecker(),
            $this->createDurationValidator(),
        );
    }

    /**
     * @return \FondOfOryx\Glue\RepresentativeCompanyUserTradeFairRestApi\Processor\Mapper\RepresentationMapperInterface
     */
    public function createRepresentationMapper(): RepresentationMapperInterface
    {
        return new RepresentationMapper();
    }

    /**
     * @return \FondOfOryx\Glue\RepresentativeCompanyUserTradeFairRestApi\Processor\Mapper\PermissionRequestMapperInterface
     */
    public function createPermissionRequestMapper(): PermissionRequestMapperInterface
    {
        return new PermissionRequestMapper();
    }

    /**
     * @return \FondOfOryx\Glue\RepresentativeCompanyUserTradeFairRestApi\Processor\Validator\DurationValidatorInterface
     */
    public function createDurationValidator(): DurationValidatorInterface
    {
        return new DurationValidator($this->getConfig());
    }

    /**
     * @return \FondOfOryx\Glue\RepresentativeCompanyUserTradeFairRestApi\Processor\Permission\PermissionCheckerInterface
     */
    public function createPermissionChecker(): PermissionCheckerInterface
    {
        return new PermissionChecker(
            $this->getRepresentativeCompanyUserTradeFairRestApiPermissionClient(),
            $this->createPermissionRequestMapper(),
        );
    }

    /**
     * @return \FondOfOryx\Glue\RepresentativeCompanyUserTradeFairRestApi\Processor\Builder\RestResponseBuilderInterface
     */
    public function createRestResponseBuilder(): RestResponseBuilderInterface
    {
        return new RestResponseBuilder($this->getResourceBuilder());
    }

    /**
     * @return \FondOfOryx\Glue\RepresentativeCompanyUserTradeFairRestApi\Dependency\Client\RepresentativeCompanyUserTradeFairRestApiToRepresentativeCompanyUserTradeFairRestApiPermissionInterface
     */
    public function getRepresentativeCompanyUserTradeFairRestApiPermissionClient(): RepresentativeCompanyUserTradeFairRestApiToRepresentativeCompanyUserTradeFairRestApiPermissionInterface
    {
        return $this->getProvidedDependency(RepresentativeCompanyUserTradeFairRestApiDependencyProvider::CLIENT_REPRESENTATIVE_COMPANY_USER_TRADE_FAIR_PERMISSION);
    }
}
