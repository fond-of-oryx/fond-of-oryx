<?php

namespace FondOfOryx\Zed\DeliveryDateRestriction\Communication\Plugin\CheckoutExtension;

use Codeception\Test\Unit;
use Exception;
use FondOfOryx\Zed\DeliveryDateRestriction\Business\DeliveryDateRestrictionFacade;
use Generated\Shared\Transfer\CheckoutErrorTransfer;
use Generated\Shared\Transfer\CheckoutResponseTransfer;
use Generated\Shared\Transfer\QuoteTransfer;

class DeliveryDateRestrictionCheckoutPreConditionPluginTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\DeliveryDateRestriction\Business\DeliveryDateRestrictionFacade|mixed|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $facadeMock;

    /**
     * @var \Generated\Shared\Transfer\QuoteTransfer|mixed|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $quoteTransferMock;

    /**
     * @var \Generated\Shared\Transfer\CheckoutResponseTransfer|mixed|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $checkoutResponseTransferMock;

    /**
     * @var \FondOfOryx\Zed\DeliveryDateRestriction\Communication\Plugin\CheckoutExtension\DeliveryDateRestrictionCheckoutPreConditionPlugin
     */
    protected $plugin;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->facadeMock = $this->getMockBuilder(DeliveryDateRestrictionFacade::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->quoteTransferMock = $this->getMockBuilder(QuoteTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->checkoutResponseTransferMock = $this->getMockBuilder(CheckoutResponseTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->plugin = new DeliveryDateRestrictionCheckoutPreConditionPlugin();
        $this->plugin->setFacade($this->facadeMock);
    }

    /**
     * @return void
     */
    public function testCheckCondition(): void
    {
        $this->facadeMock->expects(static::atLeastOnce())
            ->method('validateQuote')
            ->with($this->quoteTransferMock);

        $this->checkoutResponseTransferMock->expects(static::never())
            ->method('setIsSuccess');

        $this->checkoutResponseTransferMock->expects(static::never())
            ->method('addError');

        static::assertTrue(
            $this->plugin->checkCondition($this->quoteTransferMock, $this->checkoutResponseTransferMock)
        );
    }

    /**
     * @return void
     */
    public function testCheckConditionWithInvalidQuote(): void
    {
        $exceptionMessage = 'foo';

        $this->facadeMock->expects(static::atLeastOnce())
            ->method('validateQuote')
            ->with($this->quoteTransferMock)
            ->willThrowException(new Exception($exceptionMessage));

        $this->checkoutResponseTransferMock->expects(static::atLeastOnce())
            ->method('setIsSuccess')
            ->with(false)
            ->willReturn($this->checkoutResponseTransferMock);

        $this->checkoutResponseTransferMock->expects(static::atLeastOnce())
            ->method('addError')
            ->with(
                static::callback(
                    static function (CheckoutErrorTransfer $checkoutErrorTransfer) use ($exceptionMessage) {
                        return $checkoutErrorTransfer->getMessage() === $exceptionMessage;
                    }
                )
            )->willReturn($this->checkoutResponseTransferMock);

        static::assertFalse(
            $this->plugin->checkCondition($this->quoteTransferMock, $this->checkoutResponseTransferMock)
        );
    }
}
