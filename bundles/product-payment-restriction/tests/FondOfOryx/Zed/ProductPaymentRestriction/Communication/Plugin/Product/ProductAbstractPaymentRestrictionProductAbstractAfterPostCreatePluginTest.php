<?php

namespace FondOfOryx\Zed\ProductPaymentRestriction\Communication\Plugin\Product;

use Codeception\Test\Unit;
use FondOfOryx\Zed\ProductPaymentRestriction\Business\ProductPaymentRestrictionFacade;
use Generated\Shared\Transfer\ProductAbstractTransfer;

class ProductAbstractPaymentRestrictionProductAbstractAfterPostCreatePluginTest extends Unit
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
     * @var \FondOfOryx\Zed\ProductPaymentRestriction\Communication\Plugin\Product\ProductAbstractPaymentRestrictionProductAbstractAfterPostCreatePlugin
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

        $this->plugin = new ProductAbstractPaymentRestrictionProductAbstractAfterPostCreatePlugin();
        $this->plugin->setFacade($this->facadeMock);
    }

    /**
     * @return void
     */
    public function testCreate(): void
    {
        $this->facadeMock->expects(static::atLeastOnce())
            ->method('persistProductAbstractPaymentRestrictions')
            ->willReturn($this->productAbstractTransferMock);

        static::assertEquals($this->productAbstractTransferMock, $this->plugin->postCreate($this->productAbstractTransferMock));
    }
}
