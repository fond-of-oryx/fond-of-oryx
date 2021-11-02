<?php

namespace FondOfOryx\Zed\SplittableQuote\Dependency\Facade;

use Codeception\Test\Unit;
use Generated\Shared\Transfer\QuoteTransfer;
use Spryker\Zed\Calculation\Business\CalculationFacadeInterface;

class SplittableQuoteToCalculationFacadeBridgeTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Zed\Calculation\Business\CalculationFacadeInterface
     */
    protected $calculationFacadeMock;

    /**
     * @var \Generated\Shared\Transfer\QuoteTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $quoteTransferMock;

    /**
     * @var \FondOfOryx\Zed\SplittableQuote\Dependency\Facade\SplittableQuoteToCalculationFacadeBridge
     */
    protected $facadeBridge;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->calculationFacadeMock = $this->getMockBuilder(CalculationFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->quoteTransferMock = $this->getMockBuilder(QuoteTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->facadeBridge = new SplittableQuoteToCalculationFacadeBridge($this->calculationFacadeMock);
    }

    /**
     * @return void
     */
    public function testRecalculateQuote(): void
    {
        $this->calculationFacadeMock->expects(static::atLeastOnce())
            ->method('recalculateQuote')
            ->with($this->quoteTransferMock, false)
            ->willReturn($this->quoteTransferMock);

        static::assertEquals(
            $this->quoteTransferMock,
            $this->facadeBridge->recalculateQuote($this->quoteTransferMock, false),
        );
    }
}
