<?php

namespace FondOfOryx\Zed\GiftCardRestriction\Business\Calculator;

use ArrayObject;
use Codeception\Test\Unit;
use FondOfOryx\Zed\GiftCardRestriction\Business\Filter\SkuFilterInterface;
use FondOfOryx\Zed\GiftCardRestriction\Dependency\Facade\GiftCardRestrictionToProductCartCodeTypeRestrictionFacadeInterface;
use Generated\Shared\Transfer\CalculableObjectTransfer;
use Generated\Shared\Transfer\ItemTransfer;
use Generated\Shared\Transfer\PaymentTransfer;
use Spryker\Zed\GiftCard\GiftCardConfig;

class GiftCardRestrictionCalculatorTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\GiftCardRestriction\Business\Filter\SkuFilterInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $skuFilterMock;

    /**
     * @var \FondOfOryx\Zed\GiftCardRestriction\Dependency\Facade\GiftCardRestrictionToProductCartCodeTypeRestrictionFacadeInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $productCartCodeTypeRestrictionFacadeMock;

    /**
     * @var \Generated\Shared\Transfer\CalculableObjectTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $calculableObjectTransferMock;

    /**
     * @var \Generated\Shared\Transfer\PaymentTransfer[]|\PHPUnit\Framework\MockObject\MockObject[]
     */
    protected $paymentTransferMocks;

    /**
     * @var \Generated\Shared\Transfer\ItemTransfer[]|\PHPUnit\Framework\MockObject\MockObject[]
     */
    protected $itemTransferMocks;

    /**
     * @var \FondOfOryx\Zed\GiftCardRestriction\Business\Calculator\GiftCardRestrictionCalculator
     */
    protected $giftCardRestrictionCalculator;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->skuFilterMock = $this->getMockBuilder(SkuFilterInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->productCartCodeTypeRestrictionFacadeMock = $this->getMockBuilder(GiftCardRestrictionToProductCartCodeTypeRestrictionFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->calculableObjectTransferMock = $this->getMockBuilder(CalculableObjectTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->paymentTransferMocks = [
            $this->getMockBuilder(PaymentTransfer::class)
                ->disableOriginalConstructor()
                ->getMock(),
            $this->getMockBuilder(PaymentTransfer::class)
                ->disableOriginalConstructor()
                ->getMock(),
        ];

        $this->itemTransferMocks = [
            $this->getMockBuilder(ItemTransfer::class)
                ->disableOriginalConstructor()
                ->getMock(),
            $this->getMockBuilder(ItemTransfer::class)
                ->disableOriginalConstructor()
                ->getMock(),
        ];

        $this->giftCardRestrictionCalculator = new GiftCardRestrictionCalculator(
            $this->skuFilterMock,
            $this->productCartCodeTypeRestrictionFacadeMock
        );
    }

    /**
     * @return void
     */
    public function testRecalculate(): void
    {
        $itemTransferMocks = new ArrayObject($this->itemTransferMocks);
        $skus = ['FOO-123-456', 'FOO-234-567'];
        $blacklistedCartCodeTypesPerSku = [
            $skus[0] => ['gift card'],
        ];

        $this->calculableObjectTransferMock->expects(static::atLeastOnce())
            ->method('getPayments')
            ->willReturn(new ArrayObject($this->paymentTransferMocks));

        $this->paymentTransferMocks[0]->expects(static::atLeastOnce())
            ->method('getPaymentProvider')
            ->willReturn('FOO');

        $this->paymentTransferMocks[1]->expects(static::atLeastOnce())
            ->method('getPaymentProvider')
            ->willReturn(GiftCardConfig::PROVIDER_NAME);

        $this->calculableObjectTransferMock->expects(static::atLeastOnce())
            ->method('getItems')
            ->willReturn($itemTransferMocks);

        $this->skuFilterMock->expects(static::atLeastOnce())
            ->method('filterFromItems')
            ->with($itemTransferMocks)
            ->willReturn($skus);

        $this->productCartCodeTypeRestrictionFacadeMock->expects(static::atLeastOnce())
            ->method('getBlacklistedCartCodeTypesByProductConcreteSkus')
            ->with($skus)
            ->willReturn($blacklistedCartCodeTypesPerSku);

        $this->itemTransferMocks[0]->expects(static::atLeastOnce())
            ->method('getSku')
            ->willReturn($skus[0]);

        $this->itemTransferMocks[0]->expects(static::never())
            ->method('getSumPriceToPayAggregation');

        $this->itemTransferMocks[1]->expects(static::atLeastOnce())
            ->method('getSku')
            ->willReturn($skus[1]);

        $this->itemTransferMocks[1]->expects(static::atLeastOnce())
            ->method('getSumPriceToPayAggregation')
            ->willReturn(1000);

        $this->paymentTransferMocks[0]->expects(static::never())
            ->method('getAvailableAmount');

        $this->paymentTransferMocks[0]->expects(static::never())
            ->method('setAvailableAmount');

        $this->paymentTransferMocks[1]->expects(static::atLeastOnce())
            ->method('getAvailableAmount')
            ->willReturn(2000);

        $this->paymentTransferMocks[1]->expects(static::atLeastOnce())
            ->method('setAvailableAmount')
            ->willReturn(1000);

        $this->giftCardRestrictionCalculator->recalculate($this->calculableObjectTransferMock);
    }

    /**
     * @return void
     */
    public function testRecalculateWithoutGiftCardPayment(): void
    {
        $this->calculableObjectTransferMock->expects(static::atLeastOnce())
            ->method('getPayments')
            ->willReturn(new ArrayObject($this->paymentTransferMocks));

        $this->paymentTransferMocks[0]->expects(static::atLeastOnce())
            ->method('getPaymentProvider')
            ->willReturn('FOO');

        $this->paymentTransferMocks[1]->expects(static::atLeastOnce())
            ->method('getPaymentProvider')
            ->willReturn('BAR');

        $this->calculableObjectTransferMock->expects(static::never())
            ->method('getItems');

        $this->skuFilterMock->expects(static::never())
            ->method('filterFromItems');

        $this->productCartCodeTypeRestrictionFacadeMock->expects(static::never())
            ->method('getBlacklistedCartCodeTypesByProductConcreteSkus');

        $this->paymentTransferMocks[0]->expects(static::never())
            ->method('getAvailableAmount');

        $this->paymentTransferMocks[0]->expects(static::never())
            ->method('setAvailableAmount');

        $this->paymentTransferMocks[1]->expects(static::never())
            ->method('getAvailableAmount');

        $this->paymentTransferMocks[1]->expects(static::never())
            ->method('setAvailableAmount');

        $this->giftCardRestrictionCalculator->recalculate($this->calculableObjectTransferMock);
    }

    /**
     * @return void
     */
    public function testRecalculateWithEnoughAmount(): void
    {
        $itemTransferMocks = new ArrayObject($this->itemTransferMocks);
        $skus = ['FOO-123-456', 'FOO-234-567'];
        $blacklistedCartCodeTypesPerSku = [
            $skus[0] => ['gift card'],
        ];

        $this->calculableObjectTransferMock->expects(static::atLeastOnce())
            ->method('getPayments')
            ->willReturn(new ArrayObject($this->paymentTransferMocks));

        $this->paymentTransferMocks[0]->expects(static::atLeastOnce())
            ->method('getPaymentProvider')
            ->willReturn('FOO');

        $this->paymentTransferMocks[1]->expects(static::atLeastOnce())
            ->method('getPaymentProvider')
            ->willReturn(GiftCardConfig::PROVIDER_NAME);

        $this->calculableObjectTransferMock->expects(static::atLeastOnce())
            ->method('getItems')
            ->willReturn($itemTransferMocks);

        $this->skuFilterMock->expects(static::atLeastOnce())
            ->method('filterFromItems')
            ->with($itemTransferMocks)
            ->willReturn($skus);

        $this->productCartCodeTypeRestrictionFacadeMock->expects(static::atLeastOnce())
            ->method('getBlacklistedCartCodeTypesByProductConcreteSkus')
            ->with($skus)
            ->willReturn($blacklistedCartCodeTypesPerSku);

        $this->itemTransferMocks[0]->expects(static::atLeastOnce())
            ->method('getSku')
            ->willReturn($skus[0]);

        $this->itemTransferMocks[0]->expects(static::never())
            ->method('getSumPriceToPayAggregation');

        $this->itemTransferMocks[1]->expects(static::atLeastOnce())
            ->method('getSku')
            ->willReturn($skus[1]);

        $this->itemTransferMocks[1]->expects(static::atLeastOnce())
            ->method('getSumPriceToPayAggregation')
            ->willReturn(3000);

        $this->paymentTransferMocks[0]->expects(static::never())
            ->method('getAvailableAmount');

        $this->paymentTransferMocks[0]->expects(static::never())
            ->method('setAvailableAmount');

        $this->paymentTransferMocks[1]->expects(static::atLeastOnce())
            ->method('getAvailableAmount')
            ->willReturn(2000);

        $this->paymentTransferMocks[1]->expects(static::never())
            ->method('setAvailableAmount');

        $this->giftCardRestrictionCalculator->recalculate($this->calculableObjectTransferMock);
    }
}
