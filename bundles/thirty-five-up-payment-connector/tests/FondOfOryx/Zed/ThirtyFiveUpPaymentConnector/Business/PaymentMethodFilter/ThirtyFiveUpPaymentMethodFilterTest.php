<?php

namespace FondOfOryx\Zed\ThirtyFiveUpPaymentConnector\Business\PaymentMethodFilter;

use Codeception\Test\Unit;
use FondOfOryx\Shared\ThirtyFiveUpPaymentConnector\ThirtyFiveUpPaymentConnectorConstants;
use FondOfOryx\Zed\ThirtyFiveUpPaymentConnector\ThirtyFiveUpPaymentConnectorConfig;
use Generated\Shared\Transfer\ItemTransfer;
use Generated\Shared\Transfer\PaymentMethodsTransfer;
use Generated\Shared\Transfer\PaymentMethodTransfer;
use Generated\Shared\Transfer\PaymentTransfer;
use Generated\Shared\Transfer\QuoteTransfer;

class ThirtyFiveUpPaymentMethodFilterTest extends Unit
{
    /**
     * @var \Generated\Shared\Transfer\PaymentMethodsTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $paymentMethodsTransferMock;

    /**
     * @var \Generated\Shared\Transfer\QuoteTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $quoteTransferMock;

    /**
     * @var \Generated\Shared\Transfer\PaymentTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $paymentTransferMock;

    /**
     * @var \Generated\Shared\Transfer\PaymentMethodTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $paymentMethodTransferMock;

    /**
     * @var \Generated\Shared\Transfer\ItemTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $itemTransferMock;

    /**
     * @var \FondOfOryx\Zed\ThirtyFiveUpPaymentConnector\Business\PaymentMethodFilter\ThirtyFiveUpPaymentMethodFilter
     */
    protected $thirtyFiveUpPaymentMethodFilter;

    /**
     * @var \FondOfOryx\Zed\ThirtyFiveUpPaymentConnector\ThirtyFiveUpPaymentConnectorConfig|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $thirtyFiveUpPaymentConnectorConfigMock;

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

        $this->paymentTransferMock = $this->getMockBuilder(PaymentTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->itemTransferMock = $this->getMockBuilder(ItemTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->thirtyFiveUpPaymentConnectorConfigMock = $this->getMockBuilder(ThirtyFiveUpPaymentConnectorConfig::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->thirtyFiveUpPaymentMethodFilter = new ThirtyFiveUpPaymentMethodFilter($this->thirtyFiveUpPaymentConnectorConfigMock);
    }

    /**
     * @return void
     */
    public function testFilterPaymentMethodsNoUntranslatedAttributes(): void
    {
        $this->quoteTransferMock->expects(static::atLeastOnce())
            ->method('getItems')
            ->willReturn([$this->itemTransferMock]);

        $this->itemTransferMock->expects(static::atLeastOnce())
            ->method('getAbstractAttributes')
            ->willReturn([]);

        $paymentMethodsTransfer = $this->thirtyFiveUpPaymentMethodFilter->filterPaymentMethods($this->paymentMethodsTransferMock, $this->quoteTransferMock);

        static::assertEquals($this->paymentMethodsTransferMock, $paymentMethodsTransfer);
    }

    /**
     * @return void
     */
    public function testFilterPaymentMethodsNoCaseableSkuAttribute(): void
    {
        $this->quoteTransferMock->expects(static::atLeastOnce())
            ->method('getItems')
            ->willReturn([$this->itemTransferMock]);

        $this->itemTransferMock->expects(static::atLeastOnce())
            ->method('getAbstractAttributes')
            ->willReturn(['_' => []]);

        $paymentMethodsTransfer = $this->thirtyFiveUpPaymentMethodFilter->filterPaymentMethods($this->paymentMethodsTransferMock, $this->quoteTransferMock);

        static::assertEquals($this->paymentMethodsTransferMock, $paymentMethodsTransfer);
    }

    /**
     * @return void
     */
    public function testFilterPaymentMethodsCaseableSkuAttributeIsEmpty(): void
    {
        $this->quoteTransferMock->expects(static::atLeastOnce())
            ->method('getItems')
            ->willReturn([$this->itemTransferMock]);

        $this->itemTransferMock->expects(static::atLeastOnce())
            ->method('getAbstractAttributes')
            ->willReturn(['_' => [ThirtyFiveUpPaymentMethodFilter::UNTRANSLATED_ATTRIBUTES_KEY => '']]);

        $paymentMethodsTransfer = $this->thirtyFiveUpPaymentMethodFilter->filterPaymentMethods($this->paymentMethodsTransferMock, $this->quoteTransferMock);

        static::assertEquals($this->paymentMethodsTransferMock, $paymentMethodsTransfer);
    }

    /**
     * @return void
     */
    public function testFilterPaymentMethodsHasCaseableItemsNoProviderRemove(): void
    {
        $this->quoteTransferMock->expects(static::atLeastOnce())
            ->method('getItems')
            ->willReturn([$this->itemTransferMock]);

        $this->itemTransferMock->expects(static::atLeastOnce())
            ->method('getAbstractAttributes')
            ->willReturn(['_' => [ThirtyFiveUpPaymentConnectorConstants::ITEM_ATTRIBUTE_CASEABLE_SKU => 'some_SKU']]);

        $this->paymentMethodsTransferMock->expects(static::atLeastOnce())
            ->method('getMethods')
            ->willReturn([$this->paymentMethodTransferMock]);

        $this->paymentMethodTransferMock->expects(static::atLeastOnce())
            ->method('getMethodName')
            ->willReturn('SOME_PAYMENT_PROVIDER');

        $this->thirtyFiveUpPaymentConnectorConfigMock->expects(static::atLeastOnce())
            ->method('getNotAllowedPaymentMethods')
            ->willReturn(['REMOVE_PAYMENT_PROVIDER']);

        $this->paymentMethodsTransferMock->expects(static::atLeastOnce())
            ->method('setMethods')
            ->willReturnSelf();

        $paymentMethodsTransfer = $this->thirtyFiveUpPaymentMethodFilter->filterPaymentMethods($this->paymentMethodsTransferMock, $this->quoteTransferMock);

        static::assertEquals($this->paymentMethodsTransferMock, $paymentMethodsTransfer);
        static::assertCount(1, $paymentMethodsTransfer->getMethods());
    }

    /**
     * @return void
     */
    public function testFilterPaymentMethodsHasCaseableItemsAndRemovePaymentProvider(): void
    {
        $this->quoteTransferMock->expects(static::atLeastOnce())
            ->method('getItems')
            ->willReturn([$this->itemTransferMock]);

        $this->itemTransferMock->expects(static::atLeastOnce())
            ->method('getAbstractAttributes')
            ->willReturn(['_' => [ThirtyFiveUpPaymentConnectorConstants::ITEM_ATTRIBUTE_CASEABLE_SKU => 'some_SKU']]);

        $this->paymentMethodsTransferMock->expects(static::atLeastOnce())
            ->method('getMethods')
            ->willReturn([$this->paymentMethodTransferMock]);

        $this->paymentMethodTransferMock->expects(static::atLeastOnce())
            ->method('getMethodName')
            ->willReturn('REMOVE_PAYMENT_PROVIDER');

        $this->thirtyFiveUpPaymentConnectorConfigMock->expects(static::atLeastOnce())
            ->method('getNotAllowedPaymentMethods')
            ->willReturn(['REMOVE_PAYMENT_PROVIDER']);

        $this->paymentMethodsTransferMock->expects(static::atLeastOnce())
            ->method('setMethods')
            ->willReturnSelf();

        $paymentMethodsTransfer = $this->thirtyFiveUpPaymentMethodFilter->filterPaymentMethods($this->paymentMethodsTransferMock, $this->quoteTransferMock);

        static::assertEquals($this->paymentMethodsTransferMock, $paymentMethodsTransfer);
    }
}
