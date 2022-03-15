<?php

namespace FondOfOryx\Zed\PaymentAddressRestriction\Business\PaymentMethodFilter;

use ArrayObject;
use Codeception\Test\Unit;
use FondOfOryx\Zed\PaymentAddressRestriction\PaymentAddressRestrictionConfig;
use Generated\Shared\Transfer\AddressTransfer;
use Generated\Shared\Transfer\PaymentMethodsTransfer;
use Generated\Shared\Transfer\PaymentMethodTransfer;
use Generated\Shared\Transfer\QuoteTransfer;

class CountryRestrictionRestrictionPaymentMethodFilterTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\PaymentMethodsTransfer
     */
    protected $paymentMethodsTransferMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\PaymentMethodTransfer
     */
    protected $paymentMethodTransferMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\QuoteTransfer
     */
    protected $quoteTransferMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\AddressTransfer
     */
    protected $billingAddressMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfOryx\Zed\PaymentAddressRestriction\PaymentAddressRestrictionConfig
     */
    protected $configMock;

    /**
     * @var \FondOfOryx\Zed\PaymentAddressRestriction\Business\PaymentMethodFilter\CountryRestrictionRestrictionPaymentMethodFilter
     */
    protected $paymentMethodFilter;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->paymentMethodsTransferMock = $this->getMockBuilder(PaymentMethodsTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->paymentMethodTransferMock = $this->getMockBuilder(PaymentMethodTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->quoteTransferMock = $this->getMockBuilder(QuoteTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->billingAddressMock = $this->getMockBuilder(AddressTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->configMock = $this->getMockBuilder(PaymentAddressRestrictionConfig::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->paymentMethodFilter = new CountryRestrictionRestrictionPaymentMethodFilter($this->configMock);
    }

    /**
     * @return void
     */
    public function testFilterPaymentMethods(): void
    {
        $this->configMock->expects(static::atLeastOnce())
            ->method('getBlackListedPaymentCountryCombinations')
            ->willReturn(
                ['payment-method-to-remove' => ['de', 'at', 'ch']],
            );

        $this->paymentMethodsTransferMock->expects(static::atLeastOnce())
            ->method('getMethods')
            ->willReturn([$this->paymentMethodTransferMock]);

        $this->paymentMethodTransferMock->expects(static::atLeastOnce())
            ->method('getMethodName')
            ->willReturn('payment-method-to-remove');

        $this->quoteTransferMock->expects(static::atLeastOnce())
            ->method('getBillingAddress')
            ->willReturn($this->billingAddressMock);

        $this->billingAddressMock->expects(static::atLeastOnce())
            ->method('getIso2Code')
            ->willReturn('es');

        $this->paymentMethodsTransferMock->setMethods(new ArrayObject());
        $this->paymentMethodsTransferMock->expects(static::atLeastOnce())
            ->method('setMethods')
            ->with(new ArrayObject())
            ->willReturnSelf();

        $paymentMethodsTransfer = $this->paymentMethodFilter->filterPaymentMethods(
            $this->paymentMethodsTransferMock,
            $this->quoteTransferMock,
        );

        static::assertCount(1, $paymentMethodsTransfer->getMethods());
    }
}
