<?php

namespace FondOfOryx\Glue\CompanyBusinessUnitAddressSearchRestApi;

use Codeception\Test\Unit;
use FondOfOryx\Client\CompanyBusinessUnitAddressSearchRestApi\CompanyBusinessUnitAddressSearchRestApiClient;
use FondOfOryx\Glue\CompanyBusinessUnitAddressSearchRestApi\Dependency\Client\CompanyBusinessUnitAddressSearchRestApiToGlossaryStorageClientInterface;
use FondOfOryx\Glue\CompanyBusinessUnitAddressSearchRestApi\Processor\Reader\CompanyBusinessUnitAddressReader;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceBuilderInterface;
use Spryker\Glue\Kernel\Container;

class CompanyBusinessUnitAddressSearchRestApiFactoryTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Glue\Kernel\Container|mixed
     */
    protected $containerMock;

    /**
     * @var \FondOfOryx\Client\CompanyBusinessUnitAddressSearchRestApi\CompanyBusinessUnitAddressSearchRestApiClient|\PHPUnit\Framework\MockObject\MockObject|mixed
     */
    protected $clientMock;

    /**
     * @var \FondOfOryx\Glue\CompanyBusinessUnitAddressSearchRestApi\CompanyBusinessUnitAddressSearchRestApiConfig|\PHPUnit\Framework\MockObject\MockObject|mixed
     */
    protected $configMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceBuilderInterface
     */
    protected $restResourceBuilderMock;

    /**
     * @var \FondOfOryx\Glue\CompanyBusinessUnitAddressSearchRestApi\Dependency\Client\CompanyBusinessUnitAddressSearchRestApiToGlossaryStorageClientInterface|\PHPUnit\Framework\MockObject\MockObject|mixed
     */
    protected $glossaryStorageClientMock;

    /**
     * @var \FondOfOryx\Glue\CompanyBusinessUnitAddressSearchRestApi\CompanyBusinessUnitAddressSearchRestApiFactory
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

        $this->clientMock = $this->getMockBuilder(CompanyBusinessUnitAddressSearchRestApiClient::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->configMock = $this->getMockBuilder(CompanyBusinessUnitAddressSearchRestApiConfig::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restResourceBuilderMock = $this->getMockBuilder(RestResourceBuilderInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->glossaryStorageClientMock = $this->getMockBuilder(CompanyBusinessUnitAddressSearchRestApiToGlossaryStorageClientInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->factory = new class ($this->restResourceBuilderMock) extends CompanyBusinessUnitAddressSearchRestApiFactory {
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
    public function testCreateCompanyBusinessUnitAddressReader(): void
    {
        $this->containerMock->expects(static::atLeastOnce())
            ->method('has')
            ->withConsecutive(
                [CompanyBusinessUnitAddressSearchRestApiDependencyProvider::PLUGINS_FILTER_FIELDS_EXPANDER],
                [CompanyBusinessUnitAddressSearchRestApiDependencyProvider::CLIENT_GLOSSARY_STORAGE],
            )
            ->willReturn(true);

        $this->containerMock->expects(static::atLeastOnce())
            ->method('get')
            ->withConsecutive(
                [CompanyBusinessUnitAddressSearchRestApiDependencyProvider::PLUGINS_FILTER_FIELDS_EXPANDER],
                [CompanyBusinessUnitAddressSearchRestApiDependencyProvider::CLIENT_GLOSSARY_STORAGE],
            )
            ->willReturnOnConsecutiveCalls(
                [],
                $this->glossaryStorageClientMock,
            );

        static::assertInstanceOf(
            CompanyBusinessUnitAddressReader::class,
            $this->factory->createCompanyBusinessUnitAddressReader(),
        );
    }
}
