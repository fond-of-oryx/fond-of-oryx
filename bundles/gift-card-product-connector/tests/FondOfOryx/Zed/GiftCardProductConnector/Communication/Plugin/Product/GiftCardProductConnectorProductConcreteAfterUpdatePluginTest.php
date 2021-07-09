<?php

namespace FondOfOryx\Zed\GiftCardProductConnector\Communication\Plugin\Product;

use Codeception\Test\Unit;
use FondOfOryx\Zed\GiftCardProductConnector\Business\GiftCardProductConnectorFacade;
use Generated\Shared\Transfer\ProductConcreteTransfer;

class GiftCardProductConnectorProductConcreteAfterUpdatePluginTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\GiftCardProductConnector\Business\GiftCardProductConnectorFacadeInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $facadeMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\ProductConcreteTransfer
     */
    protected $productConcreteTransferMock;

    /**
     * @var \FondOfOryx\Zed\GiftCardProductConnector\Communication\Plugin\Product\GiftCardProductConnectorProductConcreteAfterUpdatePlugin
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

        $this->productConcreteTransferMock = $this->getMockBuilder(ProductConcreteTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->plugin = new GiftCardProductConnectorProductConcreteAfterUpdatePlugin();
        $this->plugin->setFacade($this->facadeMock);
    }

    /**
     * @return void
     */
    public function testCreate(): void
    {
        $this->facadeMock->expects(static::atLeastOnce())
            ->method('saveGiftCardProductConfiguration')
            ->with($this->productConcreteTransferMock)
            ->willReturn($this->productConcreteTransferMock);

        $productConcreteTransfer = $this->plugin->update($this->productConcreteTransferMock);

        static::assertInstanceOf(ProductConcreteTransfer::class, $productConcreteTransfer);
        static::assertEquals($this->productConcreteTransferMock, $productConcreteTransfer);
    }
}
