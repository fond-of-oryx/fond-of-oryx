<?php

namespace FondOfOryx\Zed\ProductPaymentRestriction\Business;

use Codeception\Test\Unit;
use FondOfOryx\Zed\ProductPaymentRestriction\Business\PaymentMethodFilter\ProductPaymentRestrictionPaymentMethodFilter;
use Generated\Shared\Transfer\PaymentMethodsTransfer;
use Generated\Shared\Transfer\QuoteTransfer;

class ProductPaymentRestrictionFacadeTest extends Unit
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
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfOryx\Zed\ProductPaymentRestriction\Business\ProductPaymentRestrictionBusinessFactory
     */
    protected $businessFactoryMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfOryx\Zed\ProductPaymentRestriction\Business\PaymentMethodFilter\ProductPaymentRestrictionPaymentMethodFilter
     */
    protected $ProductPaymentRestrictionPaymentMethodFilterMock;

    /**
     * @var \FondOfOryx\Zed\ProductPaymentRestriction\Business\ProductPaymentRestrictionFacade
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

        $this->businessFactoryMock = $this->getMockBuilder(ProductPaymentRestrictionBusinessFactory::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->ProductPaymentRestrictionPaymentMethodFilterMock = $this
            ->getMockBuilder(ProductPaymentRestrictionPaymentMethodFilter::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->facade = new ProductPaymentRestrictionFacade();
        $this->facade->setFactory($this->businessFactoryMock);
    }

    /**
     * @return void
     */
    public function testProductRestrictionPaymentMethodFilter(): void
    {
        $this->businessFactoryMock->expects(static::atLeastOnce())
            ->method('createProductPaymentRestrictionPaymentMethodFilter')
            ->willReturn($this->ProductPaymentRestrictionPaymentMethodFilterMock);

        $this->ProductPaymentRestrictionPaymentMethodFilterMock->expects(static::atLeastOnce())
            ->method('filterPaymentMethods')
            ->with($this->paymentMethodsTransferMock, $this->quoteTransferMock)
            ->willReturn($this->paymentMethodsTransferMock);

        $paymentMethodsTransfer = $this->facade->ProductPaymentRestrictionPaymentMethodFilter(
            $this->paymentMethodsTransferMock,
            $this->quoteTransferMock,
        );

        static::assertEquals($paymentMethodsTransfer, $this->paymentMethodsTransferMock);
    }
}
