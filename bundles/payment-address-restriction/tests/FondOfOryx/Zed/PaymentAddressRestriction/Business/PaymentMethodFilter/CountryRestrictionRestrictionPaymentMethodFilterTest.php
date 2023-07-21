<?php

namespace FondOfOryx\Zed\PaymentAddressRestriction\Business\PaymentMethodFilter;

use ArrayObject;
use Codeception\Test\Unit;
use FondOfOryx\Zed\PaymentAddressRestriction\PaymentAddressRestrictionConfig;
use Generated\Shared\Transfer\AddressTransfer;
use Generated\Shared\Transfer\PaymentMethodsTransfer;
use Generated\Shared\Transfer\PaymentMethodTransfer;
use Generated\Shared\Transfer\QuoteTransfer;
use PHPUnit\Framework\MockObject\MockObject;

class CountryRestrictionRestrictionPaymentMethodFilterTest extends Unit
{
    /**
     * @var \Generated\Shared\Transfer\PaymentMethodsTransfer
     */
    protected PaymentMethodsTransfer $paymentMethodsTransfer;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\PaymentMethodTransfer
     */
    protected MockObject|PaymentMethodTransfer $paymyentMethodTransferMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\QuoteTransfer
     */
    protected MockObject|QuoteTransfer $quoteTransferMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\AddressTransfer
     */
    protected MockObject|AddressTransfer $billingAddressMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfOryx\Zed\PaymentAddressRestriction\PaymentAddressRestrictionConfig
     */
    protected PaymentAddressRestrictionConfig|MockObject $configMock;

    /**
     * @var \FondOfOryx\Zed\PaymentAddressRestriction\Business\PaymentMethodFilter\CountryRestrictionRestrictionPaymentMethodFilter
     */
    protected CountryRestrictionRestrictionPaymentMethodFilter $paymentMethodFilter;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->quoteTransferMock = $this->getMockBuilder(QuoteTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->billingAddressMock = $this->getMockBuilder(AddressTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->configMock = $this->getMockBuilder(PaymentAddressRestrictionConfig::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->paymentMethodsTransfer = new PaymentMethodsTransfer();

        $this->paymentMethodsTransfer->setMethods(new ArrayObject([
            (new PaymentMethodTransfer())->setMethodName('payment-method-to-remove'),
            (new PaymentMethodTransfer())->setMethodName('payment-method'),
        ]));

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

        $this->quoteTransferMock->expects(static::atLeastOnce())
            ->method('getBillingAddress')
            ->willReturn($this->billingAddressMock);

        $this->billingAddressMock->expects(static::atLeastOnce())
            ->method('getIso2Code')
            ->willReturn('es');

        $paymentMethodsTransfer = $this->paymentMethodFilter->filterPaymentMethods(
            $this->paymentMethodsTransfer,
            $this->quoteTransferMock,
        );

        static::assertCount(1, $paymentMethodsTransfer->getMethods());
    }

    /**
     * @return void
     */
    public function testFilterPaymentMethodsNoBillingAddress(): void
    {
        $this->quoteTransferMock->expects(static::atLeastOnce())
            ->method('getBillingAddress')
            ->willReturn(null);

        $this->configMock->expects(static::never())
            ->method('getBlackListedPaymentCountryCombinations');

        $paymentMethodsTransfer = $this->paymentMethodFilter->filterPaymentMethods(
            $this->paymentMethodsTransfer,
            $this->quoteTransferMock,
        );

        static::assertCount(2, $paymentMethodsTransfer->getMethods());
    }
}
