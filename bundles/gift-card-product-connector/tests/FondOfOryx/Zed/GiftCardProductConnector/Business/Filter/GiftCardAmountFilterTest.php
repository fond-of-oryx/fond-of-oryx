<?php

namespace FondOfOryx\Zed\GiftCardProductConnector\Business\Filter;

use ArrayObject;
use Codeception\Test\Unit;
use Exception;
use Generated\Shared\Transfer\MoneyValueTransfer;
use Generated\Shared\Transfer\PriceProductTransfer;

class GiftCardAmountFilterTest extends Unit
{
    /**
     * @var array<\PHPUnit\Framework\MockObject\MockObject>|array<\Generated\Shared\Transfer\PriceProductTransfer>
     */
    protected $priceProductTransferMocks;

    /**
     * @var array<\PHPUnit\Framework\MockObject\MockObject>|array<\Generated\Shared\Transfer\MoneyValueTransfer>
     */
    protected $moneyValueTransferMocks;

    /**
     * @var \FondOfOryx\Zed\GiftCardProductConnector\Business\Filter\GiftCardAmountFilter
     */
    protected $giftCardAmountFilter;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->priceProductTransferMocks = [
            $this->getMockBuilder(PriceProductTransfer::class)
                ->disableOriginalConstructor()
                ->getMock(),
            $this->getMockBuilder(PriceProductTransfer::class)
                ->disableOriginalConstructor()
                ->getMock(),
        ];

        $this->moneyValueTransferMocks = [
            $this->getMockBuilder(MoneyValueTransfer::class)
                ->disableOriginalConstructor()
                ->getMock(),
            $this->getMockBuilder(MoneyValueTransfer::class)
                ->disableOriginalConstructor()
                ->getMock(),
        ];

        $this->giftCardAmountFilter = new GiftCardAmountFilter();
    }

    /**
     * @return void
     */
    public function testFilterFromPriceProducts(): void
    {
        $giftCardAmount = 10000;

        $this->priceProductTransferMocks[0]->expects(static::atLeastOnce())
            ->method('getMoneyValue')
            ->willReturn($this->moneyValueTransferMocks[0]);

        $this->moneyValueTransferMocks[0]->expects(static::atLeastOnce())
            ->method('getGrossAmount')
            ->willReturn($giftCardAmount);

        $this->priceProductTransferMocks[1]->expects(static::atLeastOnce())
            ->method('getMoneyValue')
            ->willReturn($this->moneyValueTransferMocks[1]);

        $this->moneyValueTransferMocks[1]->expects(static::atLeastOnce())
            ->method('getGrossAmount')
            ->willReturn(null);

        static::assertEquals(
            $giftCardAmount,
            $this->giftCardAmountFilter->filterFromPriceProducts(new ArrayObject($this->priceProductTransferMocks)),
        );
    }

    /**
     * @return void
     */
    public function testFilterFromPriceProductsWithEmptyPriceProducts(): void
    {
        try {
            $this->giftCardAmountFilter->filterFromPriceProducts(new ArrayObject());
            static::fail();
        } catch (Exception $exception) {
        }
    }

    /**
     * @return void
     */
    public function testFilterFromPriceProductsWithDifferentGrossAmount(): void
    {
        $this->priceProductTransferMocks[0]->expects(static::atLeastOnce())
            ->method('getMoneyValue')
            ->willReturn($this->moneyValueTransferMocks[0]);

        $this->moneyValueTransferMocks[0]->expects(static::atLeastOnce())
            ->method('getGrossAmount')
            ->willReturn(10000);

        $this->priceProductTransferMocks[1]->expects(static::atLeastOnce())
            ->method('getMoneyValue')
            ->willReturn($this->moneyValueTransferMocks[1]);

        $this->moneyValueTransferMocks[1]->expects(static::atLeastOnce())
            ->method('getGrossAmount')
            ->willReturn(5000);

        try {
            $this->giftCardAmountFilter->filterFromPriceProducts(new ArrayObject($this->priceProductTransferMocks));
                static::fail();
        } catch (Exception $exception) {
        }
    }
}
