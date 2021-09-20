<?php

namespace FondOfOryx\Zed\CompanyBusinessUnitOrderBudget\Business\Expander;

use Codeception\Test\Unit;
use Exception;
use FondOfOryx\Zed\CompanyBusinessUnitOrderBudget\Business\Exception\NotEnoughOrderBudgetException;
use FondOfOryx\Zed\CompanyBusinessUnitOrderBudget\Business\Validator\QuoteValidatorInterface;
use Generated\Shared\Transfer\MessageTransfer;
use Generated\Shared\Transfer\QuoteTransfer;

class QuoteExpanderTest extends Unit
{
    /**
     * @var \Generated\Shared\Transfer\QuoteTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $quoteTransferMock;

    /**
     * @var \FondOfOryx\Zed\CompanyBusinessUnitOrderBudget\Business\Validator\QuoteValidatorInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $quoteValidatorMock;

    /**
     * @var \FondOfOryx\Zed\CompanyBusinessUnitOrderBudget\Business\Expander\QuoteExpander
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
            $this->quoteValidatorMock
        );
    }

    /**
     * @return void
     */
    public function testExpandWithNotEnoughOrderBudgetException(): void
    {
        $this->quoteValidatorMock->expects(static::atLeastOnce())
            ->method('validate')
            ->with($this->quoteTransferMock)
            ->willThrowException(new NotEnoughOrderBudgetException());

        $this->quoteTransferMock->expects(static::atLeastOnce())
            ->method('addValidationMessage')
            ->with(
                static::callback(
                    static function (MessageTransfer $messageTransfer) {
                        return $messageTransfer->getType() === QuoteExpander::MESSAGE_TYPE_ERROR
                            && $messageTransfer->getValue() === QuoteExpander::MESSAGE_NOT_ENOUGH_ORDER_BUDGET;
                    }
                )
            )->willReturn($this->quoteTransferMock);

        static::assertEquals(
            $this->quoteTransferMock,
            $this->quoteExpander->expand($this->quoteTransferMock)
        );
    }

    /**
     * @return void
     */
    public function testExpandWithAnyException(): void
    {
        $this->quoteValidatorMock->expects(static::atLeastOnce())
            ->method('validate')
            ->with($this->quoteTransferMock)
            ->willThrowException(new Exception());

        $this->quoteTransferMock->expects(static::atLeastOnce())
            ->method('addValidationMessage')
            ->with(
                static::callback(
                    static function (MessageTransfer $messageTransfer) {
                        return $messageTransfer->getType() === QuoteExpander::MESSAGE_TYPE_ERROR
                            && $messageTransfer->getValue() === QuoteExpander::MESSAGE_INVALID_QUOTE;
                    }
                )
            )->willReturn($this->quoteTransferMock);

        static::assertEquals(
            $this->quoteTransferMock,
            $this->quoteExpander->expand($this->quoteTransferMock)
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
            $this->quoteExpander->expand($this->quoteTransferMock)
        );
    }
}
