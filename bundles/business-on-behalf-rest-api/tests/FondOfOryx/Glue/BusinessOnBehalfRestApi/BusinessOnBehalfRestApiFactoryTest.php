<?php

namespace FondOfOryx\Glue\BusinessOnBehalfRestApi;

use Codeception\Test\Unit;
use FondOfOryx\Client\BusinessOnBehalfRestApi\BusinessOnBehalfRestApiClient;
use FondOfOryx\Glue\BusinessOnBehalfRestApi\Processor\BusinessOnBehalf\BusinessOnBehalfProcessor;
use PHPUnit\Framework\MockObject\MockObject;
use Spryker\Client\Kernel\AbstractClient;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceBuilderInterface;

class BusinessOnBehalfRestApiFactoryTest extends Unit
{
    /**
     * @var \FondOfOryx\Client\BusinessOnBehalfRestApi\BusinessOnBehalfRestApiClient|\PHPUnit\Framework\MockObject\MockObject
     */
    protected BusinessOnBehalfRestApiClient|MockObject $clientMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceBuilderInterface
     */
    protected MockObject|RestResourceBuilderInterface $restResourceBuilderMock;

    /**
     * @var \FondOfOryx\Glue\BusinessOnBehalfRestApi\BusinessOnBehalfRestApiFactory
     */
    protected BusinessOnBehalfRestApiFactory $factory;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->clientMock = $this->getMockBuilder(BusinessOnBehalfRestApiClient::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restResourceBuilderMock = $this->getMockBuilder(RestResourceBuilderInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->factory = new class (
            $this->clientMock,
            $this->restResourceBuilderMock,
        ) extends BusinessOnBehalfRestApiFactory {
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
    public function testCreateBusinessOnBehalfProcessor(): void
    {
        static::assertInstanceOf(
            BusinessOnBehalfProcessor::class,
            $this->factory->createBusinessOnBehalfProcessor(),
        );
    }
}
