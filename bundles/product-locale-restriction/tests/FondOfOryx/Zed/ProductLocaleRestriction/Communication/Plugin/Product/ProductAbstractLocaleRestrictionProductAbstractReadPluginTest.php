<?php

namespace FondOfOryx\Zed\ProductLocaleRestriction\Communication\Plugin\Product;

use Codeception\Test\Unit;
use FondOfOryx\Zed\ProductLocaleRestriction\Business\ProductLocaleRestrictionFacade;
use Generated\Shared\Transfer\ProductAbstractTransfer;

class ProductAbstractLocaleRestrictionProductAbstractReadPluginTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\ProductLocaleRestriction\Business\ProductLocaleRestrictionFacade|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $facadeMock;

    /**
     * @var \Generated\Shared\Transfer\ProductAbstractTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $productAbstractTransferMock;

    /**
     * @var \FondOfOryx\Zed\ProductLocaleRestriction\Communication\Plugin\Product\ProductAbstractLocaleRestrictionProductAbstractReadPlugin
     */
    protected $plugin;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->facadeMock = $this->getMockBuilder(ProductLocaleRestrictionFacade::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->productAbstractTransferMock = $this->getMockBuilder(ProductAbstractTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->plugin = new ProductAbstractLocaleRestrictionProductAbstractReadPlugin();
        $this->plugin->setFacade($this->facadeMock);
    }

    /**
     * @return void
     */
    public function testRead(): void
    {
        $this->facadeMock->expects(static::atLeastOnce())
            ->method('expandProductAbstract')
            ->with($this->productAbstractTransferMock)
            ->willReturn($this->productAbstractTransferMock);

        static::assertEquals(
            $this->productAbstractTransferMock,
            $this->plugin->read($this->productAbstractTransferMock),
        );
    }
}
