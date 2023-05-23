<?php

namespace FondOfOryx\Glue\NotionProxyRestApi;

use Codeception\Test\Unit;
use FondOfOryx\Client\NotionProxyRestApi\NotionProxyRestApiClient;
use FondOfOryx\Glue\NotionProxyRestApi\Processor\Creator\NotionProxyRequestCreatorInterface;
use PHPUnit\Framework\MockObject\MockObject;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceBuilderInterface;

class NotionProxyRestApiFactoryTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfOryx\Client\NotionProxyRestApi\NotionProxyRestApiClient
     */
    protected MockObject|NotionProxyRestApiClient $clientMock;

    /**
     * @var \FondOfOryx\Glue\NotionProxyRestApi\NotionProxyRestApiFactory
     */
    protected NotionProxyRestApiFactory $factory;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceBuilderInterface
     */
    protected MockObject|RestResourceBuilderInterface $restResourceBuilderMock;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->clientMock = $this->getMockBuilder(NotionProxyRestApiClient::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restResourceBuilderMock = $this->getMockBuilder(RestResourceBuilderInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->factory = new class ($this->restResourceBuilderMock) extends NotionProxyRestApiFactory {
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

        $this->factory->setClient($this->clientMock);
    }

    /**
     * @return void
     */
    public function testCreateNotionProxyRequestCreator(): void
    {
        static::assertInstanceOf(
            NotionProxyRequestCreatorInterface::class,
            $this->factory->createNotionProxyRequestCreator(),
        );
    }
}
