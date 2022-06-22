<?php

namespace FondOfOryx\Zed\ProductPaymentRestriction\Communication\Plugin\Product;

use Codeception\Test\Unit;
use FondOfOryx\Zed\ProductPaymentRestriction\Business\ProductPaymentRestrictionFacade;
use Generated\Shared\Transfer\ProductAbstractTransfer;

class ProductAbstractPaymentRestrictionProductAbstractReadPluginTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfOryx\Zed\ProductPaymentRestriction\Business\ProductPaymentRestrictionFacade
     */
    protected $facadeMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\ProductAbstractTransfer
     */
    protected $productAbstractTransferMock;

    /**
     * @var \FondOfOryx\Zed\ProductPaymentRestriction\Communication\Plugin\Product\ProductAbstractPaymentRestrictionProductAbstractReadPlugin
     */
    protected $plugin;

    /**
     * @return void
     */
    public function _before(): void
    {
        parent::_before();

        $this->facadeMock = $this->getMockBuilder(ProductPaymentRestrictionFacade::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->productAbstractTransferMock = $this->getMockBuilder(ProductAbstractTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->plugin = new ProductAbstractPaymentRestrictionProductAbstractReadPlugin();
        $this->plugin->setFacade($this->facadeMock);
    }

    /**
     * @return void
     */
    public function testRead(): void
    {
        $this->facadeMock->expects(static::atLeastOnce())
            ->method('expandProductAbstract')
            ->willReturn($this->productAbstractTransferMock);

        static::assertEquals($this->productAbstractTransferMock, $this->plugin->read($this->productAbstractTransferMock));
    }
}
