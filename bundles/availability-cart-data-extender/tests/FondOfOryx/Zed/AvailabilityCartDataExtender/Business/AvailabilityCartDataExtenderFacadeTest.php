<?php

namespace FondOfOryx\Zed\AvailabilityCartDataExtender\Business;

use Codeception\Test\Unit;
use FondOfOryx\Zed\AvailabilityCartDataExtender\Business\Cart\CheckCartAvailability;
use Generated\Shared\Transfer\CartChangeTransfer;
use Generated\Shared\Transfer\CartPreCheckResponseTransfer;
use Generated\Shared\Transfer\QuoteTransfer;

class AvailabilityCartDataExtenderFacadeTest extends Unit
{
    /**
     * @var \Generated\Shared\Transfer\CartPreCheckResponseTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $cartPreCheckResponseTransferMock;

    /**
     * @var \Generated\Shared\Transfer\CartChangeTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $cartChangeTransferMock;

    /**
     * @var \Generated\Shared\Transfer\QuoteTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $quoteTransferMock;

    /**
     * @var \FondOfOryx\Zed\AvailabilityCartDataExtender\Business\AvailabilityCartDataExtenderBusinessFactory|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $factoryMock;

    /**
     * @var \FondOfOryx\Zed\AvailabilityCartDataExtender\Business\Cart\CheckCartAvailabilityInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $cartAvailabilityMock;

    /**
     * @var \FondOfOryx\Zed\AvailabilityCartDataExtender\Business\AvailabilityCartDataExtenderFacadeInterface
     */
    protected $toTest;

    /**
     * @return void
     */
    public function _before()
    {
        parent::_before();

        $this->cartPreCheckResponseTransferMock = $this->getMockBuilder(CartPreCheckResponseTransfer::class)->disableOriginalConstructor()->getMock();
        $this->cartChangeTransferMock = $this->getMockBuilder(CartChangeTransfer::class)->disableOriginalConstructor()->getMock();
        $this->quoteTransferMock = $this->getMockBuilder(QuoteTransfer::class)->disableOriginalConstructor()->getMock();
        $this->factoryMock = $this->getMockBuilder(AvailabilityCartDataExtenderBusinessFactory::class)->disableOriginalConstructor()->getMock();
        $this->cartAvailabilityMock = $this->getMockBuilder(CheckCartAvailability::class)->disableOriginalConstructor()->getMock();

        $this->toTest = new AvailabilityCartDataExtenderFacade();
        $this->toTest->setFactory($this->factoryMock);
    }

    /**
     * @return void
     */
    public function testAddAvailabilityInformationOnQuoteItems(): void
    {
        $this->factoryMock->expects(static::once())->method('createCartCheckAvailability')->willReturn($this->cartAvailabilityMock);
        $this->cartAvailabilityMock->expects(static::once())->method('addAvailabilityInformationOnQuoteItems')->willReturn($this->quoteTransferMock);

        $this->toTest->addAvailabilityInformationOnQuoteItems($this->quoteTransferMock);
    }

    /**
     * @return void
     */
    public function testCheckCartAvailability(): void
    {
        $this->factoryMock->expects(static::once())->method('createCartCheckAvailability')->willReturn($this->cartAvailabilityMock);
        $this->cartAvailabilityMock->expects(static::once())->method('checkCartAvailability')->willReturn($this->cartPreCheckResponseTransferMock);

        $this->toTest->checkCartAvailability($this->cartChangeTransferMock);
    }
}
