<?php

namespace FondOfOryx\Zed\GiftCardRestriction\Communication\Plugin\GiftCard;

use Codeception\Test\Unit;
use FondOfOryx\Zed\GiftCardRestriction\Business\GiftCardRestrictionFacade;
use Generated\Shared\Transfer\GiftCardTransfer;
use Generated\Shared\Transfer\QuoteTransfer;
use Spryker\Zed\Kernel\Business\AbstractFacade;

class BlacklistedCartCodeTypeDecisionRulePluginTest extends Unit
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
     * @var \FondOfOryx\Zed\GiftCardRestriction\Business\GiftCardRestrictionFacade|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $facadeMock;

    /**
     * @var \FondOfOryx\Zed\GiftCardRestriction\Communication\Plugin\GiftCard\BlacklistedCartCodeTypeDecisionRulePlugin
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

        $this->facadeMock = $this->getMockBuilder(GiftCardRestrictionFacade::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->plugin = new class ($this->facadeMock) extends BlacklistedCartCodeTypeDecisionRulePlugin {
            /**
             * @var \Spryker\Zed\Kernel\Business\AbstractFacade
             */
            protected $giftCardRestrictionFacade;

            /**
             * @param \Spryker\Zed\Kernel\Business\AbstractFacade $giftCardRestrictionFacade
             */
            public function __construct(AbstractFacade $giftCardRestrictionFacade)
            {
                $this->giftCardRestrictionFacade = $giftCardRestrictionFacade;
            }

            /**
             * @return \Spryker\Zed\Kernel\Business\AbstractFacade
             */
            public function getFacade(): AbstractFacade
            {
                return $this->giftCardRestrictionFacade;
            }
        };
    }

    /**
     * @return void
     */
    public function testIsApplicable(): void
    {
        $this->facadeMock->expects(static::atLeastOnce())
            ->method('isBlacklistedCartCodeTypeDecisionRuleSatisfiedBy')
            ->with($this->giftCardTransferMock, $this->quoteTransferMock)
            ->willReturn(true);

        static::assertTrue(
            $this->plugin->isApplicable($this->giftCardTransferMock, $this->quoteTransferMock)
        );
    }
}
