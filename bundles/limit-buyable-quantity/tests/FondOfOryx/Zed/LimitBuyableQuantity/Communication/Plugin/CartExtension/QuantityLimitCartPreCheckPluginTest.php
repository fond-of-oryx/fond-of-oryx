<?php

namespace FondOfOryx\Zed\LimitBuyableQuantity\Communication\Plugin\CartExtension;

use ArrayObject;
use Codeception\Test\Unit;
use FondOfOryx\Zed\LimitBuyableQuantity\LimitBuyableQuantityConfig;
use Generated\Shared\Transfer\CartChangeTransfer;
use Generated\Shared\Transfer\ItemTransfer;

class QuantityLimitCartPreCheckPluginTest extends Unit
{
    /**
     * @var \Generated\Shared\Transfer\CartChangeTransfer|\PHPUnit\Framework\MockObject\MockObject|mixed
     */
    protected $cartChangeTransferMock;

    /**
     * @var \Generated\Shared\Transfer\ItemTransfer|\PHPUnit\Framework\MockObject\MockObject|mixed
     */
    protected $itemTransferMock;

    /**
     * @var \FondOfOryx\Zed\LimitBuyableQuantity\LimitBuyableQuantityConfig|\PHPUnit\Framework\MockObject\MockObject|mixed
     */
    protected $configMock;

    /**
     * @var \FondOfOryx\Zed\LimitBuyableQuantity\Communication\Plugin\CartExtension\QuantityLimitCartPreCheckPlugin
     */
    protected $plugin;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->cartChangeTransferMock = $this->getMockBuilder(CartChangeTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->itemTransferMock = $this->getMockBuilder(ItemTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->configMock = $this->getMockBuilder(LimitBuyableQuantityConfig::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->plugin = new QuantityLimitCartPreCheckPlugin();
        $this->plugin->setConfig($this->configMock);
    }

    /**
     * @return void
     */
    public function testCheckWithoutMaxQuantity(): void
    {
        $this->configMock->expects(static::atLeastOnce())
            ->method('getMaxQuantity')
            ->willReturn(null);

        $this->cartChangeTransferMock->expects(static::never())
            ->method('getItems');

        $cartPreCheckResponseTransfer = $this->plugin->check($this->cartChangeTransferMock);
        static::assertTrue($cartPreCheckResponseTransfer->getIsSuccess());
        static::assertCount(0, $cartPreCheckResponseTransfer->getMessages());
    }

    /**
     * @return void
     */
    public function testCheck(): void
    {
        $this->configMock->expects(static::atLeastOnce())
            ->method('getMaxQuantity')
            ->willReturn(5);

        $this->cartChangeTransferMock->expects(static::atLeastOnce())
            ->method('getItems')
            ->willReturn(new ArrayObject([$this->itemTransferMock]));

        $this->itemTransferMock->expects(static::atLeastOnce())
            ->method('getQuantity')
            ->willReturn(4);

        $cartPreCheckResponseTransfer = $this->plugin->check($this->cartChangeTransferMock);
        static::assertTrue($cartPreCheckResponseTransfer->getIsSuccess());
        static::assertCount(0, $cartPreCheckResponseTransfer->getMessages());
    }

    /**
     * @return void
     */
    public function testCheckWithError(): void
    {
        $this->configMock->expects(static::atLeastOnce())
            ->method('getMaxQuantity')
            ->willReturn(5);

        $this->cartChangeTransferMock->expects(static::atLeastOnce())
            ->method('getItems')
            ->willReturn(new ArrayObject([$this->itemTransferMock]));

        $this->itemTransferMock->expects(static::atLeastOnce())
            ->method('getQuantity')
            ->willReturn(6);

        $cartPreCheckResponseTransfer = $this->plugin->check($this->cartChangeTransferMock);
        static::assertFalse($cartPreCheckResponseTransfer->getIsSuccess());
        static::assertCount(1, $cartPreCheckResponseTransfer->getMessages());
    }
}
