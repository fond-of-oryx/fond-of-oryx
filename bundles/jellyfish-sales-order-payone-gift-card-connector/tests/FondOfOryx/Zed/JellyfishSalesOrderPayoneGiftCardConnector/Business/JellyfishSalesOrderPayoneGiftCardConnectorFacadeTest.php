<?php

namespace FondOfOryx\Zed\JellyfishSalesOrderPayoneGiftCardConnector\Business;

use Codeception\Test\Unit;
use FondOfOryx\Zed\JellyfishSalesOrderPayoneGiftCardConnector\Business\Calculator\ProportionalGiftCardAmountCalculatorInterface;
use FondOfOryx\Zed\JellyfishSalesOrderPayoneGiftCardConnector\Business\Expander\OrderItemsExpanderInterface;
use FondOfOryx\Zed\JellyfishSalesOrderPayoneGiftCardConnector\Business\Manager\ProportionalGiftCardValueManagerInterface;
use Generated\Shared\Transfer\ItemTransfer;
use Generated\Shared\Transfer\JellyfishOrderTransfer;

class JellyfishSalesOrderPayoneGiftCardConnectorFacadeTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\JellyfishSalesOrderPayoneGiftCardConnector\Business\JellyfishSalesOrderPayoneGiftCardConnectorBusinessFactory|\PHPUnit\Framework\MockObject\MockObject|null
     */
    protected $factoryMock;

    /**
     * @var \FondOfOryx\Zed\JellyfishSalesOrderPayoneGiftCardConnector\Business\Calculator\ProportionalGiftCardAmountCalculatorInterface|\PHPUnit\Framework\MockObject\MockObject|null
     */
    protected $proportionalGiftCardAmountCalculatorMock;

    /**
     * @var \FondOfOryx\Zed\JellyfishSalesOrderPayoneGiftCardConnector\Business\Manager\ProportionalGiftCardValueManagerInterface|\PHPUnit\Framework\MockObject\MockObject|null
     */
    protected $proportionalGiftCardValueManagerMock;

    /**
     * @var \FondOfOryx\Zed\JellyfishSalesOrderPayoneGiftCardConnector\Business\Expander\OrderItemsExpanderInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $orderItemsExpanderMock;

    /**
     * @var \Generated\Shared\Transfer\JellyfishOrderTransfer|\PHPUnit\Framework\MockObject\MockObject|null
     */
    protected $jellyfishOrderTransferMock;

    /**
     * @var array<\Generated\Shared\Transfer\ItemTransfer|\PHPUnit\Framework\MockObject\MockObject>
     */
    protected $itemTransferMocks;

    /**
     * @var \FondOfOryx\Zed\JellyfishSalesOrderPayoneGiftCardConnector\Business\JellyfishSalesOrderPayoneGiftCardConnectorFacade
     */
    protected $facade;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->jellyfishOrderTransferMock = $this
            ->getMockBuilder(JellyfishOrderTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->proportionalGiftCardAmountCalculatorMock = $this
            ->getMockBuilder(ProportionalGiftCardAmountCalculatorInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->proportionalGiftCardValueManagerMock = $this
            ->getMockBuilder(ProportionalGiftCardValueManagerInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->orderItemsExpanderMock = $this
            ->getMockBuilder(OrderItemsExpanderInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->itemTransferMocks = [
            $this->getMockBuilder(ItemTransfer::class)
                ->disableOriginalConstructor()
                ->getMock(),
        ];

        $this->factoryMock = $this
            ->getMockBuilder(JellyfishSalesOrderPayoneGiftCardConnectorBusinessFactory::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->facade = new JellyfishSalesOrderPayoneGiftCardConnectorFacade();
        $this->facade->setFactory($this->factoryMock);
    }

    /**
     * @return void
     */
    public function testCalculateProportionalGiftCardValues(): void
    {
        $idSalesOrder = 1;
        $this->factoryMock->expects(static::atLeastOnce())
            ->method('createProportionalGiftCardValueCalculator')
            ->willReturn($this->proportionalGiftCardAmountCalculatorMock);

        $this->proportionalGiftCardAmountCalculatorMock->expects(static::atLeastOnce())
            ->method('calculate')
            ->with($this->jellyfishOrderTransferMock, $idSalesOrder)
            ->willReturn($this->jellyfishOrderTransferMock);

        static::assertEquals(
            $this->jellyfishOrderTransferMock,
            $this->facade->calculateProportionalGiftCardValues($this->jellyfishOrderTransferMock, $idSalesOrder),
        );
    }

    /**
     * @return void
     */
    public function testPersistProportionalCouponValues(): void
    {
        $this->factoryMock->expects(static::atLeastOnce())
            ->method('createProportionalGiftCardValueManager')
            ->willReturn($this->proportionalGiftCardValueManagerMock);

        $this->proportionalGiftCardValueManagerMock->expects(static::atLeastOnce())
            ->method('persistProportionalGiftCardValuesFromExport')
            ->with($this->jellyfishOrderTransferMock);

        $this->facade->persistProportionalCouponValues($this->jellyfishOrderTransferMock);
    }

    /**
     * @return void
     */
    public function testExpandOrderItems(): void
    {
        $this->factoryMock->expects(static::atLeastOnce())
            ->method('createOrderItemsExpander')
            ->willReturn($this->orderItemsExpanderMock);

        $this->orderItemsExpanderMock->expects(static::atLeastOnce())
            ->method('expand')
            ->with($this->itemTransferMocks)
            ->willReturn($this->itemTransferMocks);

        static::assertEquals(
            $this->itemTransferMocks,
            $this->facade->expandOrderItems($this->itemTransferMocks),
        );
    }
}
