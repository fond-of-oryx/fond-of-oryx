<?php

namespace FondOfOryx\Zed\PaymentProductRestriction\Business\PaymentMethodFilter;

use Codeception\Test\Unit;
use FondOfOryx\Shared\PaymentProductRestriction\PaymentProductRestrictionConstants;
use FondOfOryx\Zed\PaymentProductRestriction\PaymentProductRestrictionConfig;
use Generated\Shared\Transfer\ItemTransfer;
use Generated\Shared\Transfer\PaymentMethodsTransfer;
use Generated\Shared\Transfer\PaymentMethodTransfer;
use Generated\Shared\Transfer\QuoteTransfer;

class PaymentProductRestrictionPaymentMethodFilterTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\PaymentMethodsTransfer
     */
    protected $paymentMethodsTransferMock;

    /**
     * @var array<\PHPUnit\Framework\MockObject\MockObject>|array<\Generated\Shared\Transfer\PaymentMethodTransfer>
     */
    protected $paymentMethodTransferMocks;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\QuoteTransfer
     */
    protected $quoteTransferMock;

    /**
     * @var array<\PHPUnit\Framework\MockObject\MockObject>|array<\Generated\Shared\Transfer\ItemTransfer>
     */
    protected $itemTransferMocks;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfOryx\Zed\PaymentProductRestriction\PaymentProductRestrictionConfig
     */
    protected $configMock;

    /**
     * @var \FondOfOryx\Zed\PaymentProductRestriction\Business\PaymentMethodFilter\PaymentProductRestrictionPaymentMethodFilter
     */
    protected $paymentProductRestrictionPaymentMethodFilter;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->paymentMethodsTransferMock = $this->getMockBuilder(PaymentMethodsTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->paymentMethodTransferMocks = [
            $this->getMockBuilder(PaymentMethodTransfer::class)
                ->disableOriginalConstructor()
                ->getMock(),
            $this->getMockBuilder(PaymentMethodTransfer::class)
                ->disableOriginalConstructor()
                ->getMock(),
            $this->getMockBuilder(PaymentMethodTransfer::class)
                ->disableOriginalConstructor()
                ->getMock(),
        ];

        $this->quoteTransferMock = $this->getMockBuilder(QuoteTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->itemTransferMocks = [
            $this->getMockBuilder(ItemTransfer::class)
                ->disableOriginalConstructor()
                ->getMock(),
            $this->getMockBuilder(ItemTransfer::class)
                ->disableOriginalConstructor()
                ->getMock(),
            $this->getMockBuilder(ItemTransfer::class)
                ->disableOriginalConstructor()
                ->getMock(),
        ];

        $this->configMock = $this->getMockBuilder(PaymentProductRestrictionConfig::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->paymentProductRestrictionPaymentMethodFilter = new PaymentProductRestrictionPaymentMethodFilter($this->configMock);
    }

    /**
     * @return void
     */
    public function testFilterPaymentMethodsRemoveOnePaymentMethodToRemove(): void
    {
        $this->configMock->expects(static::atLeastOnce())
            ->method('getProductAttributeBlacklistedPaymentMethods')
            ->willReturn('blacklisted_payment_methods');

        $this->quoteTransferMock->expects(static::atLeastOnce())
            ->method('getItems')
            ->willReturn($this->itemTransferMocks);

        $this->itemTransferMocks[0]->expects(static::atLeastOnce())
            ->method('getAbstractAttributes')
            ->willReturn([
        PaymentProductRestrictionConstants::UNLOCALIZED_PRODUCT_ATTRIBUTES => [
                'blacklisted_payment_methods' => [
                    'payment_provider_invoice',
                ],
            ]]);

        $this->itemTransferMocks[1]->expects(static::atLeastOnce())
            ->method('getAbstractAttributes')
            ->willReturn([
                PaymentProductRestrictionConstants::UNLOCALIZED_PRODUCT_ATTRIBUTES => [
                    'blacklisted_payment_methods' => [],
                ]]);

        $this->itemTransferMocks[2]->expects(static::atLeastOnce())
            ->method('getAbstractAttributes')
            ->willReturn([
                PaymentProductRestrictionConstants::UNLOCALIZED_PRODUCT_ATTRIBUTES => [
                    'blacklisted_payment_methods' => [],
                ]]);

        $this->paymentMethodTransferMocks[0]->expects(static::atLeastOnce())
            ->method('getMethodName')
            ->willReturn('payment_provider_invoice');

        $this->paymentMethodTransferMocks[1]->expects(static::atLeastOnce())
            ->method('getMethodName')
            ->willReturn('payment_provider_paypal');

        $this->paymentMethodTransferMocks[2]->expects(static::atLeastOnce())
            ->method('getMethodName')
            ->willReturn('payment_provider_credit-card');

        $this->paymentMethodsTransferMock->expects(static::atLeastOnce())
            ->method('getMethods')
            ->willReturn($this->paymentMethodTransferMocks);

        $paymentMethodsTransfer = $this->paymentProductRestrictionPaymentMethodFilter->filterPaymentMethods(
            $this->paymentMethodsTransferMock,
            $this->quoteTransferMock,
        );

        $allowedPaymentMethods = [];

        foreach ($paymentMethodsTransfer->getMethods() as $paymentMethodTransfer) {
            $allowedPaymentMethods[] = $paymentMethodTransfer->getMethodName();
        }

        static::assertContains('payment_provider_paypal', $allowedPaymentMethods);
        static::assertContains('payment_provider_credit-card', $allowedPaymentMethods);
        static::assertNotContains('payment_provider_invoice', $allowedPaymentMethods);
        static::assertCount(2, $paymentMethodsTransfer->getMethods());
    }

    /**
     * @return void
     */
    public function testFilterPaymentMethodsRemoveTwoPaymentMethodToRemove(): void
    {
        $this->configMock->expects(static::atLeastOnce())
            ->method('getProductAttributeBlacklistedPaymentMethods')
            ->willReturn('blacklisted_payment_methods');

        $this->quoteTransferMock->expects(static::atLeastOnce())
            ->method('getItems')
            ->willReturn($this->itemTransferMocks);

        $this->itemTransferMocks[0]->expects(static::atLeastOnce())
            ->method('getAbstractAttributes')
            ->willReturn([
                PaymentProductRestrictionConstants::UNLOCALIZED_PRODUCT_ATTRIBUTES => [
                    'blacklisted_payment_methods' => [
                        'payment_provider_invoice',
                    ],
                ]]);

        $this->itemTransferMocks[1]->expects(static::atLeastOnce())
            ->method('getAbstractAttributes')
            ->willReturn([
                PaymentProductRestrictionConstants::UNLOCALIZED_PRODUCT_ATTRIBUTES => [
                    'blacklisted_payment_methods' => [
                        'payment_provider_credit-card',
                    ],
                ]]);

        $this->itemTransferMocks[2]->expects(static::atLeastOnce())
            ->method('getAbstractAttributes')
            ->willReturn([
                PaymentProductRestrictionConstants::UNLOCALIZED_PRODUCT_ATTRIBUTES => [
                    'blacklisted_payment_methods' => [],
                ]]);

        $this->paymentMethodTransferMocks[0]->expects(static::atLeastOnce())
            ->method('getMethodName')
            ->willReturn('payment_provider_invoice');

        $this->paymentMethodTransferMocks[1]->expects(static::atLeastOnce())
            ->method('getMethodName')
            ->willReturn('payment_provider_paypal');

        $this->paymentMethodTransferMocks[2]->expects(static::atLeastOnce())
            ->method('getMethodName')
            ->willReturn('payment_provider_credit-card');

        $this->paymentMethodsTransferMock->expects(static::atLeastOnce())
            ->method('getMethods')
            ->willReturn($this->paymentMethodTransferMocks);

        $paymentMethodsTransfer = $this->paymentProductRestrictionPaymentMethodFilter->filterPaymentMethods(
            $this->paymentMethodsTransferMock,
            $this->quoteTransferMock,
        );

        $allowedPaymentMethods = [];

        foreach ($paymentMethodsTransfer->getMethods() as $paymentMethodTransfer) {
            $allowedPaymentMethods[] = $paymentMethodTransfer->getMethodName();
        }

        static::assertContains('payment_provider_paypal', $allowedPaymentMethods);
        static::assertNotContains('payment_provider_credit-card', $allowedPaymentMethods);
        static::assertNotContains('payment_provider_invoice', $allowedPaymentMethods);
        static::assertCount(1, $paymentMethodsTransfer->getMethods());
    }

    /**
     * @return void
     */
    public function testFilterPaymentMethodsRemoveNoPaymentMethodToRemove(): void
    {
        $this->configMock->expects(static::atLeastOnce())
            ->method('getProductAttributeBlacklistedPaymentMethods')
            ->willReturn('blacklisted_payment_methods');

        $this->quoteTransferMock->expects(static::atLeastOnce())
            ->method('getItems')
            ->willReturn($this->itemTransferMocks);

        $this->itemTransferMocks[0]->expects(static::atLeastOnce())
            ->method('getAbstractAttributes')
            ->willReturn([
                PaymentProductRestrictionConstants::UNLOCALIZED_PRODUCT_ATTRIBUTES => [
                    'blacklisted_payment_methods' => [],
                ]]);

        $this->itemTransferMocks[1]->expects(static::atLeastOnce())
            ->method('getAbstractAttributes')
            ->willReturn([
                PaymentProductRestrictionConstants::UNLOCALIZED_PRODUCT_ATTRIBUTES => [
                    'blacklisted_payment_methods' => [],
                ]]);

        $this->itemTransferMocks[2]->expects(static::atLeastOnce())
            ->method('getAbstractAttributes')
            ->willReturn([
                PaymentProductRestrictionConstants::UNLOCALIZED_PRODUCT_ATTRIBUTES => [
                    'blacklisted_payment_methods' => [],
                ]]);

        $this->paymentMethodTransferMocks[0]->expects(static::atLeastOnce())
            ->method('getMethodName')
            ->willReturn('payment_provider_invoice');

        $this->paymentMethodTransferMocks[1]->expects(static::atLeastOnce())
            ->method('getMethodName')
            ->willReturn('payment_provider_paypal');

        $this->paymentMethodTransferMocks[2]->expects(static::atLeastOnce())
            ->method('getMethodName')
            ->willReturn('payment_provider_credit-card');

        $this->paymentMethodsTransferMock->expects(static::atLeastOnce())
            ->method('getMethods')
            ->willReturn($this->paymentMethodTransferMocks);

        $paymentMethodsTransfer = $this->paymentProductRestrictionPaymentMethodFilter->filterPaymentMethods(
            $this->paymentMethodsTransferMock,
            $this->quoteTransferMock,
        );

        $allowedPaymentMethods = [];

        foreach ($paymentMethodsTransfer->getMethods() as $paymentMethodTransfer) {
            $allowedPaymentMethods[] = $paymentMethodTransfer->getMethodName();
        }

        static::assertContains('payment_provider_paypal', $allowedPaymentMethods);
        static::assertContains('payment_provider_credit-card', $allowedPaymentMethods);
        static::assertContains('payment_provider_invoice', $allowedPaymentMethods);
        static::assertCount(3, $paymentMethodsTransfer->getMethods());
    }
}
