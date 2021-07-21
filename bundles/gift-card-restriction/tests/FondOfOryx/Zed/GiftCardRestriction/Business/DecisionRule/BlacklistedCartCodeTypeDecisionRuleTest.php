<?php

namespace FondOfOryx\Zed\GiftCardRestriction\Business\DecisionRule;

use ArrayObject;
use Codeception\Test\Unit;
use FondOfOryx\Zed\GiftCardRestriction\Dependency\Facade\GiftCardRestrictionToProductCartCodeTypeRestrictionFacadeInterface;
use Generated\Shared\Transfer\GiftCardTransfer;
use Generated\Shared\Transfer\ItemTransfer;
use Generated\Shared\Transfer\QuoteTransfer;

class BlacklistedCartCodeTypeDecisionRuleTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\GiftCardRestriction\Dependency\Facade\GiftCardRestrictionToProductCartCodeTypeRestrictionFacadeInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $productCartCodeTypeRestrictionFacadeMock;

    /**
     * @var \Generated\Shared\Transfer\QuoteTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $quoteTransferMock;

    /**
     * @var \Generated\Shared\Transfer\GiftCardTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $giftCardTransferMock;

    /**
     * @var \Generated\Shared\Transfer\ItemTransfer[]|\PHPUnit\Framework\MockObject\MockObject[]
     */
    protected $itemTransferMocks;

    /**
     * @var \FondOfOryx\Zed\GiftCardRestriction\Business\DecisionRule\BlacklistedCartCodeTypeDecisionRule
     */
    protected $decisionRule;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->productCartCodeTypeRestrictionFacadeMock = $this->getMockBuilder(GiftCardRestrictionToProductCartCodeTypeRestrictionFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->quoteTransferMock = $this->getMockBuilder(QuoteTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->giftCardTransferMock = $this->getMockBuilder(GiftCardTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->itemTransferMocks = [
            $this->getMockBuilder(ItemTransfer::class)
                ->disableOriginalConstructor()
                ->getMock(),
            $this->getMockBuilder(ItemTransfer::class)
                ->disableOriginalConstructor()
                ->getMock(),
        ];

        $this->decisionRule = new BlacklistedCartCodeTypeDecisionRule(
            $this->productCartCodeTypeRestrictionFacadeMock
        );
    }

    /**
     * @return void
     */
    public function testIsSatisfiedBy(): void
    {
        $skus = ['FOO-123-456', 'FOO-234-567'];
        $blacklistedCartCodeTypesPerSku = [
            $skus[0] => ['gift card'],
            $skus[1] => ['gift card'],
        ];

        $this->quoteTransferMock->expects(static::atLeastOnce())
            ->method('getItems')
            ->willReturn(new ArrayObject($this->itemTransferMocks));

        $this->itemTransferMocks[0]->expects(static::atLeastOnce())
            ->method('getSku')
            ->willReturn($skus[0]);

        $this->itemTransferMocks[1]->expects(static::atLeastOnce())
            ->method('getSku')
            ->willReturn($skus[1]);

        $this->productCartCodeTypeRestrictionFacadeMock->expects(static::atLeastOnce())
            ->method('getBlacklistedCartCodeTypesByProductConcreteSkus')
            ->with($skus)
            ->willReturn($blacklistedCartCodeTypesPerSku);

        static::assertFalse($this->decisionRule->isSatisfiedBy($this->giftCardTransferMock, $this->quoteTransferMock));
    }

    /**
     * @return void
     */
    public function testIsSatisfiedByWithoutRestrictedItems(): void
    {
        $skus = ['FOO-123-456', 'FOO-234-567'];
        $blacklistedCartCodeTypesPerSku = [
            $skus[0] => [],
            $skus[1] => ['gift card'],
        ];

        $this->quoteTransferMock->expects(static::atLeastOnce())
            ->method('getItems')
            ->willReturn(new ArrayObject($this->itemTransferMocks));

        $this->itemTransferMocks[0]->expects(static::atLeastOnce())
            ->method('getSku')
            ->willReturn($skus[0]);

        $this->itemTransferMocks[1]->expects(static::atLeastOnce())
            ->method('getSku')
            ->willReturn($skus[1]);

        $this->productCartCodeTypeRestrictionFacadeMock->expects(static::atLeastOnce())
            ->method('getBlacklistedCartCodeTypesByProductConcreteSkus')
            ->with($skus)
            ->willReturn($blacklistedCartCodeTypesPerSku);

        static::assertTrue($this->decisionRule->isSatisfiedBy($this->giftCardTransferMock, $this->quoteTransferMock));
    }
}
