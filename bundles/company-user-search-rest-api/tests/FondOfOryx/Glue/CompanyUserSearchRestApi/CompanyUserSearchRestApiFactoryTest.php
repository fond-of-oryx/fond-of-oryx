<?php

namespace FondOfOryx\Glue\CompanyUserSearchRestApi;

use Codeception\Test\Unit;
use FondOfOryx\Client\CompanyUserSearchRestApi\CompanyUserSearchRestApiClient;
use FondOfOryx\Glue\CompanyUserSearchRestApi\Dependency\Client\CompanyUserSearchRestApiToGlossaryStorageClientInterface;
use FondOfOryx\Glue\CompanyUserSearchRestApi\Processor\Reader\CompanyUserReader;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceBuilderInterface;
use Spryker\Glue\Kernel\Container;

class CompanyUserSearchRestApiFactoryTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Glue\Kernel\Container|mixed
     */
    protected $containerMock;

    /**
     * @var \FondOfOryx\Client\CompanyUserSearchRestApi\CompanyUserSearchRestApiClient|\PHPUnit\Framework\MockObject\MockObject|mixed
     */
    protected $clientMock;

    /**
     * @var \FondOfOryx\Glue\CompanyUserSearchRestApi\CompanyUserSearchRestApiConfig|\PHPUnit\Framework\MockObject\MockObject|mixed
     */
    protected $configMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceBuilderInterface
     */
    protected $restResourceBuilderMock;

    /**
     * @var \FondOfOryx\Glue\CompanyUserSearchRestApi\Dependency\Client\CompanyUserSearchRestApiToGlossaryStorageClientInterface|\PHPUnit\Framework\MockObject\MockObject|mixed
     */
    protected $glossaryStorageClientMock;

    /**
     * @var \FondOfOryx\Glue\CompanyUserSearchRestApi\CompanyUserSearchRestApiFactory
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

        $this->clientMock = $this->getMockBuilder(CompanyUserSearchRestApiClient::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->configMock = $this->getMockBuilder(CompanyUserSearchRestApiConfig::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restResourceBuilderMock = $this->getMockBuilder(RestResourceBuilderInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->glossaryStorageClientMock = $this->getMockBuilder(CompanyUserSearchRestApiToGlossaryStorageClientInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->factory = new class ($this->restResourceBuilderMock) extends CompanyUserSearchRestApiFactory {
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
    public function testCreateCompanyUserReader(): void
    {
        $this->containerMock->expects(static::atLeastOnce())
            ->method('has')
            ->with(CompanyUserSearchRestApiDependencyProvider::CLIENT_GLOSSARY_STORAGE)
            ->willReturn(true);

        $this->containerMock->expects(static::atLeastOnce())
            ->method('get')
            ->with(CompanyUserSearchRestApiDependencyProvider::CLIENT_GLOSSARY_STORAGE)
            ->willReturn($this->glossaryStorageClientMock);

        static::assertInstanceOf(
            CompanyUserReader::class,
            $this->factory->createCompanyUserReader(),
        );
    }
}
