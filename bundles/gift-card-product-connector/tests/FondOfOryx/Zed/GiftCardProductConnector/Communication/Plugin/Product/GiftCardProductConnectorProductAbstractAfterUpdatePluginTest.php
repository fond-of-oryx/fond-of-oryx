<?php

namespace FondOfOryx\Zed\GiftCardProductConnector\Communication\Plugin\Product;

use Codeception\Test\Unit;
use FondOfOryx\Zed\GiftCardProductConnector\Business\GiftCardProductConnectorFacade;
use Generated\Shared\Transfer\ProductAbstractTransfer;

class GiftCardProductConnectorProductAbstractAfterUpdatePluginTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\GiftCardProductConnector\Business\GiftCardProductConnectorFacadeInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $facadeMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\ProductAbstractTransfer
     */
    protected $productAbstractTransferMock;

    /**
     * @var \FondOfOryx\Zed\GiftCardProductConnector\Communication\Plugin\Product\GiftCardProductConnectorProductAbstractAfterUpdatePlugin
     */
    protected $plugin;

    /**
     * @return void
     */
    public function _before()
    {
        parent::_before();

        $this->facadeMock = $this->getMockBuilder(GiftCardProductConnectorFacade::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->productAbstractTransferMock = $this->getMockBuilder(ProductAbstractTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->plugin = new GiftCardProductConnectorProductAbstractAfterUpdatePlugin();
        $this->plugin->setFacade($this->facadeMock);
    }

    /**
     * @return void
     */
    public function testCreate(): void
    {
        $this->facadeMock->expects(static::atLeastOnce())
            ->method('saveGiftCardProductAbstractConfiguration')
            ->with($this->productAbstractTransferMock)
            ->willReturn($this->productAbstractTransferMock);

        $productAbstractTransfer = $this->plugin->update($this->productAbstractTransferMock);

        static::assertInstanceOf(ProductAbstractTransfer::class, $productAbstractTransfer);
        static::assertEquals($this->productAbstractTransferMock, $productAbstractTransfer);
    }
}
