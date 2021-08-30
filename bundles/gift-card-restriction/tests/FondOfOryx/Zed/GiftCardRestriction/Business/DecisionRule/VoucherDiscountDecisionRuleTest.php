<?php

namespace FondOfOryx\Zed\GiftCardRestriction\Business\DecisionRule;

use ArrayObject;
use Codeception\Test\Unit;
use Generated\Shared\Transfer\DiscountTransfer;
use Generated\Shared\Transfer\GiftCardTransfer;
use Generated\Shared\Transfer\QuoteTransfer;

class VoucherDiscountDecisionRuleTest extends Unit
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
     * @var \FondOfOryx\Zed\GiftCardRestriction\Business\DecisionRule\VoucherDiscountDecisionRule
     */
    protected $decisionRule;

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

        $this->decisionRule = new VoucherDiscountDecisionRule();
    }

    /**
     * @return void
     */
    public function testIsSatisfiedBy(): void
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

        static::assertTrue($this->decisionRule->isSatisfiedBy($this->giftCardTransferMock, $this->quoteTransferMock));
    }

    /**
     * @return void
     */
    public function testIsSatisfiedByWithoutVoucherDiscounts(): void
    {
        $this->quoteTransferMock->expects(static::atLeastOnce())
            ->method('getVoucherDiscounts')
            ->willReturn(new ArrayObject());

        $this->giftCardTransferMock->expects(static::never())
            ->method('getCode');

        static::assertTrue($this->decisionRule->isSatisfiedBy($this->giftCardTransferMock, $this->quoteTransferMock));
    }

    /**
     * @return void
     */
    public function testIsSatisfiedByWithMultipleVoucherDiscounts(): void
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

        static::assertFalse($this->decisionRule->isSatisfiedBy($this->giftCardTransferMock, $this->quoteTransferMock));
    }
}
