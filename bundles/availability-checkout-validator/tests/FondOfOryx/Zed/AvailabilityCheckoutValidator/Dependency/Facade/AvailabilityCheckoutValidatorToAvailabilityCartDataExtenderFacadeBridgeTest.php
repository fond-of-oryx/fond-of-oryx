<?php

namespace FondOfOryx\Zed\AvailabilityCheckoutValidator\Dependency\Facade;

use Codeception\Test\Unit;
use FondOfOryx\Zed\AvailabilityCartDataExtender\Business\AvailabilityCartDataExtenderFacadeInterface;
use Generated\Shared\Transfer\QuoteTransfer;

class AvailabilityCheckoutValidatorToAvailabilityCartDataExtenderFacadeBridgeTest extends Unit
{
    /**
     * @var \Generated\Shared\Transfer\QuoteTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $quoteTransferMock;

    /**
     * @var \FondOfOryx\Zed\AvailabilityCartDataExtender\Business\AvailabilityCartDataExtenderFacadeInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $facadeMock;

    /**
     * @var \FondOfOryx\Zed\AvailabilityCheckoutValidator\Dependency\Facade\AvailabilityCheckoutValidatorToAvailabilityCartDataExtenderFacadeBridge
     */
    protected $toTest;

    /**
     * @return void
     */
    public function _before()
    {
        parent::_before();

        $this->quoteTransferMock = $this->getMockBuilder(QuoteTransfer::class)->disableOriginalConstructor()->getMock();
        $this->facadeMock = $this->getMockBuilder(AvailabilityCartDataExtenderFacadeInterface::class)->disableOriginalConstructor()->getMock();

        $this->toTest = new AvailabilityCheckoutValidatorToAvailabilityCartDataExtenderFacadeBridge($this->facadeMock);
    }

    /**
     * @return void
     */
    public function testAddAvailabilityInformationOnQuoteItems(): void
    {
        $this->facadeMock->expects(static::once())->method('addAvailabilityInformationOnQuoteItems')->willReturn($this->quoteTransferMock);

        $this->toTest->addAvailabilityInformationOnQuoteItems($this->quoteTransferMock);
    }
}
