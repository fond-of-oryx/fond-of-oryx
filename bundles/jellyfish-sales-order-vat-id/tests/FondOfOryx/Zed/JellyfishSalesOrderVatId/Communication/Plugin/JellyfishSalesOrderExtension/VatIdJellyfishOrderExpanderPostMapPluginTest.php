<?php

namespace FondOfOryx\Zed\JellyfishSalesOrderVatId\Communication\Plugin\JellyfishSalesOrderExtension;

use Codeception\Test\Unit;
use Generated\Shared\Transfer\JellyfishOrderTransfer;
use Orm\Zed\Sales\Persistence\SpySalesOrder;
use Orm\Zed\Sales\Persistence\SpySalesOrderAddress;

class VatIdJellyfishOrderExpanderPostMapPluginTest extends Unit
{
    /**
     * @var \Generated\Shared\Transfer\JellyfishOrderTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $jellyfishOrderTransferMock;

    /**
     * @var \Orm\Zed\Sales\Persistence\SpySalesOrder|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $spySalesOrderMock;

    /**
     * @var \Orm\Zed\Sales\Persistence\SpySalesOrderAddress|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $spySalesOrderAddressMock;

    /**
     * @var \FondOfOryx\Zed\JellyfishSalesOrderVatId\Communication\Plugin\JellyfishSalesOrderExtension\VatIdJellyfishOrderExpanderPostMapPlugin
     */
    protected $plugin;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->jellyfishOrderTransferMock = $this->getMockBuilder(JellyfishOrderTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->spySalesOrderMock = $this->getMockBuilder(SpySalesOrder::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->spySalesOrderAddressMock = $this->getMockBuilder(SpySalesOrderAddress::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->plugin = new VatIdJellyfishOrderExpanderPostMapPlugin();
    }

    /**
     * @return void
     */
    public function testExpand(): void
    {
        $vatId = 'DE123456789';

        $this->spySalesOrderMock->expects(static::atLeastOnce())
            ->method('getShippingAddress')
            ->willReturn($this->spySalesOrderAddressMock);

        $this->spySalesOrderAddressMock->expects(static::atLeastOnce())
            ->method('getVatId')
            ->willReturn($vatId);

        $this->jellyfishOrderTransferMock->expects(static::atLeastOnce())
            ->method('setVatId')
            ->with($vatId)
            ->willReturn($this->jellyfishOrderTransferMock);

        static::assertEquals(
            $this->jellyfishOrderTransferMock,
            $this->plugin->expand(
                $this->jellyfishOrderTransferMock,
                $this->spySalesOrderMock,
            ),
        );
    }

    /**
     * @return void
     */
    public function testExpandWithoutShippingAddress(): void
    {
        $this->spySalesOrderMock->expects(static::atLeastOnce())
            ->method('getShippingAddress')
            ->willReturn(null);

        $this->jellyfishOrderTransferMock->expects(static::never())
            ->method('setVatId');

        static::assertEquals(
            $this->jellyfishOrderTransferMock,
            $this->plugin->expand(
                $this->jellyfishOrderTransferMock,
                $this->spySalesOrderMock,
            ),
        );
    }

    /**
     * @return void
     */
    public function testExpandWithoutVatId(): void
    {
        $this->spySalesOrderMock->expects(static::atLeastOnce())
            ->method('getShippingAddress')
            ->willReturn($this->spySalesOrderAddressMock);

        $this->spySalesOrderAddressMock->expects(static::atLeastOnce())
            ->method('getVatId')
            ->willReturn(null);

        $this->jellyfishOrderTransferMock->expects(static::never())
            ->method('setVatId');

        static::assertEquals(
            $this->jellyfishOrderTransferMock,
            $this->plugin->expand(
                $this->jellyfishOrderTransferMock,
                $this->spySalesOrderMock,
            ),
        );
    }
}
