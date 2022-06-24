<?php

namespace FondOfOryx\Zed\JellyfishSalesOrderGiftCardProportionalValueConnector\Business;

use Codeception\Test\Unit;
use FondOfOryx\Zed\JellyfishSalesOrderGiftCardProportionalValueConnector\Business\Expander\OrderItemsExpander;
use FondOfOryx\Zed\JellyfishSalesOrderGiftCardProportionalValueConnector\Business\Mapper\ProportionalValueMapperInterface;
use FondOfOryx\Zed\JellyfishSalesOrderGiftCardProportionalValueConnector\Dependency\Facade\JellyfishSalesOrderGiftCardProportionalValueConnectorToGiftCardProportionalValueFacadeInterface;
use FondOfOryx\Zed\JellyfishSalesOrderGiftCardProportionalValueConnector\JellyfishSalesOrderGiftCardProportionalValueConnectorConfig;
use FondOfOryx\Zed\JellyfishSalesOrderGiftCardProportionalValueConnector\JellyfishSalesOrderGiftCardProportionalValueConnectorDependencyProvider;
use Spryker\Zed\Kernel\Container;

class JellyfishSalesOrderGiftCardProportionalValueConnectorBusinessFactoryTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\JellyfishSalesOrderGiftCardProportionalValueConnector\JellyfishSalesOrderGiftCardProportionalValueConnectorConfig|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $configMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Zed\Kernel\Container
     */
    protected $containerMock;

    /**
     * @var \FondOfOryx\Zed\JellyfishSalesOrderGiftCardProportionalValueConnector\Dependency\Facade\JellyfishSalesOrderGiftCardProportionalValueConnectorToGiftCardProportionalValueFacadeInterface|\PHPUnit\Framework\MockObject\MockObject|null
     */
    protected $proportionalValueConnectorFacadeMock;

    /**
     * @var \FondOfOryx\Zed\JellyfishSalesOrderGiftCardProportionalValueConnector\Business\JellyfishSalesOrderGiftCardProportionalValueConnectorBusinessFactory
     */
    protected $factory;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->configMock =
            $this->getMockBuilder(JellyfishSalesOrderGiftCardProportionalValueConnectorConfig::class)
                ->disableOriginalConstructor()
                ->getMock();

        $this->containerMock = $this->getMockBuilder(Container::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->proportionalValueConnectorFacadeMock = $this
            ->getMockBuilder(JellyfishSalesOrderGiftCardProportionalValueConnectorToGiftCardProportionalValueFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

         $this->factory = new JellyfishSalesOrderGiftCardProportionalValueConnectorBusinessFactory();
         $this->factory->setConfig($this->configMock);
         $this->factory->setContainer($this->containerMock);
    }

    /**
     * @return void
     */
    public function testCreateGiftCardProportionalValueMapper(): void
    {
        $this->assertInstanceOf(ProportionalValueMapperInterface::class, $this->factory->createGiftCardProportionalValueMapper());
    }

    /**
     * @return void
     */
    public function testCreateOrderItemsExpander(): void
    {
        $this->containerMock->expects(static::atLeastOnce())
            ->method('has')
            ->withConsecutive(
                [JellyfishSalesOrderGiftCardProportionalValueConnectorDependencyProvider::FACADE_GIFT_CARD_PROPORTIONAL_VALUE],
            )
            ->willReturn(true);

        $this->containerMock->expects(static::atLeastOnce())
            ->method('get')
            ->withConsecutive(
                [JellyfishSalesOrderGiftCardProportionalValueConnectorDependencyProvider::FACADE_GIFT_CARD_PROPORTIONAL_VALUE],
            )
            ->willReturnOnConsecutiveCalls($this->proportionalValueConnectorFacadeMock);

        static::assertInstanceOf(
            OrderItemsExpander::class,
            $this->factory->createOrderItemsExpander(),
        );
    }
}
