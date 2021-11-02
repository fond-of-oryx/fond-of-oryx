<?php

namespace FondOfOryx\Zed\ShipmentCartCodeConnector\Communication\Plugin\CartCodeExtension;

use Codeception\Test\Unit;
use FondOfOryx\Zed\ShipmentCartCodeConnector\Business\ShipmentCartCodeConnectorFacade;
use Generated\Shared\Transfer\QuoteTransfer;

class SanitizeCartShipmentCardCodePluginTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\ShipmentCartCodeConnector\Business\ShipmentCartCodeConnectorFacade|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $facadeMock;

    /**
     * @var \Generated\Shared\Transfer\QuoteTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $quoteTransferMock;

    /**
     * @var \FondOfOryx\Zed\ShipmentCartCodeConnector\Communication\Plugin\CartCodeExtension\SanitizeCartShipmentCardCodePlugin
     */
    protected $plugin;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->facadeMock = $this->getMockBuilder(ShipmentCartCodeConnectorFacade::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->quoteTransferMock = $this->getMockBuilder(QuoteTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->plugin = new SanitizeCartShipmentCardCodePlugin();
        $this->plugin->setFacade($this->facadeMock);
    }

    /**
     * @return void
     */
    public function testAddCartCode(): void
    {
        $this->facadeMock->expects(static::atLeastOnce())
            ->method('sanitizeShipment')
            ->with($this->quoteTransferMock)
            ->willReturn($this->quoteTransferMock);

        static::assertEquals(
            $this->quoteTransferMock,
            $this->plugin->addCartCode($this->quoteTransferMock, 'foo-bar-001-001'),
        );
    }

    /**
     * @return void
     */
    public function testRemoveCartCode(): void
    {
        $this->facadeMock->expects(static::atLeastOnce())
            ->method('sanitizeShipment')
            ->with($this->quoteTransferMock)
            ->willReturn($this->quoteTransferMock);

        static::assertEquals(
            $this->quoteTransferMock,
            $this->plugin->removeCartCode($this->quoteTransferMock, 'foo-bar-001-001'),
        );
    }

    /**
     * @return void
     */
    public function testClearCartCodes(): void
    {
        $this->facadeMock->expects(static::atLeastOnce())
            ->method('sanitizeShipment')
            ->with($this->quoteTransferMock)
            ->willReturn($this->quoteTransferMock);

        static::assertEquals(
            $this->quoteTransferMock,
            $this->plugin->clearCartCodes($this->quoteTransferMock),
        );
    }

    /**
     * @return void
     */
    public function testFindOperationResponseMessage(): void
    {
        static::assertEquals(
            null,
            $this->plugin->findOperationResponseMessage($this->quoteTransferMock, 'foo-bar-001-001'),
        );
    }
}
