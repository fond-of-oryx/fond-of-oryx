<?php

namespace FondOfOryx\Glue\OrderBudgetSearchRestApi;

use Codeception\Test\Unit;
use FondOfOryx\Client\OrderBudgetSearchRestApi\OrderBudgetSearchRestApiClient;
use FondOfOryx\Glue\OrderBudgetSearchRestApi\Dependency\Client\OrderBudgetSearchRestApiToGlossaryStorageClientInterface;
use FondOfOryx\Glue\OrderBudgetSearchRestApi\Processor\Reader\OrderBudgetReader;
use FondOfOryx\Glue\OrderBudgetSearchRestApiExtension\Dependency\Plugin\FilterFieldsExpanderPluginInterface;
use PHPUnit\Framework\MockObject\MockObject;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceBuilderInterface;
use Spryker\Glue\Kernel\Container;

class OrderBudgetSearchRestApiFactoryTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|(\Spryker\Glue\Kernel\Container&\PHPUnit\Framework\MockObject\MockObject)
     */
    protected Container|MockObject $containerMock;

    /**
     * @var (\FondOfOryx\Client\OrderBudgetSearchRestApi\OrderBudgetSearchRestApiClient&\PHPUnit\Framework\MockObject\MockObject)|\PHPUnit\Framework\MockObject\MockObject
     */
    protected MockObject|OrderBudgetSearchRestApiClient $clientMock;

    /**
     * @var (\FondOfOryx\Glue\OrderBudgetSearchRestApi\OrderBudgetSearchRestApiConfig&\PHPUnit\Framework\MockObject\MockObject)|\PHPUnit\Framework\MockObject\MockObject
     */
    protected OrderBudgetSearchRestApiConfig|MockObject $configMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|(\Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceBuilderInterface&\PHPUnit\Framework\MockObject\MockObject)
     */
    protected RestResourceBuilderInterface|MockObject $restResourceBuilderMock;

    /**
     * @var (\FondOfOryx\Glue\OrderBudgetSearchRestApi\Dependency\Client\OrderBudgetSearchRestApiToGlossaryStorageClientInterface&\PHPUnit\Framework\MockObject\MockObject)|\PHPUnit\Framework\MockObject\MockObject
     */
    protected OrderBudgetSearchRestApiToGlossaryStorageClientInterface|MockObject $glossaryStorageClientMock;

    /**
     * @var array<(\FondOfOryx\Glue\OrderBudgetSearchRestApiExtension\Dependency\Plugin\FilterFieldsExpanderPluginInterface&\PHPUnit\Framework\MockObject\MockObject)|\PHPUnit\Framework\MockObject\MockObject>
     */
    protected array $filterFieldsExpanderPluginMocks;

    /**
     * @var \FondOfOryx\Glue\OrderBudgetSearchRestApi\OrderBudgetSearchRestApiFactory
     */
    protected OrderBudgetSearchRestApiFactory $factory;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->containerMock = $this->getMockBuilder(Container::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->clientMock = $this->getMockBuilder(OrderBudgetSearchRestApiClient::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->configMock = $this->getMockBuilder(OrderBudgetSearchRestApiConfig::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restResourceBuilderMock = $this->getMockBuilder(RestResourceBuilderInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->glossaryStorageClientMock = $this->getMockBuilder(OrderBudgetSearchRestApiToGlossaryStorageClientInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->filterFieldsExpanderPluginMocks = [
            $this->getMockBuilder(FilterFieldsExpanderPluginInterface::class)
                ->disableOriginalConstructor()
                ->getMock(),
        ];

        $this->factory = new class ($this->restResourceBuilderMock) extends OrderBudgetSearchRestApiFactory {
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
    public function testCreateOrderBudgetReader(): void
    {
        $this->containerMock->expects(static::atLeastOnce())
            ->method('has')
            ->withConsecutive(
                [OrderBudgetSearchRestApiDependencyProvider::PLUGINS_FILTER_FIELDS_EXPANDER],
                [OrderBudgetSearchRestApiDependencyProvider::CLIENT_GLOSSARY_STORAGE],
            )->willReturn(true);

        $this->containerMock->expects(static::atLeastOnce())
            ->method('get')
            ->withConsecutive(
                [OrderBudgetSearchRestApiDependencyProvider::PLUGINS_FILTER_FIELDS_EXPANDER],
                [OrderBudgetSearchRestApiDependencyProvider::CLIENT_GLOSSARY_STORAGE],
            )->willReturnOnConsecutiveCalls(
                $this->filterFieldsExpanderPluginMocks,
                $this->glossaryStorageClientMock,
            );

        static::assertInstanceOf(
            OrderBudgetReader::class,
            $this->factory->createOrderBudgetReader(),
        );
    }
}
