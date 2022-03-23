<?php

namespace FondOfOryx\Zed\PaymentTotalAmountRestriction\Business;

use Codeception\Test\Unit;
use FondOfOryx\Zed\PaymentTotalAmountRestriction\Business\PaymentMethodFilter\PaymentTotalAmountRestrictionPaymentMethodFilter;
use Generated\Shared\Transfer\PaymentMethodsTransfer;
use Generated\Shared\Transfer\QuoteTransfer;

class PaymentTotalAmountRestrictionFacadeTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\PaymentMethodsTransfer
     */
    protected $paymentMethodsTransferMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\QuoteTransfer
     */
    protected $quoteTransferMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfOryx\Zed\PaymentTotalAmountRestriction\Business\PaymentTotalAmountRestrictionBusinessFactory
     */
    protected $businessFactoryMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfOryx\Zed\PaymentTotalAmountRestriction\Business\PaymentMethodFilter\PaymentTotalAmountRestrictionPaymentMethodFilter
     */
    protected $paymentTotalAmountRestrictionPaymentMethodFilterMock;

    /**
     * @var \FondOfOryx\Zed\PaymentTotalAmountRestriction\Business\PaymentTotalAmountRestrictionFacade
     */
    protected $facade;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->paymentMethodsTransferMock = $this->getMockBuilder(PaymentMethodsTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->quoteTransferMock = $this->getMockBuilder(QuoteTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->businessFactoryMock = $this->getMockBuilder(PaymentTotalAmountRestrictionBusinessFactory::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->paymentTotalAmountRestrictionPaymentMethodFilterMock = $this
            ->getMockBuilder(PaymentTotalAmountRestrictionPaymentMethodFilter::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->facade = new PaymentTotalAmountRestrictionFacade();
        $this->facade->setFactory($this->businessFactoryMock);
    }

    /**
     * @return void
     */
    public function testTotalAmountRestrictionPaymentMethodFilter(): void
    {
        $this->businessFactoryMock->expects(static::atLeastOnce())
            ->method('createPaymentTotalAmountRestrictionPaymentMethodFilter')
            ->willReturn($this->paymentTotalAmountRestrictionPaymentMethodFilterMock);

        $this->paymentTotalAmountRestrictionPaymentMethodFilterMock->expects(static::atLeastOnce())
            ->method('filterPaymentMethods')
            ->with($this->paymentMethodsTransferMock, $this->quoteTransferMock)
            ->willReturn($this->paymentMethodsTransferMock);

        $paymentMethodsTransfer = $this->facade->totalAmountRestrictionPaymentMethodFilter(
            $this->paymentMethodsTransferMock,
            $this->quoteTransferMock,
        );

        static::assertEquals($paymentMethodsTransfer, $this->paymentMethodsTransferMock);
    }
}
