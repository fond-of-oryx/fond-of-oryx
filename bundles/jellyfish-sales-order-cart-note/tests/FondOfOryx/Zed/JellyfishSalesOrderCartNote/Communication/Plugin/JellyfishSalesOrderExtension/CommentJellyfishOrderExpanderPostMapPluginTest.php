<?php

namespace FondOfOryx\Zed\JellyfishSalesOrderCartNote\Communication\Plugin\JellyfishSalesOrderExtension;

use Codeception\Test\Unit;
use Generated\Shared\Transfer\JellyfishOrderTransfer;
use Orm\Zed\Sales\Persistence\SpySalesOrder;

class CommentJellyfishOrderExpanderPostMapPluginTest extends Unit
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
     * @var \FondOfOryx\Zed\JellyfishSalesOrderCartNote\Communication\Plugin\JellyfishSalesOrderExtension\CommentJellyfishOrderExpanderPostMapPlugin
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

        $this->plugin = new CommentJellyfishOrderExpanderPostMapPlugin();
    }

    /**
     * @return void
     */
    public function testExpand(): void
    {
        $cartNote = 'Foo';

        $this->spySalesOrderMock->expects(static::atLeastOnce())
            ->method('getCartNote')
            ->willReturn($cartNote);

        $this->jellyfishOrderTransferMock->expects(static::atLeastOnce())
            ->method('setComment')
            ->with($cartNote)
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
    public function testExpandWithEmptyCartNote(): void
    {
        $this->spySalesOrderMock->expects(static::atLeastOnce())
            ->method('getCartNote')
            ->willReturn(null);

        $this->jellyfishOrderTransferMock->expects(static::never())
            ->method('setComment');

        static::assertEquals(
            $this->jellyfishOrderTransferMock,
            $this->plugin->expand(
                $this->jellyfishOrderTransferMock,
                $this->spySalesOrderMock,
            ),
        );
    }
}
