<?php

namespace FondOfOryx\Zed\JellyfishSalesOrderPayoneGiftCardConnector\Business;

use Codeception\Test\Unit;
use Exception;
use FondOfOryx\Zed\JellyfishSalesOrderPayoneGiftCardConnector\Business\Calculator\ProportionalGiftCardAmountCalculator;
use FondOfOryx\Zed\JellyfishSalesOrderPayoneGiftCardConnector\Business\Expander\OrderItemsExpander;
use FondOfOryx\Zed\JellyfishSalesOrderPayoneGiftCardConnector\Business\Manager\ProportionalGiftCardValueManager;
use FondOfOryx\Zed\JellyfishSalesOrderPayoneGiftCardConnector\Dependency\Facade\JellyfishSalesOrderPayoneGiftCardConnectorToGiftCardProportionalValueFacadeInterface;
use FondOfOryx\Zed\JellyfishSalesOrderPayoneGiftCardConnector\Dependency\Facade\JellyfishSalesOrderPayoneGiftCardConnectorToSalesFacadeInterface;
use FondOfOryx\Zed\JellyfishSalesOrderPayoneGiftCardConnector\Dependency\Service\JellyfishSalesOrderPayoneGiftCardConnectorToPayoneServiceInterface;
use FondOfOryx\Zed\JellyfishSalesOrderPayoneGiftCardConnector\JellyfishSalesOrderPayoneGiftCardConnectorDependencyProvider;
use Spryker\Zed\Kernel\Container;

class JellyfishSalesOrderPayoneGiftCardConnectorBusinessFactoryTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\JellyfishSalesOrderPayoneGiftCardConnector\Dependency\Service\JellyfishSalesOrderPayoneGiftCardConnectorToPayoneServiceInterface|\PHPUnit\Framework\MockObject\MockObject|null
     */
    protected $payoneServiceMock;

    /**
     * @var \FondOfOryx\Zed\JellyfishSalesOrderPayoneGiftCardConnector\Dependency\Facade\JellyfishSalesOrderPayoneGiftCardConnectorToSalesFacadeInterface|\PHPUnit\Framework\MockObject\MockObject|null
     */
    protected $salesFacadeMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Zed\Kernel\Container
     */
    protected $containerMock;

    /**
     * @var \FondOfOryx\Zed\JellyfishSalesOrderPayoneGiftCardConnector\Dependency\Facade\JellyfishSalesOrderPayoneGiftCardConnectorToGiftCardProportionalValueFacadeInterface|\PHPUnit\Framework\MockObject\MockObject|null
     */
    protected $proportionalValueConnectorFacadeMock;

    /**
     * @var \FondOfOryx\Zed\JellyfishSalesOrderPayoneGiftCardConnector\Business\JellyfishSalesOrderPayoneGiftCardConnectorBusinessFactory
     */
    protected $factory;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->payoneServiceMock = $this
            ->getMockBuilder(JellyfishSalesOrderPayoneGiftCardConnectorToPayoneServiceInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->salesFacadeMock = $this
            ->getMockBuilder(JellyfishSalesOrderPayoneGiftCardConnectorToSalesFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->containerMock = $this->getMockBuilder(Container::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->proportionalValueConnectorFacadeMock = $this
            ->getMockBuilder(JellyfishSalesOrderPayoneGiftCardConnectorToGiftCardProportionalValueFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->factory = new JellyfishSalesOrderPayoneGiftCardConnectorBusinessFactory();
        $this->factory->setContainer($this->containerMock);
    }

    /**
     * @return void
     */
    public function testCreateProportionalGiftCardValueCalculator(): void
    {
        $self = $this;

        $this->containerMock->expects(static::atLeastOnce())
            ->method('has')
            ->willReturn(true);

        $this->containerMock->expects($this->atLeastOnce())
            ->method('get')
            ->willReturnCallback(static function (string $key) use ($self) {
                switch ($key) {
                    case JellyfishSalesOrderPayoneGiftCardConnectorDependencyProvider::SERVICE_PAYONE:
                        return $self->payoneServiceMock;
                    case JellyfishSalesOrderPayoneGiftCardConnectorDependencyProvider::FACADE_SALES:
                        return $self->salesFacadeMock;
                    case JellyfishSalesOrderPayoneGiftCardConnectorDependencyProvider::FACADE_GIFT_CARD_PROPORTIONAL_VALUE_CONNECTOR:
                        return $self->proportionalValueConnectorFacadeMock;
                }

                throw new Exception('Unexpected call');
            });

        static::assertInstanceOf(
            ProportionalGiftCardAmountCalculator::class,
            $this->factory->createProportionalGiftCardValueCalculator(),
        );
    }

    /**
     * @return void
     */
    public function testCreateProportionalGiftCardValueManager(): void
    {
        $self = $this;

        $this->containerMock->expects(static::atLeastOnce())
            ->method('has')
            ->willReturn(true);

        $this->containerMock->expects($this->atLeastOnce())
            ->method('get')
            ->willReturnCallback(static function (string $key) use ($self) {
                switch ($key) {
                    case JellyfishSalesOrderPayoneGiftCardConnectorDependencyProvider::FACADE_GIFT_CARD_PROPORTIONAL_VALUE_CONNECTOR:
                        return $self->proportionalValueConnectorFacadeMock;
                }

                throw new Exception('Unexpected call');
            });

        static::assertInstanceOf(
            ProportionalGiftCardValueManager::class,
            $this->factory->createProportionalGiftCardValueManager(),
        );
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
                    case JellyfishSalesOrderPayoneGiftCardConnectorDependencyProvider::FACADE_GIFT_CARD_PROPORTIONAL_VALUE_CONNECTOR:
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
