<?php

namespace FondOfOryx\Zed\JellyfishSalesOrderGiftCardProportionalValueConnector\Business;

use Codeception\Test\Unit;
use FondOfOryx\Zed\JellyfishSalesOrderGiftCardProportionalValueConnector\Business\Expander\OrderItemsExpanderInterface;
use FondOfOryx\Zed\JellyfishSalesOrderGiftCardProportionalValueConnector\Business\Mapper\GiftCardProportionalValueMapper;
use Generated\Shared\Transfer\ItemTransfer;
use Generated\Shared\Transfer\JellyfishOrderTransfer;
use Orm\Zed\Sales\Persistence\SpySalesOrder;

class JellyfishSalesOrderGiftCardProportionalValueConnectorFacadeTest extends Unit
{
    /**
     * @var \Orm\Zed\Sales\Persistence\SpySalesOrder|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $spySalesOrderMock;

    /**
     * @var \FondOfOryx\Zed\JellyfishSalesOrderGiftCardProportionalValueConnector\Business\JellyfishSalesOrderGiftCardProportionalValueConnectorBusinessFactory|\PHPUnit\Framework\MockObject\MockObject>
     */
    protected $factoryMock;

    /**
     * @var \FondOfOryx\Zed\JellyfishSalesOrderGiftCardProportionalValueConnector\Business\Mapper\ProportionalValueMapperInterface|\PHPUnit\Framework\MockObject\MockObject>
     */
    protected $giftCardProportionalValueMapperMock;

    /**
     * @var array<\Generated\Shared\Transfer\ItemTransfer|\PHPUnit\Framework\MockObject\MockObject>
     */
    protected $itemTransferMocks;

    /**
     * @var \FondOfOryx\Zed\JellyfishSalesOrderGiftCardProportionalValueConnector\Business\Mapper\ProportionalValueMapperInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $orderItemsExpanderMock;

    /**
     * @var \Generated\Shared\Transfer\JellyfishOrderTransfer|\PHPUnit\Framework\MockObject\MockObject>
     */
    protected $jellyfishOrderTransferMock;

    /**
     * @var \FondOfOryx\Zed\JellyfishSalesOrderGiftCardProportionalValueConnector\Business\JellyfishSalesOrderGiftCardProportionalValueConnectorFacade
     */
    protected $facade;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->spySalesOrderMock =
            $this->getMockBuilder(SpySalesOrder::class)
                ->disableOriginalConstructor()
                ->getMock();

        $this->factoryMock =
            $this->getMockBuilder(JellyfishSalesOrderGiftCardProportionalValueConnectorBusinessFactory::class)
                ->disableOriginalConstructor()
                ->getMock();

        $this->giftCardProportionalValueMapperMock =
            $this->getMockBuilder(GiftCardProportionalValueMapper::class)
                ->disableOriginalConstructor()
                ->getMock();

        $this->jellyfishOrderTransferMock =
            $this->getMockBuilder(JellyfishOrderTransfer::class)
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

        $this->facade = new JellyfishSalesOrderGiftCardProportionalValueConnectorFacade();
        $this->facade->setFactory($this->factoryMock);
    }

    /**
     * @return void
     */
    public function testMapProportionalGiftCardValues(): void
    {
        $this->factoryMock->expects(static::atLeastOnce())
            ->method('createGiftCardProportionalValueMapper')
            ->willReturn($this->giftCardProportionalValueMapperMock);

        $this->giftCardProportionalValueMapperMock->expects(static::atLeastOnce())
            ->method('fromSalesOrderToJellyfishOrder')
            ->willReturn($this->jellyfishOrderTransferMock);

        $this->facade->mapProportionalGiftCardValues($this->jellyfishOrderTransferMock, $this->spySalesOrderMock);
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
