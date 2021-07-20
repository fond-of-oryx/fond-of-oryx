<?php

namespace FondOfOryx\Zed\GiftCardRestriction\Communication\Plugin\GiftCard;

use Codeception\Test\Unit;
use Generated\Shared\Transfer\DiscountTransfer;
use Generated\Shared\Transfer\GiftCardTransfer;
use Generated\Shared\Transfer\QuoteTransfer;
use Laminas\Stdlib\ArrayObject;

class VoucherIsUsedDecisionRulePluginTest extends Unit
{
    /**
     * @var \Generated\Shared\Transfer\QuoteTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $quoteTransferMock;

    /**
     * @var \Generated\Shared\Transfer\GiftCardTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $giftCardTransferMock;

    /**
     * @var \Generated\Shared\Transfer\DiscountTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $voucherDiscountTransferMock;

    /**
     * @var \FondOfOryx\Zed\GiftCardRestriction\Communication\Plugin\GiftCard\VoucherIsUsedDecisionRulePlugin
     */
    protected $plugin;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->quoteTransferMock = $this->getMockBuilder(QuoteTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->giftCardTransferMock = $this->getMockBuilder(GiftCardTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->voucherDiscountTransferMock = $this->getMockBuilder(DiscountTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->plugin = new VoucherIsUsedDecisionRulePlugin();
    }

    /**
     * @return void
     */
    public function testIsApplicable(): void
    {
        $code = 'FOO-BAR-1234-5678';
        $voucherDiscountTransferMocks = [$this->voucherDiscountTransferMock];

        $this->quoteTransferMock->expects(static::atLeastOnce())
            ->method('getVoucherDiscounts')
            ->willReturn(new ArrayObject($voucherDiscountTransferMocks));

        $this->voucherDiscountTransferMock->expects(static::atLeastOnce())
            ->method('getVoucherCode')
            ->willReturn($code);

        $this->giftCardTransferMock->expects(static::atLeastOnce())
            ->method('getCode')
            ->willReturn($code);

        static::assertTrue($this->plugin->isApplicable($this->giftCardTransferMock, $this->quoteTransferMock));
    }

    /**
     * @return void
     */
    public function testIsApplicableWithoutVoucherDiscounts(): void
    {
        $this->quoteTransferMock->expects(static::atLeastOnce())
            ->method('getVoucherDiscounts')
            ->willReturn(new ArrayObject());

        $this->giftCardTransferMock->expects(static::never())
            ->method('getCode');

        static::assertTrue($this->plugin->isApplicable($this->giftCardTransferMock, $this->quoteTransferMock));
    }

    /**
     * @return void
     */
    public function testIsApplicableWithMultipleVoucherDiscounts(): void
    {
        $voucherDiscountTransferMocks = [
            $this->voucherDiscountTransferMock,
            $this->getMockBuilder(DiscountTransfer::class)
                ->disableOriginalConstructor()
                ->getMock(),
        ];

        $this->quoteTransferMock->expects(static::atLeastOnce())
            ->method('getVoucherDiscounts')
            ->willReturn(new ArrayObject($voucherDiscountTransferMocks));

        $this->giftCardTransferMock->expects(static::never())
            ->method('getCode');

        static::assertFalse($this->plugin->isApplicable($this->giftCardTransferMock, $this->quoteTransferMock));
    }
}
