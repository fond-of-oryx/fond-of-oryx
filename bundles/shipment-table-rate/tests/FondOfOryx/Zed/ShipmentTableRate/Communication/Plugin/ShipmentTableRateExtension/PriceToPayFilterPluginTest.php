<?php

namespace FondOfOryx\Zed\ShipmentTableRate\Communication\Plugin\ShipmentTableRateExtension;

use Codeception\Test\Unit;
use Generated\Shared\Transfer\GiftCardMetadataTransfer;
use Generated\Shared\Transfer\ItemTransfer;
use Generated\Shared\Transfer\QuoteTransfer;
use Generated\Shared\Transfer\TotalsTransfer;

class PriceToPayFilterPluginTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\QuoteTransfer
     */
    protected $quoteTransferMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\ItemTransfer
     */
    protected $itemTransferMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\GiftCardMetadataTransfer
     */
    protected $giftCardMetadataTransferMock;

    /**
     * @var \Generated\Shared\Transfer\TotalsTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $totalsTransferMock;

    /**
     * @var \FondOfOryx\Zed\ShipmentTableRate\Communication\Plugin\ShipmentTableRateExtension\PriceToPayFilterPlugin
     */
    protected $priceToPayFilterPlugin;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->quoteTransferMock = $this->getMockBuilder(QuoteTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->itemTransferMock = $this->getMockBuilder(ItemTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->giftCardMetadataTransferMock = $this->getMockBuilder(GiftCardMetadataTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->totalsTransferMock = $this->getMockBuilder(TotalsTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->priceToPayFilterPlugin = new PriceToPayFilterPlugin();
    }

    /**
     * @return void
     */
    public function testFilterWithDiscount(): void
    {
        $subTotal = 1990;
        $discount = 800;

        $this->quoteTransferMock->expects(static::atLeastOnce())
            ->method('getTotals')
            ->willReturn($this->totalsTransferMock);

        $this->quoteTransferMock->expects(static::atLeastOnce())
            ->method('getItems')
            ->willReturn([$this->itemTransferMock]);

        $this->itemTransferMock->expects(static::atLeastOnce())
            ->method('getGiftCardMetadata')
            ->willReturn($this->giftCardMetadataTransferMock);

        $this->giftCardMetadataTransferMock->expects(static::atLeastOnce())
            ->method('getIsGiftCard')
            ->willReturn(true);

        $this->totalsTransferMock->expects(static::atLeastOnce())
            ->method('getSubtotal')
            ->willReturn($subTotal);

        $this->totalsTransferMock->expects(static::atLeastOnce())
            ->method('getDiscountTotal')
            ->willReturn($discount);

        $this->priceToPayFilterPlugin->filter($this->quoteTransferMock);

        static::assertEquals(
            $subTotal - $discount,
            $this->priceToPayFilterPlugin->filter($this->quoteTransferMock),
        );
    }

    /**
     * @return void
     */
    public function testFilterWithoutDiscount(): void
    {
        $subTotal = 1990;
        $discount = 0;

        $this->quoteTransferMock->expects(static::atLeastOnce())
            ->method('getTotals')
            ->willReturn($this->totalsTransferMock);

        $this->quoteTransferMock->expects(static::atLeastOnce())
            ->method('getItems')
            ->willReturn([$this->itemTransferMock]);

        $this->itemTransferMock->expects(static::atLeastOnce())
            ->method('getGiftCardMetadata')
            ->willReturn($this->giftCardMetadataTransferMock);

        $this->giftCardMetadataTransferMock->expects(static::atLeastOnce())
            ->method('getIsGiftCard')
            ->willReturn(true);

        $this->totalsTransferMock->expects(static::atLeastOnce())
            ->method('getSubtotal')
            ->willReturn($subTotal);

        $this->totalsTransferMock->expects(static::atLeastOnce())
            ->method('getDiscountTotal')
            ->willReturn($discount);

        static::assertEquals(
            $subTotal - $discount,
            $this->priceToPayFilterPlugin->filter($this->quoteTransferMock),
        );
    }
}
