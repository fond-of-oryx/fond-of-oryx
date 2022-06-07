<?php

namespace FondOfOryx\Glue\CartSearchRestApi\Processor\Mapper;

use ArrayObject;
use Codeception\Test\Unit;
use Generated\Shared\Transfer\DiscountTransfer;
use Generated\Shared\Transfer\QuoteTransfer;

class RestCartsDiscountsMapperTest extends Unit
{
    /**
     * @var \Generated\Shared\Transfer\QuoteTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $quoteTransferMock;

    /**
     * @var \Generated\Shared\Transfer\DiscountTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $voucherDiscountTransferMock;

    /**
     * @var \Generated\Shared\Transfer\DiscountTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $cartRuleDiscountTransferMock;

    /**
     * @var \FondOfOryx\Glue\CartSearchRestApi\Processor\Mapper\RestCartsDiscountsMapper
     */
    protected $restCartsDiscountsMapper;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->quoteTransferMock = $this->getMockBuilder(QuoteTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->voucherDiscountTransferMock = $this->getMockBuilder(DiscountTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->cartRuleDiscountTransferMock = $this->getMockBuilder(DiscountTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restCartsDiscountsMapper = new RestCartsDiscountsMapper();
    }

    /**
     * @return void
     */
    public function testFromQuote(): void
    {
        $voucherDiscountData = [];
        $voucherDiscountTransferMocks = new ArrayObject([$this->voucherDiscountTransferMock]);

        $cartRuleDiscountData = [];
        $cartRuleDiscountTransferMocks = new ArrayObject([$this->cartRuleDiscountTransferMock]);

        $this->quoteTransferMock->expects(static::atLeastOnce())
            ->method('getVoucherDiscounts')
            ->willReturn($voucherDiscountTransferMocks);

        $this->voucherDiscountTransferMock->expects(static::atLeastOnce())
            ->method('toArray')
            ->willReturn($voucherDiscountData);

        $this->quoteTransferMock->expects(static::atLeastOnce())
            ->method('getCartRuleDiscounts')
            ->willReturn($cartRuleDiscountTransferMocks);

        $this->cartRuleDiscountTransferMock->expects(static::atLeastOnce())
            ->method('toArray')
            ->willReturn($cartRuleDiscountData);

        static::assertCount(2, $this->restCartsDiscountsMapper->fromQuote($this->quoteTransferMock));
    }
}
