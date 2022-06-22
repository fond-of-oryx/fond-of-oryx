<?php

namespace FondOfOryx\Zed\ProductPaymentRestriction\Business\Model;

use ArrayObject;
use Codeception\Test\Unit;
use FondOfOryx\Zed\ProductPaymentRestriction\Persistence\ProductPaymentRestrictionRepository;
use Generated\Shared\Transfer\PaymentMethodTransfer;
use Generated\Shared\Transfer\ProductAbstractTransfer;

class ProductAbstractExpanderTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfOryx\Zed\ProductPaymentRestriction\Persistence\ProductPaymentRestrictionRepository
     */
    protected $productPaymentRestrictionRepositoryMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\ProductAbstractTransfer
     */
    protected $productAbstractTransferMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\PaymentMethodTransfer
     */
    protected $paymentMethodTransferMock;

    /**
     * @var \FondOfOryx\Zed\ProductPaymentRestriction\Business\Model\ProductAbstractExpanderInterface
     */
    protected $expander;

    /**
     * @return void
     */
    public function _before(): void
    {
        parent::_before();

        $this->productPaymentRestrictionRepositoryMock = $this->getMockBuilder(ProductPaymentRestrictionRepository::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->productAbstractTransferMock = $this->getMockBuilder(ProductAbstractTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->paymentMethodTransferMock = $this->getMockBuilder(PaymentMethodTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->expander = new ProductAbstractExpander($this->productPaymentRestrictionRepositoryMock);
    }

    /**
     * @return void
     */
    public function testExpand(): void
    {
        $this->productAbstractTransferMock->expects(static::atLeastOnce())
            ->method('getIdProductAbstract')
            ->willReturn(10000);

        $this->productPaymentRestrictionRepositoryMock->expects(static::atLeastOnce())
            ->method('findBlacklistedPaymentMethodsByIdsProductAbstract')
            ->with([10000])
            ->willReturn([$this->paymentMethodTransferMock]);

        $this->paymentMethodTransferMock->expects(static::atLeastOnce())
            ->method('getIdPaymentMethod')
            ->willReturn(1);

        $this->productAbstractTransferMock->expects(static::atLeastOnce())
            ->method('setBlacklistedPaymentMethods')
            ->with(new ArrayObject([$this->paymentMethodTransferMock]))
            ->willReturnSelf();

        $this->productAbstractTransferMock->expects(static::atLeastOnce())
            ->method('setBlacklistedPaymentMethodIds')
            ->with([1])
            ->willReturnSelf();

        $productAbstractTransfer = $this->expander->expand($this->productAbstractTransferMock);

        static::assertEquals($productAbstractTransfer, $this->productAbstractTransferMock);
    }
}
