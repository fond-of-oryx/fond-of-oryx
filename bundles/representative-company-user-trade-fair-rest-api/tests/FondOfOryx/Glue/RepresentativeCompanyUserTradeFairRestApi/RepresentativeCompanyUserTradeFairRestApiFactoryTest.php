<?php

namespace FondOfOryx\Glue\RepresentativeCompanyUserTradeFairRestApi;

use Codeception\Test\Unit;
use FondOfOryx\Client\RepresentativeCompanyUserTradeFairRestApi\RepresentativeCompanyUserTradeFairRestApiClient;
use FondOfOryx\Glue\RepresentativeCompanyUserTradeFairRestApi\Processor\Builder\RestResponseBuilderInterface;
use FondOfOryx\Glue\RepresentativeCompanyUserTradeFairRestApi\Processor\Manager\TradeFairRepresentationManagerInterface;
use FondOfOryx\Glue\RepresentativeCompanyUserTradeFairRestApi\Processor\Mapper\RepresentationMapperInterface;
use PHPUnit\Framework\MockObject\MockObject;
use Spryker\Client\Kernel\AbstractClient;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceBuilderInterface;

class RepresentativeCompanyUserTradeFairRestApiFactoryTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfOryx\Client\RepresentativeCompanyUserTradeFairRestApi\RepresentativeCompanyUserTradeFairRestApiClient
     */
    protected MockObject|RepresentativeCompanyUserTradeFairRestApiClient $clientMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfOryx\Glue\RepresentativeCompanyUserTradeFairRestApi\Processor\Builder\RestResponseBuilderInterface
     */
    protected MockObject|RestResponseBuilderInterface $restResponseBuilderMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfOryx\Glue\RepresentativeCompanyUserTradeFairRestApi\Processor\Mapper\RepresentationMapperInterface
     */
    protected MockObject|RepresentationMapperInterface $representationMapperMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceBuilderInterface
     */
    protected MockObject|RestResourceBuilderInterface $restResourceBuilderMock;

    /**
     * @var \FondOfOryx\Glue\RepresentativeCompanyUserTradeFairRestApi\RepresentativeCompanyUserTradeFairRestApiFactory
     */
    protected RepresentativeCompanyUserTradeFairRestApiFactory $factory;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->clientMock = $this
            ->getMockBuilder(RepresentativeCompanyUserTradeFairRestApiClient::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restResponseBuilderMock = $this
            ->getMockBuilder(RestResponseBuilderInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restResourceBuilderMock = $this
            ->getMockBuilder(RestResourceBuilderInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->representationMapperMock = $this
            ->getMockBuilder(RepresentationMapperInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->factory = new class (
            $this->clientMock,
            $this->restResourceBuilderMock,
        ) extends RepresentativeCompanyUserTradeFairRestApiFactory {
            /**
             * @var \Spryker\Client\Kernel\AbstractClient
             */
            protected AbstractClient $abstractClient;

            /**
             * @var \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceBuilderInterface
             */
            protected RestResourceBuilderInterface $restResourceBuilder;

            /**
             * @param \Spryker\Client\Kernel\AbstractClient $abstractClient
             * @param \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceBuilderInterface $restResourceBuilder
             */
            public function __construct(
                AbstractClient $abstractClient,
                RestResourceBuilderInterface $restResourceBuilder
            ) {
                $this->restResourceBuilder = $restResourceBuilder;
                $this->abstractClient = $abstractClient;
            }

            /**
             * @return \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceBuilderInterface
             */
            public function getResourceBuilder(): RestResourceBuilderInterface
            {
                return $this->restResourceBuilder;
            }

            /**
             * @return \Spryker\Client\Kernel\AbstractClient
             */
            protected function getClient(): AbstractClient
            {
                return $this->abstractClient;
            }
        };
    }

    /**
     * @return void
     */
    public function testCreateTradeFairRepresentationManager(): void
    {
        static::assertInstanceOf(
            TradeFairRepresentationManagerInterface::class,
            $this->factory->createTradeFairRepresentationManager(),
        );
    }

    /**
     * @return void
     */
    public function testCreateRepresentationMapper(): void
    {
        static::assertInstanceOf(
            RepresentationMapperInterface::class,
            $this->factory->createRepresentationMapper(),
        );
    }

    /**
     * @return void
     */
    public function testCreateRestResponseBuilder(): void
    {
        static::assertInstanceOf(
            RestResponseBuilderInterface::class,
            $this->factory->createRestResponseBuilder(),
        );
    }
}
