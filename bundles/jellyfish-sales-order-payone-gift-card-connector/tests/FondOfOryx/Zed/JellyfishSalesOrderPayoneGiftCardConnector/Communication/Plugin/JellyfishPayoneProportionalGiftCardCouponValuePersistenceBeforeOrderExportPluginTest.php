<?php

namespace FondOfOryx\Zed\JellyfishSalesOrderPayoneGiftCardConnector\Communication\Plugin;

use ArrayObject;
use Codeception\Test\Unit;
use FondOfOryx\Zed\JellyfishSalesOrderPayoneGiftCardConnector\Business\JellyfishSalesOrderPayoneGiftCardConnectorFacade;
use Generated\Shared\Transfer\JellyfishOrderGiftCardTransfer;
use Generated\Shared\Transfer\JellyfishOrderTransfer;

class JellyfishPayoneProportionalGiftCardCouponValuePersistenceBeforeOrderExportPluginTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\JellyfishSalesOrderPayoneGiftCardConnector\Business\JellyfishSalesOrderPayoneGiftCardConnectorFacadeInterface|\PHPUnit\Framework\MockObject\MockObject|null
     */
    protected $facadeMock;

    /**
     * @var \FondOfOryx\Zed\JellyfishSalesOrderPayoneGiftCardConnector\Communication\Plugin\JellyfishPayoneProportionalGiftCardCouponValuePersistenceBeforeOrderExportPlugin
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
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->jellyfishOrderTransferMock = $this
            ->getMockBuilder(JellyfishOrderTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->jellyfishOrderGiftCardTransferMock = $this
            ->getMockBuilder(JellyfishOrderGiftCardTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->facadeMock = $this
            ->getMockBuilder(JellyfishSalesOrderPayoneGiftCardConnectorFacade::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->plugin = new JellyfishPayoneProportionalGiftCardCouponValuePersistenceBeforeOrderExportPlugin();
        $this->plugin->setFacade($this->facadeMock);
    }

    /**
     * @return void
     */
    public function testBefore(): void
    {
        $giftCards = new ArrayObject();
        $giftCards->append($this->jellyfishOrderTransferMock);

        $this->jellyfishOrderTransferMock->expects(static::atLeastOnce())
            ->method('getGiftCards')
            ->willReturn($giftCards);

        $this->facadeMock->expects(static::atLeastOnce())
            ->method('persistProportionalCouponValues')
            ->with($this->jellyfishOrderTransferMock);

        $this->plugin->before($this->jellyfishOrderTransferMock, []);
    }
}
