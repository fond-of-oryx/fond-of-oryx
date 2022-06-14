<?php

namespace FondOfOryx\Glue\CartSearchRestApi;

use Codeception\Test\Unit;
use FondOfOryx\Client\CartSearchRestApi\CartSearchRestApiClient;
use FondOfOryx\Glue\CartSearchRestApi\Dependency\Client\CartSearchRestApiToGlossaryStorageClientInterface;
use FondOfOryx\Glue\CartSearchRestApi\Processor\Expander\QuoteResourceRelationshipExpander;
use FondOfOryx\Glue\CartSearchRestApi\Processor\Reader\CartReader;
use FondOfOryx\Glue\CartSearchRestApiExtension\Dependency\Plugin\FilterFieldsExpanderPluginInterface;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceBuilderInterface;
use Spryker\Glue\Kernel\Container;

class CartSearchRestApiFactoryTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Glue\Kernel\Container|mixed
     */
    protected $containerMock;

    /**
     * @var \FondOfOryx\Client\CartSearchRestApi\CartSearchRestApiClient|\PHPUnit\Framework\MockObject\MockObject|mixed
     */
    protected $clientMock;

    /**
     * @var \FondOfOryx\Glue\CartSearchRestApi\CartSearchRestApiConfig|\PHPUnit\Framework\MockObject\MockObject|mixed
     */
    protected $configMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceBuilderInterface
     */
    protected $restResourceBuilderMock;

    /**
     * @var \FondOfOryx\Glue\CartSearchRestApi\Dependency\Client\CartSearchRestApiToGlossaryStorageClientInterface|\PHPUnit\Framework\MockObject\MockObject|mixed
     */
    protected $glossaryStorageClientMock;

    /**
     * @var array<\FondOfOryx\Glue\CartSearchRestApiExtension\Dependency\Plugin\FilterFieldsExpanderPluginInterface|\PHPUnit\Framework\MockObject\MockObject>
     */
    protected $filterFieldsExpanderPluginMocks;

    /**
     * @var \FondOfOryx\Glue\CartSearchRestApi\CartSearchRestApiFactory
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

        $this->clientMock = $this->getMockBuilder(CartSearchRestApiClient::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->configMock = $this->getMockBuilder(CartSearchRestApiConfig::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restResourceBuilderMock = $this->getMockBuilder(RestResourceBuilderInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->glossaryStorageClientMock = $this->getMockBuilder(CartSearchRestApiToGlossaryStorageClientInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->filterFieldsExpanderPluginMocks = [
            $this->getMockBuilder(FilterFieldsExpanderPluginInterface::class)
                ->disableOriginalConstructor()
                ->getMock(),
        ];

        $this->factory = new class ($this->restResourceBuilderMock) extends CartSearchRestApiFactory {
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
    public function testCreateCartReader(): void
    {
        $this->containerMock->expects(static::atLeastOnce())
            ->method('has')
            ->withConsecutive(
                [CartSearchRestApiDependencyProvider::PLUGINS_FILTER_FIELDS_EXPANDER],
                [CartSearchRestApiDependencyProvider::CLIENT_GLOSSARY_STORAGE],
            )->willReturn(true);

        $this->containerMock->expects(static::atLeastOnce())
            ->method('get')
            ->withConsecutive(
                [CartSearchRestApiDependencyProvider::PLUGINS_FILTER_FIELDS_EXPANDER],
                [CartSearchRestApiDependencyProvider::CLIENT_GLOSSARY_STORAGE],
            )->willReturnOnConsecutiveCalls(
                $this->filterFieldsExpanderPluginMocks,
                $this->glossaryStorageClientMock,
            );

        static::assertInstanceOf(
            CartReader::class,
            $this->factory->createCartReader(),
        );
    }

    /**
     * @return void
     */
    public function testQuoteResourceRelationshipExpander(): void
    {
        static::assertInstanceOf(
            QuoteResourceRelationshipExpander::class,
            $this->factory->createQuoteResourceRelationshipExpander(),
        );
    }
}
