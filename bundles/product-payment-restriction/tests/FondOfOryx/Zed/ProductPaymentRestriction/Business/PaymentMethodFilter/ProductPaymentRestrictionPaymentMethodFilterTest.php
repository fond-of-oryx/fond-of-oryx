<?php

namespace FondOfOryx\Zed\ProductPaymentRestriction\Business\PaymentMethodFilter;

use Codeception\Test\Unit;
use FondOfOryx\Zed\ProductPaymentRestriction\Persistence\ProductPaymentRestrictionRepository;
use Generated\Shared\Transfer\ItemTransfer;
use Generated\Shared\Transfer\PaymentMethodsTransfer;
use Generated\Shared\Transfer\PaymentMethodTransfer;
use Generated\Shared\Transfer\QuoteTransfer;

class ProductPaymentRestrictionPaymentMethodFilterTest extends Unit
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
     * @var array<\PHPUnit\Framework\MockObject\MockObject>|array<\Generated\Shared\Transfer\PaymentMethodTransfer>
     */
    protected $blacklistedPaymentMethodsTransferMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\QuoteTransfer
     */
    protected $quoteTransferMock;

    /**
     * @var array<\PHPUnit\Framework\MockObject\MockObject>|array<\Generated\Shared\Transfer\ItemTransfer>
     */
    protected $itemTransferMocks;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfOryx\Zed\ProductPaymentRestriction\Persistence\ProductPaymentRestrictionRepository
     */
    protected $productPaymentRestrictionRepositoryMock;

    /**
     * @var \FondOfOryx\Zed\ProductPaymentRestriction\Business\PaymentMethodFilter\ProductPaymentRestrictionPaymentMethodFilter
     */
    protected $productPaymentRestrictionPaymentMethodFilter;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->paymentMethodsTransferMock = $this->getMockBuilder(PaymentMethodsTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->productPaymentRestrictionRepositoryMock = $this->getMockBuilder(ProductPaymentRestrictionRepository::class)
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

        $this->blacklistedPaymentMethodsTransferMock = [
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

        $this->productPaymentRestrictionPaymentMethodFilter = new ProductPaymentRestrictionPaymentMethodFilter(
            $this->productPaymentRestrictionRepositoryMock,
        );
    }

    /**
     * @return void
     */
    public function testFilterPaymentMethodsQuoteHasNoBlacklistedPaymentMethods(): void
    {
        $this->quoteTransferMock->expects(static::atLeastOnce())
            ->method('getItems')
            ->willReturn($this->itemTransferMocks);

        $this->itemTransferMocks[0]->expects(static::atLeastOnce())
            ->method('getIdProductAbstract')
            ->willReturn(100);

        $this->itemTransferMocks[1]->expects(static::atLeastOnce())
            ->method('getIdProductAbstract')
            ->willReturn(101);

        $this->itemTransferMocks[2]->expects(static::atLeastOnce())
            ->method('getIdProductAbstract')
            ->willReturn(102);

        $this->productPaymentRestrictionRepositoryMock->expects(static::atLeastOnce())
            ->method('findBlacklistedPaymentMethodsByIdsProductAbstract')
            ->with([100, 101, 102])
            ->willReturn([]);

        $paymentMethodsTransfer = $this->productPaymentRestrictionPaymentMethodFilter->filterPaymentMethods(
            $this->paymentMethodsTransferMock,
            $this->quoteTransferMock,
        );

        static::assertEquals($paymentMethodsTransfer, $this->paymentMethodsTransferMock);
    }

    /**
     * @return void
     */
    public function testFilterPaymentMethodsQuoteHasBlacklistedPaymentMethods(): void
    {
        $this->quoteTransferMock->expects(static::atLeastOnce())
            ->method('getItems')
            ->willReturn($this->itemTransferMocks);

        $this->itemTransferMocks[0]->expects(static::atLeastOnce())
            ->method('getIdProductAbstract')
            ->willReturn(100);

        $this->itemTransferMocks[1]->expects(static::atLeastOnce())
            ->method('getIdProductAbstract')
            ->willReturn(101);

        $this->itemTransferMocks[2]->expects(static::atLeastOnce())
            ->method('getIdProductAbstract')
            ->willReturn(102);

        $this->productPaymentRestrictionRepositoryMock->expects(static::atLeastOnce())
            ->method('findBlacklistedPaymentMethodsByIdsProductAbstract')
            ->with([100, 101, 102])
            ->willReturn($this->blacklistedPaymentMethodsTransferMock);

        $this->blacklistedPaymentMethodsTransferMock[0]->expects(static::atLeastOnce())
            ->method('getIdPaymentMethod')
            ->willReturn(1);

        $this->blacklistedPaymentMethodsTransferMock[1]->expects(static::atLeastOnce())
            ->method('getIdPaymentMethod')
            ->willReturn(2);

        $this->paymentMethodsTransferMock->expects(static::atLeastOnce())
            ->method('getMethods')
            ->willReturn($this->paymentMethodTransferMocks);

        $this->paymentMethodTransferMocks[0]->expects(static::atLeastOnce())
            ->method('getIdPaymentMethod')
            ->willReturn(1);

        $this->paymentMethodTransferMocks[1]->expects(static::atLeastOnce())
            ->method('getIdPaymentMethod')
            ->willReturn(2);

        $this->paymentMethodTransferMocks[2]->expects(static::atLeastOnce())
            ->method('getIdPaymentMethod')
            ->willReturn(3);

        $paymentMethodsTransfer = $this->productPaymentRestrictionPaymentMethodFilter->filterPaymentMethods(
            $this->paymentMethodsTransferMock,
            $this->quoteTransferMock,
        );

        static::assertCount(1, $paymentMethodsTransfer->getMethods());
    }
}
