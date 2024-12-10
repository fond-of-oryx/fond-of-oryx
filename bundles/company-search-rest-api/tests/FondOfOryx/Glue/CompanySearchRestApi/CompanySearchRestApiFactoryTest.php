<?php

namespace FondOfOryx\Glue\CompanySearchRestApi;

use Codeception\Test\Unit;
use Exception;
use FondOfOryx\Client\CompanySearchRestApi\CompanySearchRestApiClient;
use FondOfOryx\Glue\CompanySearchRestApi\Dependency\Client\CompanySearchRestApiToGlossaryStorageClientInterface;
use FondOfOryx\Glue\CompanySearchRestApi\Processor\Reader\CompanyReader;
use PHPUnit\Framework\MockObject\MockObject;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceBuilderInterface;
use Spryker\Glue\Kernel\Container;

class CompanySearchRestApiFactoryTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|(\Spryker\Glue\Kernel\Container&\PHPUnit\Framework\MockObject\MockObject)
     */
    protected Container|MockObject $containerMock;

    /**
     * @var (\FondOfOryx\Client\CompanySearchRestApi\CompanySearchRestApiClient&\PHPUnit\Framework\MockObject\MockObject)|\PHPUnit\Framework\MockObject\MockObject
     */
    protected MockObject|CompanySearchRestApiClient $clientMock;

    /**
     * @var (\FondOfOryx\Glue\CompanySearchRestApi\CompanySearchRestApiConfig&\PHPUnit\Framework\MockObject\MockObject)|\PHPUnit\Framework\MockObject\MockObject
     */
    protected CompanySearchRestApiConfig|MockObject $configMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|(\Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceBuilderInterface&\PHPUnit\Framework\MockObject\MockObject)
     */
    protected RestResourceBuilderInterface|MockObject $restResourceBuilderMock;

    /**
     * @var (\FondOfOryx\Glue\CompanySearchRestApi\Dependency\Client\CompanySearchRestApiToGlossaryStorageClientInterface&\PHPUnit\Framework\MockObject\MockObject)|\PHPUnit\Framework\MockObject\MockObject
     */
    protected CompanySearchRestApiToGlossaryStorageClientInterface|MockObject $glossaryStorageClientMock;

    /**
     * @var \FondOfOryx\Glue\CompanySearchRestApi\CompanySearchRestApiFactory
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

        $this->clientMock = $this->getMockBuilder(CompanySearchRestApiClient::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->configMock = $this->getMockBuilder(CompanySearchRestApiConfig::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restResourceBuilderMock = $this->getMockBuilder(RestResourceBuilderInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->glossaryStorageClientMock = $this->getMockBuilder(CompanySearchRestApiToGlossaryStorageClientInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->factory = new class ($this->restResourceBuilderMock) extends CompanySearchRestApiFactory {
            /**
             * @var \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceBuilderInterface
             */
            protected RestResourceBuilderInterface $restResourceBuilder;

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
    public function testCreateCompanyReader(): void
    {
        $self = $this;

        $this->containerMock->expects(static::atLeastOnce())
            ->method('has')
            ->willReturn(true);

        $this->containerMock->expects($this->atLeastOnce())
            ->method('get')
            ->willReturnCallback(static function (string $key) use ($self) {
                switch ($key) {
                    case CompanySearchRestApiDependencyProvider::PLUGINS_FILTER_FIELDS_EXPANDER:
                        return [];
                    case CompanySearchRestApiDependencyProvider::CLIENT_GLOSSARY_STORAGE:
                        return $self->glossaryStorageClientMock;
                    case CompanySearchRestApiDependencyProvider::PLUGINS_REST_COMPANY_SEARCH_RESULT_ITEM_EXPANDER:
                        return [];
                }

                throw new Exception('Unexpected call');
            });

        static::assertInstanceOf(
            CompanyReader::class,
            $this->factory->createCompanyReader(),
        );
    }
}
