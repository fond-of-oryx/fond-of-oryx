<?php

namespace FondOfOryx\Zed\AvailabilityCheckoutValidator\Business\Validator;

use ArrayObject;
use Codeception\Test\Unit;
use FondOfOryx\Zed\AvailabilityCheckoutValidator\Dependency\Facade\AvailabilityCheckoutValidatorToAvailabilityCartDataExtenderFacadeInterface;
use Generated\Shared\Transfer\ItemTransfer;
use Generated\Shared\Transfer\QuoteTransfer;

class QuoteAvailabilityValidatorTest extends Unit
{
    /**
     * @var \Generated\Shared\Transfer\ItemTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $itemTransfer;

    /**
     * @var \Generated\Shared\Transfer\QuoteTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $quoteTransferMock;

    /**
     * @var \FondOfOryx\Zed\AvailabilityCheckoutValidator\Dependency\Facade\AvailabilityCheckoutValidatorToAvailabilityCartDataExtenderFacadeInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $facadeMock;

    /**
     * @var \FondOfOryx\Zed\AvailabilityCheckoutValidator\Business\Validator\QuoteAvailabilityValidator
     */
    protected $toTest;

    /**
     * @return void
     */
    public function _before()
    {
        parent::_before();

        $this->itemTransfer = $this->getMockBuilder(ItemTransfer::class)->disableOriginalConstructor()->getMock();
        $this->quoteTransferMock = $this->getMockBuilder(QuoteTransfer::class)->disableOriginalConstructor()->getMock();
        $this->facadeMock = $this->getMockBuilder(AvailabilityCheckoutValidatorToAvailabilityCartDataExtenderFacadeInterface::class)->disableOriginalConstructor()->getMock();

        $this->toTest = new QuoteAvailabilityValidator($this->facadeMock);
    }

    /**
     * @return void
     */
    public function testValidateWithoutItems(): void
    {
        $items = new ArrayObject();
        $this->facadeMock->expects(static::once())->method('addAvailabilityInformationOnQuoteItems')->willReturn($this->quoteTransferMock);
        $this->quoteTransferMock->expects(static::once())->method('getItems')->willReturn($items);
        $this->itemTransfer->expects(static::never())->method('getAvailability');

        static::assertTrue($this->toTest->validate($this->quoteTransferMock)->getIsSuccessful());
    }

    /**
     * @return void
     */
    public function testValidateWillAddErrorSinceNotAvailable(): void
    {
        $items = new ArrayObject([$this->itemTransfer]);
        $this->facadeMock->expects(static::once())->method('addAvailabilityInformationOnQuoteItems')->willReturn($this->quoteTransferMock);
        $this->quoteTransferMock->expects(static::once())->method('getItems')->willReturn($items);
        $this->itemTransfer->expects(static::exactly(3))->method('getAvailability')->willReturn(0);
        $this->itemTransfer->expects(static::once())->method('getSku')->willReturn('sku');
        $this->itemTransfer->expects(static::once())->method('getName')->willReturn('name');

        $check = $this->toTest->validate($this->quoteTransferMock);
        static::assertFalse($check->getIsSuccessful());

        $params = [
            QuoteAvailabilityValidator::STOCK_TRANSLATION_PARAMETER => 0,
            QuoteAvailabilityValidator::SKU_TRANSLATION_PARAMETER => 'sku',
            QuoteAvailabilityValidator::NAME_TRANSLATION_PARAMETER => 'name',
        ];

        static::assertSame($params, $check->getErrors()[0]->getParameters());
        static::assertSame(QuoteAvailabilityValidator::CHECKOUT_VALIDATION_AVAILABILITY_EMPTY, $check->getErrors()[0]->getMessage());
    }

    /**
     * @return void
     */
    public function testValidateWillAddErrorSinceNotBuyable(): void
    {
        $items = new ArrayObject([$this->itemTransfer]);
        $this->facadeMock->expects(static::once())->method('addAvailabilityInformationOnQuoteItems')->willReturn($this->quoteTransferMock);
        $this->quoteTransferMock->expects(static::once())->method('getItems')->willReturn($items);
        $this->itemTransfer->expects(static::exactly(3))->method('getAvailability')->willReturn(2);
        $this->itemTransfer->expects(static::once())->method('getSku')->willReturn('sku');
        $this->itemTransfer->expects(static::once())->method('getName')->willReturn('name');
        $this->itemTransfer->expects(static::once())->method('getIsBuyable')->willReturn(false);

        $check = $this->toTest->validate($this->quoteTransferMock);
        static::assertFalse($check->getIsSuccessful());

        $params = [
            QuoteAvailabilityValidator::STOCK_TRANSLATION_PARAMETER => 2,
            QuoteAvailabilityValidator::SKU_TRANSLATION_PARAMETER => 'sku',
            QuoteAvailabilityValidator::NAME_TRANSLATION_PARAMETER => 'name',
        ];

        static::assertSame($params, $check->getErrors()[0]->getParameters());
        static::assertSame(QuoteAvailabilityValidator::CHECKOUT_VALIDATION_AVAILABILITY_FAILED, $check->getErrors()[0]->getMessage());
    }
}
