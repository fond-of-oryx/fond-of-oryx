<?php

namespace FondOfOryx\Glue\DocumentsRestApi;

use Codeception\Test\Unit;
use FondOfOryx\Glue\DocumentsRestApi\Dependency\Client\DocumentsRestApiToEasyApiInterface;
use FondOfOryx\Glue\DocumentsRestApi\Dependency\Plugin\DocumentRestRequestExpanderPluginInterface;
use FondOfOryx\Glue\DocumentsRestApi\Dependency\Plugin\DocumentTypePluginInterface;
use FondOfOryx\Glue\DocumentsRestApi\Processor\Builder\RestResponseBuilder;
use FondOfOryx\Glue\DocumentsRestApi\Processor\Expander\DocumentRestRequestExpander;
use FondOfOryx\Glue\DocumentsRestApi\Processor\Mapper\DocumentRestRequestMapper;
use FondOfOryx\Glue\DocumentsRestApi\Processor\Reader\DocumentReader;
use PHPUnit\Framework\MockObject\MockObject;
use Psr\Log\LoggerInterface;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceBuilderInterface;
use Spryker\Shared\Log\Config\LoggerConfigInterface;

class DocumentsRestApiFactoryTest extends Unit
{
    /**
     * @var \FondOfOryx\Glue\DocumentsRestApi\Dependency\Client\DocumentsRestApiToEasyApiInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected DocumentsRestApiToEasyApiInterface|MockObject $easyApiMock;

    /**
     * @var \FondOfOryx\Glue\DocumentsRestApi\Dependency\Plugin\DocumentRestRequestExpanderPluginInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected DocumentRestRequestExpanderPluginInterface|MockObject $requestExpanderPluginMock;

    /**
     * @var \FondOfOryx\Glue\DocumentsRestApi\Dependency\Plugin\DocumentTypePluginInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected DocumentTypePluginInterface|MockObject $documentTypePluginMock;

    /**
     * @var \Psr\Log\LoggerInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected LoggerInterface|MockObject $loggerMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceBuilderInterface
     */
    protected MockObject|RestResourceBuilderInterface $restResourceBuilderMock;

    /**
     * @var \FondOfOryx\Glue\DocumentsRestApi\DocumentsRestApiFactory
     */
    protected DocumentsRestApiFactory $factory;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->easyApiMock = $this->getMockBuilder(DocumentsRestApiToEasyApiInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->requestExpanderPluginMock = $this->getMockBuilder(DocumentRestRequestExpanderPluginInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->documentTypePluginMock = $this->getMockBuilder(DocumentTypePluginInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->loggerMock = $this->getMockBuilder(LoggerInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restResourceBuilderMock = $this->getMockBuilder(RestResourceBuilderInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->factory = new class (
            $this->easyApiMock,
            $this->restResourceBuilderMock,
            $this->loggerMock,
            [$this->requestExpanderPluginMock],
            [$this->documentTypePluginMock],
        ) extends DocumentsRestApiFactory {
            /**
             * @var \FondOfOryx\Glue\DocumentsRestApi\Dependency\Client\DocumentsRestApiToEasyApiInterface
             */
            protected DocumentsRestApiToEasyApiInterface $easyApi;

            /**
             * @var \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceBuilderInterface
             */
            protected RestResourceBuilderInterface $restResourceBuilder;

            /**
             * @var \Psr\Log\LoggerInterface
             */
            protected LoggerInterface $loggerMock;

            /**
             * @var array<\FondOfOryx\Glue\DocumentsRestApi\Dependency\Plugin\DocumentRestRequestExpanderPluginInterface>
             */
            protected array $requestExpanderPlugins;

            /**
             * @var array<\FondOfOryx\Glue\DocumentsRestApi\Dependency\Plugin\DocumentTypePluginInterface>
             */
            protected array $documentTypePlugins;

            /**
             * @param \FondOfOryx\Glue\DocumentsRestApi\Dependency\Client\DocumentsRestApiToEasyApiInterface $easyApi
             * @param \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceBuilderInterface $restResourceBuilder
             * @param \Psr\Log\LoggerInterface $logger
             * @param array<\FondOfOryx\Glue\DocumentsRestApi\Dependency\Plugin\DocumentRestRequestExpanderPluginInterface> $requestExpanderPlugins
             * @param array<\FondOfOryx\Glue\DocumentsRestApi\Dependency\Plugin\DocumentTypePluginInterface> $documentTypePlugins
             */
            public function __construct(
                DocumentsRestApiToEasyApiInterface $easyApi,
                RestResourceBuilderInterface $restResourceBuilder,
                LoggerInterface $logger,
                array $requestExpanderPlugins,
                array $documentTypePlugins
            ) {
                $this->restResourceBuilder = $restResourceBuilder;
                $this->easyApi = $easyApi;
                $this->loggerMock = $logger;
                $this->requestExpanderPlugins = $requestExpanderPlugins;
                $this->documentTypePlugins = $documentTypePlugins;
            }

            /**
             * @return \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceBuilderInterface
             */
            public function getResourceBuilder(): RestResourceBuilderInterface
            {
                return $this->restResourceBuilder;
            }

            /**
             * @return \FondOfOryx\Glue\DocumentsRestApi\Dependency\Client\DocumentsRestApiToEasyApiInterface
             */
            protected function getEasyApi(): DocumentsRestApiToEasyApiInterface
            {
                return $this->easyApi;
            }

            /**
             * @return array<\FondOfOryx\Glue\DocumentsRestApi\Dependency\Plugin\DocumentRestRequestExpanderPluginInterface>
             */
            protected function getDocumentRestRequestExpanderPlugins(): array
            {
                return $this->requestExpanderPlugins;
            }

            /**
             * @return array<\FondOfOryx\Glue\DocumentsRestApi\Dependency\Plugin\DocumentTypePluginInterface>
             */
            protected function getDocumentTypePlugins(): array
            {
                return $this->documentTypePlugins;
            }

            /**
             * @param \Spryker\Shared\Log\Config\LoggerConfigInterface|null $loggerConfig
             *
             * @return \Psr\Log\LoggerInterface
             */
            protected function getLogger(?LoggerConfigInterface $loggerConfig = null): LoggerInterface
            {
                return $this->loggerMock;
            }
        };
    }

    /**
     * @return void
     */
    public function testCreateDocumentReader(): void
    {
        static::assertInstanceOf(
            DocumentReader::class,
            $this->factory->createDocumentReader(),
        );
    }

    /**
     * @return void
     */
    public function testCreateRestResponseBuilder(): void
    {
        static::assertInstanceOf(
            RestResponseBuilder::class,
            $this->factory->createRestResponseBuilder(),
        );
    }

    /**
     * @return void
     */
    public function testCreateDocumentRestRequestMapper(): void
    {
        static::assertInstanceOf(
            DocumentRestRequestMapper::class,
            $this->factory->createDocumentRestRequestMapper(),
        );
    }

    /**
     * @return void
     */
    public function testCreateDocumentRestRequestExpander(): void
    {
        static::assertInstanceOf(
            DocumentRestRequestExpander::class,
            $this->factory->createDocumentRestRequestExpander(),
        );
    }
}
