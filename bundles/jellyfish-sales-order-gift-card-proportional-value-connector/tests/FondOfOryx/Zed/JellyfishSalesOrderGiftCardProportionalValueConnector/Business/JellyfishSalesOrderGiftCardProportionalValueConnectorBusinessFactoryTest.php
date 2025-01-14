<?php

namespace FondOfOryx\Zed\JellyfishSalesOrderGiftCardProportionalValueConnector\Business;

use Codeception\Test\Unit;
use Exception;
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
        $self = $this;

        $this->containerMock->expects(static::atLeastOnce())
            ->method('has')
            ->willReturn(true);

        $this->containerMock->expects($this->atLeastOnce())
            ->method('get')
            ->willReturnCallback(static function (string $key) use ($self) {
                switch ($key) {
                    case JellyfishSalesOrderGiftCardProportionalValueConnectorDependencyProvider::FACADE_GIFT_CARD_PROPORTIONAL_VALUE:
                        return $self->proportionalValueConnectorFacadeMock;
                }

                throw new Exception('Unexpected call');
            });

        static::assertInstanceOf(
            OrderItemsExpander::class,
            $this->factory->createOrderItemsExpander(),
        );
    }
}
