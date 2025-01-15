<?php

namespace FondOfOryx\Glue\CompaniesRestApi;

use Codeception\Test\Unit;
use Exception;
use FondOfOryx\Client\CompaniesRestApi\CompaniesRestApiClient;
use FondOfOryx\Glue\CompaniesRestApi\Dependency\Client\CompaniesRestApiToCompaniesRestApiPermissionInterface;
use FondOfOryx\Glue\CompaniesRestApi\Processor\Deleter\CompanyDeleter;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceBuilderInterface;
use Spryker\Glue\Kernel\Container;

class CompaniesRestApiFactoryTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Glue\Kernel\Container
     */
    protected $containerMock;

    /**
     * @var \FondOfOryx\Client\CompaniesRestApi\CompaniesRestApiClient|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $clientMock;

    /**
     * @var \FondOfOryx\Glue\CompaniesRestApi\CompaniesRestApiConfig|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $configMock;

    /**
     * @var \FondOfOryx\Glue\CompaniesRestApi\Dependency\Client\CompaniesRestApiToCompaniesRestApiPermissionInterface|\PHPUnit\Framework\MockObject\MockObject>
     */
    protected $permissionClientMock;

    /**
     * @var \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceBuilderInterface|\PHPUnit\Framework\MockObject\MockObject>
     */
    protected $restResourceBuilderMock;

    /**
     * @var \FondOfOryx\Glue\CompaniesRestApi\CompaniesRestApiFactory
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

        $this->clientMock = $this->getMockBuilder(CompaniesRestApiClient::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restResourceBuilderMock = $this->getMockBuilder(RestResourceBuilderInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->configMock = $this->getMockBuilder(CompaniesRestApiConfig::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->permissionClientMock = $this->getMockBuilder(CompaniesRestApiToCompaniesRestApiPermissionInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->factory = new class ($this->restResourceBuilderMock) extends CompaniesRestApiFactory {
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
    public function testCreateCompanyDeleter(): void
    {
        $self = $this;

        $this->containerMock->expects(static::atLeastOnce())
            ->method('has')
            ->willReturn(true);

        $this->containerMock->expects($this->atLeastOnce())
            ->method('get')
            ->willReturnCallback(static function (string $key) use ($self) {
                switch ($key) {
                    case CompaniesRestApiDependencyProvider::CLIENT_COMPANIES_REST_API_PERMISSION:
                        return $self->permissionClientMock;
                }

                throw new Exception('Unexpected call');
            });

        static::assertInstanceOf(
            CompanyDeleter::class,
            $this->factory->createCompanyDeleter(),
        );
    }
}
