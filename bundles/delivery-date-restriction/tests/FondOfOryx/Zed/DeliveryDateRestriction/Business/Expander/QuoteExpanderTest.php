<?php

namespace FondOfOryx\Zed\DeliveryDateRestriction\Business\Expander;

use Codeception\Test\Unit;
use Exception;
use FondOfOryx\Zed\DeliveryDateRestriction\Business\Exception\CustomDeliveryDatesNotAllowedException;
use FondOfOryx\Zed\DeliveryDateRestriction\Business\Validator\QuoteValidatorInterface;
use Generated\Shared\Transfer\MessageTransfer;
use Generated\Shared\Transfer\QuoteTransfer;

class QuoteExpanderTest extends Unit
{
    /**
     * @var \Generated\Shared\Transfer\QuoteTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $quoteTransferMock;

    /**
     * @var \FondOfOryx\Zed\DeliveryDateRestriction\Business\Validator\QuoteValidatorInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $quoteValidatorMock;

    /**
     * @var \FondOfOryx\Zed\DeliveryDateRestriction\Business\Expander\QuoteExpander
     */
    protected $quoteExpander;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->quoteValidatorMock = $this->getMockBuilder(QuoteValidatorInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->quoteTransferMock = $this->getMockBuilder(QuoteTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->quoteExpander = new QuoteExpander(
            $this->quoteValidatorMock,
        );
    }

    /**
     * @return void
     */
    public function testExpandWithValidationError(): void
    {
        $exceptionMessage = 'foo';

        $this->quoteValidatorMock->expects(static::atLeastOnce())
            ->method('validate')
            ->with($this->quoteTransferMock)
            ->willThrowException(new CustomDeliveryDatesNotAllowedException($exceptionMessage));

        $this->quoteTransferMock->expects(static::atLeastOnce())
            ->method('addValidationMessage')
            ->with(
                static::callback(
                    static function (MessageTransfer $messageTransfer) {
                        return $messageTransfer->getType() === QuoteExpander::MESSAGE_TYPE_ERROR
                            && $messageTransfer->getValue() === QuoteExpander::MESSAGE_CUSTOM_DELIVERY_DATES_NOT_ALLOWED;
                    },
                ),
            )->willReturn($this->quoteTransferMock);

        static::assertEquals(
            $this->quoteTransferMock,
            $this->quoteExpander->expand($this->quoteTransferMock),
        );
    }

    /**
     * @return void
     */
    public function testExpandWithGeneralValidationError(): void
    {
        $exceptionMessage = 'foo';

        $this->quoteValidatorMock->expects(static::atLeastOnce())
            ->method('validate')
            ->with($this->quoteTransferMock)
            ->willThrowException(new Exception($exceptionMessage));

        $this->quoteTransferMock->expects(static::atLeastOnce())
            ->method('addValidationMessage')
            ->with(
                static::callback(
                    static function (MessageTransfer $messageTransfer) {
                        return $messageTransfer->getType() === QuoteExpander::MESSAGE_TYPE_ERROR
                            && $messageTransfer->getValue() === QuoteExpander::MESSAGE_INVALID_QUOTE;
                    },
                ),
            )->willReturn($this->quoteTransferMock);

        static::assertEquals(
            $this->quoteTransferMock,
            $this->quoteExpander->expand($this->quoteTransferMock),
        );
    }

    /**
     * @return void
     */
    public function testExpand(): void
    {
        $this->quoteValidatorMock->expects(static::atLeastOnce())
            ->method('validate')
            ->with($this->quoteTransferMock);

        $this->quoteTransferMock->expects(static::never())
            ->method('addValidationMessage');

        static::assertEquals(
            $this->quoteTransferMock,
            $this->quoteExpander->expand($this->quoteTransferMock),
        );
    }
}
