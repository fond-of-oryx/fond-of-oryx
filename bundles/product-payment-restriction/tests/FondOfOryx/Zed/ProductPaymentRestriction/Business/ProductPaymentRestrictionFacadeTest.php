<?php

namespace FondOfOryx\Zed\ProductPaymentRestriction\Business;

use Codeception\Test\Unit;
use FondOfOryx\Zed\ProductPaymentRestriction\Business\Model\ProductAbstractExpander;
use FondOfOryx\Zed\ProductPaymentRestriction\Business\PaymentMethodFilter\ProductPaymentRestrictionPaymentMethodFilter;
use Generated\Shared\Transfer\PaymentMethodsTransfer;
use Generated\Shared\Transfer\ProductAbstractTransfer;
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
    protected $productPaymentRestrictionPaymentMethodFilterMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfOryx\Zed\ProductPaymentRestriction\Business\ProductAbstractExpander
     */
    protected $productAbstractExpanderMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\ProductAbstractTransfer
     */
    protected $productAbstractTransferMock;

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

        $this->productAbstractTransferMock = $this->getMockBuilder(ProductAbstractTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->productAbstractExpanderMock = $this->getMockBuilder(ProductAbstractExpander::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->productPaymentRestrictionPaymentMethodFilterMock = $this
            ->getMockBuilder(ProductPaymentRestrictionPaymentMethodFilter::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->facade = new ProductPaymentRestrictionFacade();
        $this->facade->setFactory($this->businessFactoryMock);
    }

    /**
     * @return void
     */
    public function testProductPaymentRestrictionPaymentMethodFilter(): void
    {
        $this->businessFactoryMock->expects(static::atLeastOnce())
            ->method('createProductPaymentRestrictionPaymentMethodFilter')
            ->willReturn($this->productPaymentRestrictionPaymentMethodFilterMock);

        $this->productPaymentRestrictionPaymentMethodFilterMock->expects(static::atLeastOnce())
            ->method('filterPaymentMethods')
            ->with($this->paymentMethodsTransferMock, $this->quoteTransferMock)
            ->willReturn($this->paymentMethodsTransferMock);

        static::assertEquals($this->paymentMethodsTransferMock, $this->facade->productPaymentRestrictionPaymentMethodFilter(
            $this->paymentMethodsTransferMock,
            $this->quoteTransferMock,
        ));
    }

    /**
     * @return void
     */
    public function testExpandProductAbstract(): void
    {
        $this->businessFactoryMock->expects(static::atLeastOnce())
            ->method('createProductAbstractExpander')
            ->willReturn($this->productAbstractExpanderMock);

        $this->productAbstractExpanderMock->expects(static::atLeastOnce())
            ->method('expand')
            ->with($this->productAbstractTransferMock)
            ->willReturn($this->productAbstractTransferMock);

        static::assertEquals($this->productAbstractTransferMock, $this->facade->expandProductAbstract(
            $this->productAbstractTransferMock,
        ));
    }
}
