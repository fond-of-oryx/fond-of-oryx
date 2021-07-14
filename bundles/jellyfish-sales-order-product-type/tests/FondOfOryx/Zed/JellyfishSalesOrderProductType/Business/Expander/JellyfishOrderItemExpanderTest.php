<?php

namespace FondOfOryx\Zed\JellyfishSalesOrderProductType\Business\Expander;

use Codeception\Test\Unit;
use FondOfOryx\Zed\JellyfishSalesOrderProductType\Dependency\Facade\JellyfishSalesOrderProductTypeToGiftCardFacadeInterface;
use Generated\Shared\Transfer\JellyfishOrderItemTransfer;
use Orm\Zed\Sales\Persistence\SpySalesOrderItem;

class JellyfishOrderItemExpanderTest extends Unit
{
    /**
     * @var \Generated\Shared\Transfer\JellyfishOrderItemTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $jellyfishOrderItemTransferMock;

    /**
     * @var \FondOfOryx\Zed\JellyfishSalesOrderProductType\Business\Expander\JellyfishOrderItemExpanderInterface
     */
    protected $expander;

    /**
     * @var \FondOfOryx\Zed\JellyfishSalesOrderProductType\Dependency\Facade\JellyfishSalesOrderProductTypeToGiftCardFacadeInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $facadeMock;

    /**
     * @var \Orm\Zed\Sales\Persistence\SpySalesOrderItem|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $spySalesOrderItemMock;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->jellyfishOrderItemTransferMock = $this->getMockBuilder(JellyfishOrderItemTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->spySalesOrderItemMock = $this->getMockBuilder(SpySalesOrderItem::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->facadeMock = $this->getMockBuilder(JellyfishSalesOrderProductTypeToGiftCardFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->expander = new JellyfishOrderItemExpander($this->facadeMock);
    }

    /**
     * @return void
     */
    public function testExpandWithTypeGiftCard(): void
    {
        $this->jellyfishOrderItemTransferMock->expects(static::atLeastOnce())
            ->method('setProductType')
            ->willReturn($this->jellyfishOrderItemTransferMock);

        $this->spySalesOrderItemMock->expects(static::atLeastOnce())
            ->method('getIdSalesOrderItem')
            ->willReturn(1);

        $this->facadeMock->expects(static::atLeastOnce())
            ->method('isGiftCardOrderItem')
            ->with(1)
            ->willReturn(true);

        $jellyfishOrderItemTransfer = $this->expander->expand(
            $this->jellyfishOrderItemTransferMock,
            $this->spySalesOrderItemMock
        );

        $this->assertInstanceOf(JellyfishOrderItemTransfer::class, $this->jellyfishOrderItemTransferMock);

        $this->assertEquals($jellyfishOrderItemTransfer, $this->jellyfishOrderItemTransferMock);
    }

    /**
     * @return void
     */
    public function testExpandWithTypeProduct(): void
    {
        $this->jellyfishOrderItemTransferMock->expects(static::atLeastOnce())
            ->method('setProductType')
            ->willReturn($this->jellyfishOrderItemTransferMock);

        $this->spySalesOrderItemMock->expects(static::atLeastOnce())
            ->method('getIdSalesOrderItem')
            ->willReturn(1);

        $this->facadeMock->expects(static::atLeastOnce())
            ->method('isGiftCardOrderItem')
            ->with(1)
            ->willReturn(false);

        $jellyfishOrderItemTransfer = $this->expander->expand(
            $this->jellyfishOrderItemTransferMock,
            $this->spySalesOrderItemMock
        );

        $this->assertInstanceOf(JellyfishOrderItemTransfer::class, $this->jellyfishOrderItemTransferMock);

        $this->assertEquals($jellyfishOrderItemTransfer, $this->jellyfishOrderItemTransferMock);
    }
}
