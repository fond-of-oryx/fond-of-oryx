<?php

namespace FondOfOryx\Glue\ReturnLabelsRestApi;

use Codeception\Test\Unit;
use FondOfOryx\Client\ReturnLabelsRestApi\ReturnLabelsRestApiClient;
use FondOfOryx\Glue\ReturnLabelsRestApi\Proccesor\ReturnLabelProcessorInterface;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceBuilder;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceBuilderInterface;
use Spryker\Glue\Kernel\Container;

class ReturnLabelsRestApiFactoryTest extends Unit
{
    /**
     * @var \FondOfOryx\Client\ReturnLabelsRestApi\ReturnLabelsRestApiClientInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $returnLabelsRestApiClientMock;

    /**
     * @var \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceBuilderInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $resourceBuilderMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Glue\Kernel\Container
     */
    protected $containerMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfOryx\Glue\ReturnLabelsRestApi\Proccesor\ReturnLabelProcessorInterface
     */
    protected $returnLabelProcessor;

    /**
     * @var \FondOfOryx\Glue\ReturnLabelsRestApi\ReturnLabelsRestApiConfig|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $configMock;

    /**
     * @var \FondOfOryx\Glue\ReturnLabelsRestApi\ReturnLabelsRestApiFactory
     */
    protected $factory;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->returnLabelsRestApiClientMock = $this->getMockBuilder(ReturnLabelsRestApiClient::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->resourceBuilderMock = $this->getMockBuilder(RestResourceBuilder::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->containerMock = $this->getMockBuilder(Container::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->configMock = $this->getMockBuilder(ReturnLabelsRestApiConfig::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->factory = new class ($this->resourceBuilderMock) extends ReturnLabelsRestApiFactory {
            /**
             * @var \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceBuilderInterface
             */
            protected $resourceBuilder;

            /**
             * @param \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceBuilderInterface $resourceBuilder
             */
            public function __construct(RestResourceBuilderInterface $resourceBuilder)
            {
                $this->resourceBuilder = $resourceBuilder;
            }

            /**
             * @return \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceBuilderInterface
             */
            public function getResourceBuilder(): RestResourceBuilderInterface
            {
                return $this->resourceBuilder;
            }
        };

        $this->factory->setClient($this->returnLabelsRestApiClientMock);
    }

    /**
     * @return void
     */
    public function testCreateReturnLabelProcessor(): void
    {
        self::assertInstanceOf(
            ReturnLabelProcessorInterface::class,
            $this->factory->createReturnLabelProcessor()
        );
    }
}
