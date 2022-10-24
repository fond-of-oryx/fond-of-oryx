<?php

namespace FondOfOryx\Glue\ProductListsRestApi;

use Codeception\Test\Unit;
use FondOfOryx\Client\ProductListsRestApi\ProductListsRestApiClient;
use FondOfOryx\Glue\ProductListsRestApi\Processor\Updater\ProductListUpdater;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceBuilderInterface;

class ProductListsRestApiFactoryTest extends Unit
{
    /**
     * @var \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceBuilderInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $restResourceBuilderMock;

    /**
     * @var \FondOfOryx\Client\ProductListsRestApi\ProductListsRestApiClient|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $clientMock;

    /**
     * @var \FondOfOryx\Glue\ProductListsRestApi\ProductListsRestApiFactory
     */
    protected $factory;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->restResourceBuilderMock = $this->getMockBuilder(RestResourceBuilderInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->clientMock = $this->getMockBuilder(ProductListsRestApiClient::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->factory = new class ($this->restResourceBuilderMock) extends ProductListsRestApiFactory {
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
    public function testCreateProductListUpdater(): void
    {
        static::assertInstanceOf(
            ProductListUpdater::class,
            $this->factory->createProductListUpdater(),
        );
    }
}
