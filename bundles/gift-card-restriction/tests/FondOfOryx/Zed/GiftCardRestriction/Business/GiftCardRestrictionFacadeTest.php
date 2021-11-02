<?php

namespace FondOfOryx\Zed\GiftCardRestriction\Business;

use Codeception\Test\Unit;
use FondOfOryx\Zed\GiftCardRestriction\Business\Calculator\GiftCardRestrictionCalculatorInterface;
use FondOfOryx\Zed\GiftCardRestriction\Business\DecisionRule\BlacklistedCartCodeTypeDecisionRule;
use FondOfOryx\Zed\GiftCardRestriction\Business\DecisionRule\BlacklistedCountryDecisionRule;
use FondOfOryx\Zed\GiftCardRestriction\Business\DecisionRule\VoucherDiscountDecisionRule;
use Generated\Shared\Transfer\CalculableObjectTransfer;
use Generated\Shared\Transfer\GiftCardTransfer;
use Generated\Shared\Transfer\QuoteTransfer;

class GiftCardRestrictionFacadeTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\GiftCardRestriction\Business\GiftCardRestrictionBusinessFactory|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $factoryMock;

    /**
     * @var \FondOfOryx\Zed\GiftCardRestriction\Business\DecisionRule\BlacklistedCountryDecisionRule|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $blacklistedCountryDecisionRuleMock;

    /**
     * @var \FondOfOryx\Zed\GiftCardRestriction\Business\DecisionRule\VoucherDiscountDecisionRule|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $voucherDiscountDecisionRuleMock;

    /**
     * @var \FondOfOryx\Zed\GiftCardRestriction\Business\DecisionRule\BlacklistedCartCodeTypeDecisionRule|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $blacklistedCartCodeTypeDecisionRuleMock;

    /**
     * @var \Generated\Shared\Transfer\QuoteTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $quoteTransferMock;

    /**
     * @var \Generated\Shared\Transfer\GiftCardTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $giftCardTransferMock;

    /**
     * @var \FondOfOryx\Zed\GiftCardRestriction\Business\Calculator\GiftCardRestrictionCalculatorInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $giftCardRestrictionCalculatorMock;

    /**
     * @var \Generated\Shared\Transfer\CalculableObjectTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $calculableObjectTransferMock;

    /**
     * @var \FondOfOryx\Zed\GiftCardRestriction\Business\GiftCardRestrictionFacade
     */
    protected $facade;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->factoryMock = $this->getMockBuilder(GiftCardRestrictionBusinessFactory::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->blacklistedCountryDecisionRuleMock = $this->getMockBuilder(BlacklistedCountryDecisionRule::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->voucherDiscountDecisionRuleMock = $this->getMockBuilder(VoucherDiscountDecisionRule::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->blacklistedCartCodeTypeDecisionRuleMock = $this->getMockBuilder(BlacklistedCartCodeTypeDecisionRule::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->quoteTransferMock = $this->getMockBuilder(QuoteTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->giftCardTransferMock = $this->getMockBuilder(GiftCardTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->giftCardRestrictionCalculatorMock = $this->getMockBuilder(GiftCardRestrictionCalculatorInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->calculableObjectTransferMock = $this->getMockBuilder(CalculableObjectTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->facade = new GiftCardRestrictionFacade();
        $this->facade->setFactory($this->factoryMock);
    }

    /**
     * @return void
     */
    public function testIsBlacklistedCountryDecisionRuleSatisfiedBy(): void
    {
        $this->factoryMock->expects(static::atLeastOnce())
            ->method('createBlacklistedCountryDecisionRule')
            ->willReturn($this->blacklistedCountryDecisionRuleMock);

        $this->blacklistedCountryDecisionRuleMock->expects(static::atLeastOnce())
            ->method('isSatisfiedBy')
            ->with($this->giftCardTransferMock, $this->quoteTransferMock)
            ->willReturn(true);

        static::assertTrue(
            $this->facade->isBlacklistedCountryDecisionRuleSatisfiedBy(
                $this->giftCardTransferMock,
                $this->quoteTransferMock,
            ),
        );
    }

    /**
     * @return void
     */
    public function testIsVoucherDiscountDecisionRuleSatisfiedBy(): void
    {
        $this->factoryMock->expects(static::atLeastOnce())
            ->method('createVoucherDiscountDecisionRule')
            ->willReturn($this->voucherDiscountDecisionRuleMock);

        $this->voucherDiscountDecisionRuleMock->expects(static::atLeastOnce())
            ->method('isSatisfiedBy')
            ->with($this->giftCardTransferMock, $this->quoteTransferMock)
            ->willReturn(true);

        static::assertTrue($this->facade->isVoucherDiscountDecisionRuleSatisfiedBy(
            $this->giftCardTransferMock,
            $this->quoteTransferMock,
        ));
    }

    /**
     * @return void
     */
    public function testIsBlacklistedCartCodeTypeDecisionRuleSatisfiedBy(): void
    {
        $this->factoryMock->expects(static::atLeastOnce())
            ->method('createBlacklistedCartCodeTypeDecisionRule')
            ->willReturn($this->blacklistedCartCodeTypeDecisionRuleMock);

        $this->blacklistedCartCodeTypeDecisionRuleMock->expects(static::atLeastOnce())
            ->method('isSatisfiedBy')
            ->with($this->giftCardTransferMock, $this->quoteTransferMock)
            ->willReturn(true);

        static::assertTrue($this->facade->isBlacklistedCartCodeTypeDecisionRuleSatisfiedBy(
            $this->giftCardTransferMock,
            $this->quoteTransferMock,
        ));
    }

    /**
     * @return void
     */
    public function testRecalculate(): void
    {
        $this->factoryMock->expects(static::atLeastOnce())
            ->method('createGiftCardRestrictionCalculator')
            ->willReturn($this->giftCardRestrictionCalculatorMock);

        $this->giftCardRestrictionCalculatorMock->expects(static::atLeastOnce())
            ->method('recalculate')
            ->with($this->calculableObjectTransferMock);

        $this->facade->recalculate($this->calculableObjectTransferMock);
    }
}
