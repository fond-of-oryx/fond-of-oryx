<?php

namespace FondOfOryx\Zed\JellyfishSalesOrderPayoneGiftCardConnector\Communication\Plugin;

use Codeception\Test\Unit;
use FondOfOryx\Zed\JellyfishSalesOrderPayoneGiftCardConnector\Business\JellyfishSalesOrderPayoneGiftCardConnectorFacade;
use Generated\Shared\Transfer\JellyfishOrderGiftCardTransfer;
use Generated\Shared\Transfer\JellyfishOrderTransfer;
use Orm\Zed\Sales\Persistence\SpySalesOrder;

class JellyfishPayoneProportionalGiftCardCouponValuePostMapPluginTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\JellyfishSalesOrderPayoneGiftCardConnector\Business\JellyfishSalesOrderPayoneGiftCardConnectorFacadeInterface|\PHPUnit\Framework\MockObject\MockObject|null
     */
    protected $facadeMock;

    /**
     * @var \FondOfOryx\Zed\JellyfishSalesOrderPayoneGiftCardConnector\Communication\Plugin\JellyfishPayoneProportionalGiftCardCouponValuePostMapPlugin
     */
    protected $plugin;

    /**
     * @var \Generated\Shared\Transfer\JellyfishOrderTransfer|\PHPUnit\Framework\MockObject\MockObject|null
     */
    protected $jellyfishOrderTransferMock;

    /**
     * @var \FondOfOryx\Zed\JellyfishSalesOrderPayoneGiftCardConnector\Business\JellyfishSalesOrderPayoneGiftCardConnectorFacade|\PHPUnit\Framework\MockObject\MockObject|null
     */
    protected $jellyfishOrderGiftCardTransferMock;

    /**
     * @var \Orm\Zed\Sales\Persistence\SpySalesOrder|\PHPUnit\Framework\MockObject\MockObject|null
     */
    protected $salesOrderEntity;

    /**
     * @return void
     */
    protected function _before(): void
    {
        $this->jellyfishOrderTransferMock = $this
            ->getMockBuilder(JellyfishOrderTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->jellyfishOrderGiftCardTransferMock = $this
            ->getMockBuilder(JellyfishOrderGiftCardTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->salesOrderEntity = $this
            ->getMockBuilder(SpySalesOrder::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->facadeMock = $this
            ->getMockBuilder(JellyfishSalesOrderPayoneGiftCardConnectorFacade::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->plugin = new JellyfishPayoneProportionalGiftCardCouponValuePostMapPlugin();
        $this->plugin->setFacade($this->facadeMock);
    }

    /**
     * @return void
     */
    public function testPostMap(): void
    {
        $idSalesOrder = 1;
        $this->facadeMock->expects(static::atLeastOnce())
            ->method('isPayonePayment')
            ->willReturn(true);

        $this->facadeMock->expects(static::atLeastOnce())
            ->method('calculateProportionalGiftCardValues')
            ->with($this->jellyfishOrderTransferMock, $idSalesOrder)
            ->willReturn($this->jellyfishOrderTransferMock);

        $this->salesOrderEntity->expects(static::atLeastOnce())
            ->method('getIdSalesOrder')
            ->willReturn($idSalesOrder);

        static::assertInstanceOf(
            JellyfishOrderTransfer::class,
            $this->plugin->postMap(
                $this->jellyfishOrderTransferMock,
                $this->salesOrderEntity,
            ),
        );
    }

    /**
     * @return void
     */
    public function testPostMapWitNoGiftCards(): void
    {
        $this->facadeMock->expects(static::atLeastOnce())
            ->method('isPayonePayment')
            ->willReturn(false);

        static::assertInstanceOf(
            JellyfishOrderTransfer::class,
            $this->plugin->postMap(
                $this->jellyfishOrderTransferMock,
                $this->salesOrderEntity,
            ),
        );
    }
}
