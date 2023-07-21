<?php

namespace FondOfOryx\Glue\RepresentativeCompanyUserTradeFairRestApi;

use FondOfOryx\Glue\RepresentativeCompanyUserTradeFairRestApi\Processor\Builder\RestResponseBuilder;
use FondOfOryx\Glue\RepresentativeCompanyUserTradeFairRestApi\Processor\Builder\RestResponseBuilderInterface;
use FondOfOryx\Glue\RepresentativeCompanyUserTradeFairRestApi\Processor\Manager\TradeFairRepresentationManager;
use FondOfOryx\Glue\RepresentativeCompanyUserTradeFairRestApi\Processor\Manager\TradeFairRepresentationManagerInterface;
use FondOfOryx\Glue\RepresentativeCompanyUserTradeFairRestApi\Processor\Mapper\RepresentationMapper;
use FondOfOryx\Glue\RepresentativeCompanyUserTradeFairRestApi\Processor\Mapper\RepresentationMapperInterface;
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
     * @return \FondOfOryx\Glue\RepresentativeCompanyUserTradeFairRestApi\Processor\Builder\RestResponseBuilderInterface
     */
    public function createRestResponseBuilder(): RestResponseBuilderInterface
    {
        return new RestResponseBuilder($this->getResourceBuilder());
    }
}
