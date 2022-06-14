<?php

namespace FondOfOryx\Glue\CartSearchRestApi\Plugin\GlueApplicationExtension;

use Codeception\Test\Unit;
use FondOfOryx\Glue\CartSearchRestApi\CartSearchRestApiConfig;
use FondOfOryx\Glue\CartSearchRestApi\CartSearchRestApiFactory;
use FondOfOryx\Glue\CartSearchRestApi\Processor\Expander\QuoteResourceRelationshipExpanderInterface;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceInterface;
use Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface;
use Spryker\Glue\Kernel\AbstractFactory;

class CartItemsByQuoteResourceRelationshipPluginTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfOryx\Glue\CartSearchRestApi\CartSearchRestApiFactory
     */
    protected $factoryMock;

    /**
     * @var array<\Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceInterface>|array<\PHPUnit\Framework\MockObject\MockObject>
     */
    protected $restResourceMocks;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface
     */
    protected $restRequestMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfOryx\Glue\CartSearchRestApi\Processor\Expander\QuoteResourceRelationshipExpanderInterface
     */
    protected $quoteResourceRelationshipExpanderMock;

    /**
     * @var \FondOfOryx\Glue\CartSearchRestApi\Plugin\GlueApplicationExtension\CartItemsByQuoteResourceRelationshipPlugin
     */
    protected $plugin;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->factoryMock = $this->getMockBuilder(CartSearchRestApiFactory::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restResourceMocks = [
            $this->getMockBuilder(RestResourceInterface::class)
                ->disableOriginalConstructor()
                ->getMock(),
        ];

        $this->restRequestMock = $this->getMockBuilder(RestRequestInterface::class)
                ->disableOriginalConstructor()
                ->getMock();

        $this->quoteResourceRelationshipExpanderMock = $this->getMockBuilder(QuoteResourceRelationshipExpanderInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->plugin = new class (
            $this->factoryMock
        ) extends CartItemsByQuoteResourceRelationshipPlugin {
            /**
             * @var \FondOfOryx\Glue\CartSearchRestApi\CartSearchRestApiFactory
             */
            protected $companyBusinessUnitsCartsRestApiFactory;

            /**
             * @param \FondOfOryx\Glue\CartSearchRestApi\CartSearchRestApiFactory $companyBusinessUnitsCartsRestApiFactory
             */
            public function __construct(
                CartSearchRestApiFactory $companyBusinessUnitsCartsRestApiFactory
            ) {
                $this->companyBusinessUnitsCartsRestApiFactory = $companyBusinessUnitsCartsRestApiFactory;
            }

            /**
             * @return \Spryker\Glue\Kernel\AbstractFactory
             */
            protected function getFactory(): AbstractFactory
            {
                return $this->companyBusinessUnitsCartsRestApiFactory;
            }
        };
    }

    /**
     * @return void
     */
    public function testAddResourceRelationships(): void
    {
        $this->factoryMock->expects(static::atLeastOnce())
            ->method('createQuoteResourceRelationshipExpander')
            ->willReturn($this->quoteResourceRelationshipExpanderMock);

        $this->quoteResourceRelationshipExpanderMock->expects(static::atLeastOnce())
            ->method('expand')
            ->with($this->restResourceMocks, $this->restRequestMock);

        $this->plugin->addResourceRelationships(
            $this->restResourceMocks,
            $this->restRequestMock,
        );
    }

    /**
     * @return void
     */
    public function testGetRelationshipResourceType(): void
    {
        static::assertEquals(
            CartSearchRestApiConfig::RESOURCE_CART_ITEMS,
            $this->plugin->getRelationshipResourceType(),
        );
    }
}
