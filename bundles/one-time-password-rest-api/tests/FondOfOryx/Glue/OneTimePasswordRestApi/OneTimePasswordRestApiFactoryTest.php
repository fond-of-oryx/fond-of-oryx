<?php

namespace FondOfOryx\Glue\OneTimePasswordRestApi;

use Codeception\Test\Unit;
use FondOfOryx\Client\OneTimePasswordRestApi\OneTimePasswordRestApiClient;
use FondOfOryx\Glue\OneTimePasswordRestApi\Processor\OneTimePasswordProcessorInterface;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceBuilderInterface;

class OneTimePasswordRestApiFactoryTest extends Unit
{
    /**
     * @var \FondOfOryx\Glue\OneTimePasswordRestApi\OneTimePasswordRestApiFactory
     */
    protected $oneTimePasswordRestApiFactory;

    /**
     * @var \FondOfOryx\Client\OneTimePasswordRestApi\OneTimePasswordRestApiClient|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $oneTimePasswordRestApiClientMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceBuilderInterface
     */
    protected $restResourceBuilderMock;

    /**
     * @return void
     */
    protected function _before(): void
    {
        $this->oneTimePasswordRestApiClientMock = $this->getMockBuilder(OneTimePasswordRestApiClient::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restResourceBuilderMock = $this->getMockBuilder(RestResourceBuilderInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->oneTimePasswordRestApiFactory = new class ($this->restResourceBuilderMock) extends OneTimePasswordRestApiFactory {
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
        $this->oneTimePasswordRestApiFactory->setClient($this->oneTimePasswordRestApiClientMock);
    }

    /**
     * @return void
     */
    public function testCreateOneTimePasswordProcessor(): void
    {
        $this->assertInstanceOf(
            OneTimePasswordProcessorInterface::class,
            $this->oneTimePasswordRestApiFactory->createOneTimePasswordProcessor()
        );
    }
}
