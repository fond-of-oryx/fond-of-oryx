<?php

namespace FondOfOryx\Glue\RepresentativeCompanyUserRestApi;

use Codeception\Test\Unit;
use Exception;
use FondOfOryx\Client\RepresentativeCompanyUserRestApi\RepresentativeCompanyUserRestApiClient;
use FondOfOryx\Glue\RepresentativeCompanyUserRestApi\Dependency\Client\RepresentativeCompanyUserRestApiToRepresentativeCompanyUserRestApiPermissionInterface;
use FondOfOryx\Glue\RepresentativeCompanyUserRestApi\Processor\Manager\RepresentationManager;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceBuilderInterface;
use Spryker\Glue\Kernel\Container;

class RepresentativeCompanyUserRestApiFactoryTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Glue\Kernel\Container
     */
    protected $containerMock;

    /**
     * @var \FondOfOryx\Client\RepresentativeCompanyUserRestApi\RepresentativeCompanyUserRestApiClient|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $clientMock;

    /**
     * @var \FondOfOryx\Glue\RepresentativeCompanyUserRestApi\RepresentativeCompanyUserRestApiConfig|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $configMock;

    /**
     * @var \FondOfOryx\Glue\RepresentativeCompanyUserRestApi\Dependency\Client\RepresentativeCompanyUserRestApiToRepresentativeCompanyUserRestApiPermissionInterface|\PHPUnit\Framework\MockObject\MockObject>
     */
    protected $permissionClientMock;

    /**
     * @var \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceBuilderInterface|\PHPUnit\Framework\MockObject\MockObject>
     */
    protected $restResourceBuilderMock;

    /**
     * @var \FondOfOryx\Glue\RepresentativeCompanyUserRestApi\RepresentativeCompanyUserRestApiFactory
     */
    protected $factory;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->containerMock = $this->getMockBuilder(Container::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->clientMock = $this->getMockBuilder(RepresentativeCompanyUserRestApiClient::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restResourceBuilderMock = $this->getMockBuilder(RestResourceBuilderInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->configMock = $this->getMockBuilder(RepresentativeCompanyUserRestApiConfig::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->permissionClientMock = $this->getMockBuilder(RepresentativeCompanyUserRestApiToRepresentativeCompanyUserRestApiPermissionInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->factory = new class ($this->restResourceBuilderMock) extends RepresentativeCompanyUserRestApiFactory {
            /**
             * @var \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceBuilderInterface
             */
            protected $restResourceBuilder;

            /**
             * @param \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceBuilderInterface $restResourceBuilder
             */
            public function __construct(RestResourceBuilderInterface $restResourceBuilder)
            {
                $this->restResourceBuilder = $restResourceBuilder;
            }

            /**
             * @return \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceBuilderInterface
             */
            public function getResourceBuilder(): RestResourceBuilderInterface
            {
                return $this->restResourceBuilder;
            }
        };

        $this->factory->setConfig($this->configMock);
        $this->factory->setClient($this->clientMock);
        $this->factory->setContainer($this->containerMock);
    }

    /**
     * @return void
     */
    public function testCreateRepresentationManager(): void
    {
        $self = $this;

        $this->containerMock->expects(static::atLeastOnce())
            ->method('has')
            ->willReturn(true);

        $this->containerMock->expects($this->atLeastOnce())
            ->method('get')
            ->willReturnCallback(static function (string $key) use ($self) {
                switch ($key) {
                    case RepresentativeCompanyUserRestApiDependencyProvider::CLIENT_REPRESENTATIVE_COMPANY_USER_PERMISSION:
                        return $self->permissionClientMock;
                }

                throw new Exception('Unexpected call');
            });

        static::assertInstanceOf(
            RepresentationManager::class,
            $this->factory->createRepresentationManager(),
        );
    }
}
