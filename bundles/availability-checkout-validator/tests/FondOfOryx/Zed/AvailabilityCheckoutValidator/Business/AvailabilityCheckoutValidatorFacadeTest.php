<?php

namespace FondOfOryx\Zed\AvailabilityCheckoutValidator\Business;

use Codeception\Test\Unit;
use FondOfOryx\Zed\AvailabilityCheckoutValidator\Business\Validator\QuoteAvailabilityValidator;
use Generated\Shared\Transfer\QuoteTransfer;
use Generated\Shared\Transfer\QuoteValidationResponseTransfer;

class AvailabilityCheckoutValidatorFacadeTest extends Unit
{
    /**
     * @var \Generated\Shared\Transfer\QuoteValidationResponseTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $quoteValidationResponseTransferMock;

    /**
     * @var \Generated\Shared\Transfer\QuoteTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $quoteTransferMock;

    /**
     * @var \FondOfOryx\Zed\AvailabilityCartDataExtender\Business\AvailabilityCartDataExtenderBusinessFactory|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $factoryMock;

    /**
     * @var \FondOfOryx\Zed\AvailabilityCheckoutValidator\Business\Validator\ValidatorInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $quoteAvailabilityValidatorMock;

    /**
     * @var \FondOfOryx\Zed\AvailabilityCheckoutValidator\Business\AvailabilityCheckoutValidatorFacadeInterface
     */
    protected $toTest;

    /**
     * @return void
     */
    public function _before()
    {
        parent::_before();

        $this->quoteValidationResponseTransferMock = $this->getMockBuilder(QuoteValidationResponseTransfer::class)->disableOriginalConstructor()->getMock();
        $this->quoteTransferMock = $this->getMockBuilder(QuoteTransfer::class)->disableOriginalConstructor()->getMock();
        $this->factoryMock = $this->getMockBuilder(AvailabilityCheckoutValidatorBusinessFactory::class)->disableOriginalConstructor()->getMock();
        $this->quoteAvailabilityValidatorMock = $this->getMockBuilder(QuoteAvailabilityValidator::class)->disableOriginalConstructor()->getMock();

        $this->toTest = new AvailabilityCheckoutValidatorFacade();
        $this->toTest->setFactory($this->factoryMock);
    }

    /**
     * @return void
     */
    public function testValidateQuote(): void
    {
        $this->factoryMock->expects(static::once())->method('createQuoteAvailabilityValidator')->willReturn($this->quoteAvailabilityValidatorMock);
        $this->quoteAvailabilityValidatorMock->expects(static::once())->method('validate')->willReturn($this->quoteValidationResponseTransferMock);

        $this->toTest->validateQuote($this->quoteTransferMock);
    }
}
